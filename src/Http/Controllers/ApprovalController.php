<?php namespace Blupl\PrintMedia\Http\Controllers;

use Blupl\PrintMedia\Model\MediaReporter;
use Illuminate\Http\Request;
use Blupl\PrintMedia\Processor\Approval as ApprovalProcessor;
use Laracasts\Flash\Flash;
use Orchestra\Foundation\Http\Controllers\AdminController;

class ApprovalController extends AdminController
{

    public function __construct(ApprovalProcessor $processor)
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
    public function index(MediaReporter $reporters)
    {
        return view('blupl/printmedia::home-approval', compact('reporters'));

    }


    /**
     * Show a role.
     */
    public function show($mediaCategory)
    {
        $reporters = MediaReporter::where('media_category', '=', $mediaCategory)->get();
        return view('blupl/printmedia::list', compact('reporters'));
    }

    public function showReporter($reporterId)
    {
        $reporter = MediaReporter::find($reporterId);

        set_meta('title', trans('blupl/printmedia::title.media.reporter'));
        if($reporter != null && $reporter->status == 0) {
            return view('blupl/printmedia::reporter', compact('reporter'));
        }else {
            if($reporter->status == 1) {
                $massage = "Already Approve";
            } else {
                $massage = "Reporter Not Found";
            }
            Flash::error($massage);
            return $this->redirect(handles('blupl/printmedia::approval'));
        }
    }



    /**
     * Update the role.
     * @return mixed
     */
    public function update($reporterId, Request $request)
    {
        $reporter = MediaReporter::find($reporterId);

        if ($reporter->status == 0) {
                foreach ($request->zone as $key => $zone) {
                    $reporter->zone()->create(['zone'=>$zone]);
                }
                $reporter->status = 1;
                $reporter->save();
        }else {
            if($reporter->status == 1) {
                $massage = "Already Approve";
            } else {
                $massage = "Reporter Not Found";
            }
            Flash::error($massage);
            return $this->redirect(handles('blupl/printmedia::approval'));
        }

        Flash::success($reporter->name.' Approved Successfully');
        return $this->redirect(handles('blupl/printmedia::approval'));

    }


}
