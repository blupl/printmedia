<?php namespace Blupl\PrintMedia\Http\Controllers;

use Blupl\PrintMedia\Http\Requests\Reporter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Blupl\PrintMedia\Processor\Media as MediaProcessor;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use Orchestra\Foundation\Http\Controllers\AdminController;
use Orchestra\Support\Facades\Mail as Mailer;

class ReporterController extends AdminController
{

    public function __construct(MediaProcessor $processor)
    {
        $this->processor = $processor;
        parent::__construct();
        $this->middleware('auth');
    }

    protected function setupFilters()
    {
        $this->beforeFilter('control.csrf', ['only' => 'delete']);
    }

    /**
     * Get landing page.
     *
     * @return mixed
     */
    public function index()
    {
        return view('blupl/printmedia::select-media');
    }

    /**
     * Show a role.
     *
     * @param  int  $roles
     *
     * @return mixed
     */
    public function show($reporter)
    {
        return $this->processor->show($this, $reporter);
    }

    /**
     * Create a new role.
     *
     * @return mixed
     */
    public function create(Request $request)
    {
        if($request->has('category') ) {
            return $this->processor->create($this);
        }else{
            Flash::error('Must Select a Category');
            return $this->redirect(handles('blupl/printmedia::reporter'));
        }
    }

    /**
     * Edit the role.
     *
     * @param  int  $roles
     *
     * @return mixed
     */
     public function edit($medias)
     {
        return $this->processor->edit($this, $medias);
     }

    /**
     * Create the role.
     *
     * @return mixed
     */
     public function store(Reporter $request)
     {
//         dd('ypp');
         return $this->processor->store($this, $request);
     }

    /**
     * Update the role.
     *
     * @param  int  $roles
     *
     * @return mixed
     */
    public function update($medias)
    {
        return $this->processor->update($this, Input::all(), $medias);
    }

    /**
     * Request to delete a role.
     *
     * @param  int  $roles
     *
     * @return mixed
     */
    public function delete($medias)
    {
        return $this->destroy($medias);
    }

    /**
     * Request to delete a role.
     *
     * @param  int  $roles
     *
     * @return mixed
     */
    public function destroy($medias)
    {
        return $this->processor->destroy($this, $medias);
    }


    public function indexSucceed(array $data)
    {
        set_meta('title', 'blupl/printmedia::title.media');

        return view('blupl/printmedia::index', $data);
    }

    /**
     * Response when create role page succeed
     * @param  array  $data
     * @return mixed
     */
    public function createSucceed()
    {
        set_meta('title', trans('blupl/printmedia::title.media.create'));
        return view('blupl/printmedia::edit');
    }

    public function showSucceed($reporter)
    {
        set_meta('title', trans('blupl/printmedia::title.media.reporter'));
        if($reporter != null) {
            return view('blupl/printmedia::reporter', compact('reporter'));
        }else {
            Flash::error('Reporter Not Found');
            return $this->redirect(handles('blupl/printmedia::approval'));
        }
    }

    /**
     * Response when edit role page succeed.
     *
     * @param  array  $data
     *
     * @return mixed
     */
    public function editSucceed(array $data)
    {
        set_meta('title', trans('blupl/printmedia::title.media.update'));

        return view('blupl/printmedia::edit', $data);
    }

    /**
     * Response when storing role failed on validation.
     *
     * @param  object  $validation
     *
     * @return mixed
     */
     public function storeValidationFailed($validation)
     {
         dd('Validation Error');
//        return $this->redirectWithErrors(handles('orchestra::media/reporter'), $validation);
     }

    /**
     * Response when storing role failed.
     *
     * @param  array  $error
     *
     * @return mixed
     */
     public function storeFailed(array $error)
     {
        $message = trans('orchestra/foundation::response.db-failed', $error);
        Flash::error('erro');
        return $this->redirectWithMessage(handles('blupl/printmedia::reporter'), $message);
     }

    /**
     * Response when storing user succeed.
     *
     * @param  \Orchestra\Model\Role  $role
     *
     * @return mixed
     */
     public function storeSucceed($organization)
     {
        $message = trans('blupl/printmedia::response.media.create', [
            'name' => $organization->name
        ]);
//        dd($organization->email);
         Mailer::send('blupl/printmedia::email.update', ['yoo'=>'Yoo'], function ($m) use ($organization) {
             $m->to($organization->email);
         });

         Mail::send('blupl/printmedia::email.update', ['yoo'=>'Yoo'], function ($m) use ($organization) {
             $m->to($organization->email, $organization->name)->subject('Your Reminder!');
         });
        dd('mail check');
         return $this->redirectWithMessage(handles('blupl::media/reporter'), $message);
     }

    /**
     * Response when updating role failed on validation.
     *
     * @param  object  $validation
     * @param  int     $id
     *
     * @return mixed
     */
     public function updateValidationFailed($validation, $id)
     {
        return $this->redirectWithErrors(handles("orchestra::media/reporter/{$id}/edit"), $validation);
     }

    /**
     * Response when updating role failed.
     *
     * @param  array  $errors
     *
     * @return mixed
     */
     public function updateFailed(array $errors)
     {
        $message = trans('orchestra/foundation::response.db-failed', $errors);

        return $this->redirectWithMessage(handles('orchestra::media/reporter'), $message);
     }

    /**
     * Response when updating role succeed.
     */
    public function updateSucceed(media $media)
    {
        $message = trans('orchestra/control::response.roles.update', [
            'name' => $media->getAttribute('name')
        ]);

        return $this->redirectWithMessage(handles('orchestra::media'), $message);
    }

    /**
     * Response when deleting role failed.
     *
     * @param  array  $error
     *
     * @return mixed
     */
    public function destroyFailed(array $error)
    {
        $message = trans('orchestra/foundation::response.db-failed', $error);

        return $this->redirectWithMessage(handles('orchestra::media'), $message);
    }

    /**
     * Response when updating role succeed.
     *
     * @param  \Orchestra\Model\Role  $role
     *
     * @return mixed
     */
    public function destroySucceed(media $media)
    {
        $message = trans('orchestra/control::response.roles.delete', [
            'name' => $media->getAttribute('name')
        ]);

        return $this->redirectWithMessage(handles('orchestra::media'), $message);
    }

    /**
     * Response when user verification failed.
     *
     * @return mixed
     */
    public function userVerificationFailed()
    {
        return $this->suspend(500);
    }

}
