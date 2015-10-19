<?php namespace Blupl\PrintMedia\Http\Controllers;

use Blupl\PrintMedia\Http\Requests\Reporter;
use Blupl\PrintMedia\Model\MediaOrganization;
use Blupl\PrintMedia\Model\MediaReporter;
use Illuminate\Support\Facades\Input;
use Blupl\PrintMedia\Processor\Approval as ApprovalProcessor;
use Orchestra\Foundation\Http\Controllers\AdminController;

class PrintingController extends AdminController
{

    public function __construct(ApprovalProcessor $processor)
    {
        $this->processor = $processor;
        parent::__construct();
    }

    protected function setupFilters()
    {
        $this->beforeFilter('control.csrf', ['only' => 'delete']);
    }

    /**
     * Get landing pages
     * @return mixed
     */
    public function index()
    {
        $reporters = MediaReporter::where('status', '=', 1)->get();
        return view('blupl/printmedia::list-printing', compact('reporters'));
    }

    /**
     * Show a role.
     *
     * @param  int  $roles
     *
     * @return mixed
     */
    public function show($reporterId)
    {
        $reporter = MediaReporter::find($reporterId);
        return view('blupl/printmedia::print-single', compact('reporter'));
    }

    /**
     * Create a new role.
     * @return mixed
     */
    public function create()
    {
        return $this->processor->create($this);
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


    /**
     * Response when create role page succeed.
     *
     * @param  array  $data
     *
     * @return mixed
     */
    public function createSucceed()
    {
        set_meta('title', trans('blupl/printmedia::title.media.create'));
        return view('blupl/printmedia::edit');
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
         dd('Validation Faild');

//        return $this->redirectWithMessage(handles('orchestra::media/reporter'), $message);
     }

    /**
     * Response when storing user succeed.
     *
     * @param  \Orchestra\Model\Role  $role
     *
     * @return mixed
     */
     public function storeSucceed(MediaOrganization $media)
     {
        $message = trans('blupl/printmedia::response.media.create', [
//            'name' => $media->getAttribute('name')
        ]);
        dd('sss');
//         return $this->redirectWithMessage(handles('orchestra::media/reporter'), $message);
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
