<?php namespace Blupl\PrintMedia\Processor;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Blupl\PrintMedia\Model\MediaPrint as Eloquent;
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
        $this->model      = $foundation->make('Blupl\PrintMedia\Model\MediaOrganization');
    }

    /**
     * View list roles page.
     *
     * @param  object  $listener
     *
     * @return mixed
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
     *
     * @param  object  $listener
     *
     * @return mixed
     */
    public function create($listener)
    {
        $eloquent = $this->model;
        $form     = $this->presenter->form($eloquent);

        $this->fireEvent('form', [$eloquent, $form]);

        return $listener->createSucceed(compact('eloquent', 'form'));
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
    public function store($listener, array $input)
    {
        $validation = $this->validator->on('create')->with($input);

        if ($validation->fails()) {
            return $listener->storeValidationFailed($validation);
        }
        $student = $this->model;

        try {
            $this->saving($student, $input, 'create');
        } catch (Exception $e) {
            return $listener->storeFailed(['error' => $e->getMessage()]);
        }

        return $listener->storeSucceed($student);
    }

    /**
     * Update a role.
     *
     * @param  object  $listener
     * @param  array   $input
     * @param  int     $id
     *
     * @return mixed
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
    protected function saving(Eloquent $student, $input = [], $type = 'create')
    {
        $beforeEvent = ($type === 'create' ? 'creating' : 'updating');
        $afterEvent  = ($type === 'create' ? 'created' : 'updated');

        $student->setAttribute('name', $input['name']);
        $student->setAttribute('phone', $input['phone']);
        $student->setAttribute('address', $input['address']);

        $this->fireEvent($beforeEvent, [$student]);
        $this->fireEvent('saving', [$student]);

//        dd($student);

        DB::transaction(function () use ($student) {
            $student->save();
        });


        $this->fireEvent($afterEvent, [$student]);
        $this->fireEvent('saved', [$student]);

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
