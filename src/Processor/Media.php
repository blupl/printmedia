<?php namespace Blupl\PrintMedia\Processor;

use Blupl\PrintMedia\Model\MediaInvolvePerson;
use Blupl\PrintMedia\Model\MediaReporter;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Blupl\PrintMedia\Model\MediaOrganization as Eloquent;
use Illuminate\Support\Facades\Input;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Intervention\Image\Facades\Image;
use Orchestra\Contracts\Foundation\Foundation;
use Blupl\PrintMedia\Http\Presenters\MediaPresenter as MediaPresenter;
use Blupl\PrintMedia\Validation\Media as MediaValidator;


class Media extends Processor
{
    /**
     * Setup a new processor instance.
     *
     */
    public function __construct(MediaPresenter $presenter, MediaValidator $validator, Foundation $foundation)
    {
        $this->presenter  = $presenter;
        $this->validator  = $validator;
        $this->foundation = $foundation;
        $this->model = $foundation->make('Blupl\PrintMedia\Model\MediaOrganization');
    }

    /**
     * View list roles pages
     */
    public function index($listener)
    {
        $eloquent = $this->model->newQuery();
        $table    = $this->presenter->table($eloquent);

        $this->fireEvent('list', [$eloquent, $table]);

        // Once all event listening to `orchestra.list: role` is executed,
        // we can add we can now add the final column, edit and delete
        // action for roles.
        $this->presenter->actions($table);

        return $listener->indexSucceed(compact('eloquent', 'table'));
    }

    /**
     * View create a role page.
     */
    public function create($listener)
    {
       return $listener->createSucceed();
    }

    public function show($listener, $reporterId)
    {
        $reporter = MediaReporter::find($reporterId);
        return $listener->showSucceed($reporter);
    }

    /**
     * View edit a role page.
     *
     * @param  object  $listener
     * @param  string|int  $id
     *
     * @return mixed
     */
    public function edit($listener, $id)
    {
        $eloquent = $this->model->findOrFail($id);
        $form     = $this->presenter->form($eloquent);

        $this->fireEvent('form', [$eloquent, $form]);

        return $listener->editSucceed(compact('eloquent', 'form'));
    }

    /**
     * Store a role.
     *
     * @param  object  $listener
     * @param  array   $input
     *
     * @return mixed
     */
    public function store($listener, $request)
    {
        $media = $this->model;

        try {
            $organization = $media->create($request->organization);
            $organization->member()->insert($request->officer);
            foreach($request->reporter as $key=>$reporter) {
                $file = Input::file('file' . $key);
                $filename = 'reporter_'.uniqid() . '.jpg';
                $destinationPath = 'images/reporters';
                $itemImage = Image::make($file)->fit(350, 450);
                $itemImage->save($destinationPath . '/' . $filename);
                $reporter['photo'] = $destinationPath.'/'.$filename;
                $organization->reporter()->create($reporter);

            }
        } catch (Exception $e) {
            return $listener->storeFailed(['error' => $e->getMessage()]);
        }
        return $listener->storeSucceed($organization);
    }

    /**
     * Update a role.
     */
    public function update($listener, array $input, $id)
    {
        if ((int) $id !== (int) $input['id']) {
            return $listener->userVerificationFailed();
        }

        $validation = $this->validator->on('update')->bind(['roleID' => $id])->with($input);

        if ($validation->fails()) {
            return $listener->updateValidationFailed($validation, $id);
        }

        $role = $this->model->findOrFail($id);

        try {
            $this->saving($role, $input, 'update');
        } catch (Exception $e) {
            return $listener->updateFailed(['error' => $e->getMessage()]);
        }

        return $listener->updateSucceed($role);
    }

    /**
     * Delete a role.
     *
     * @param  object  $listener
     * @param  string|int  $id
     *
     * @return mixed
     */
    public function destroy($listener, $id)
    {
        $role = $this->model->findOrFail($id);

        try {
            DB::transaction(function () use ($role) {
                $role->delete();
            });
        } catch (Exception $e) {
            return $listener->destroyFailed(['error' => $e->getMessage()]);
        }

        return $listener->destroySucceed($role);
    }

    /**
     * Save the role.
     *
     * @param  \Orchestra\Model\Role  $role
     * @param  array  $input
     * @param  string  $type
     *
     * @return bool
     */
    protected function saving(Eloquent $media, $request, $type = 'create')
    {

        $beforeEvent = ($type === 'create' ? 'creating' : 'updating');
        $afterEvent  = ($type === 'create' ? 'created' : 'updated');


        $this->fireEvent($beforeEvent, [$media]);
        $this->fireEvent('saving', [$media]);

        $organization = $media->create($request->organization);
        $organization->member()->insert($request->officer);
        $organization->reporter()->insert($request->reporter);


        $this->fireEvent($afterEvent, [$media]);
        $this->fireEvent('saved', [$media]);

        return true;
    }

    function saveImage($path, $filename, $extension, $file)
    {


        $filename = uniqid().'.jpg';
        $destinationPath = 'images';
        $galleryImage = Image::make($file)->fit(350, 450);
        $galleryImage->save($destinationPath.'/'.$filename);
        return true;
    }

    /**
     * Fire Event related to eloquent process.
     *
     * @param  string  $type
     * @param  array   $parameters
     *
     * @return void
     */
    protected function fireEvent($type, array $parameters = [])
    {
        Event::fire("geonix.media.{$type}: media", $parameters);
    }
}
