<?php namespace Blupl\PrintMedia\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Blupl\PrintMedia\Model\MediaReporter;
use Illuminate\Support\Facades\App;
use Blupl\PrintMedia\Processor\Approval as ApprovalProcessor;
use Orchestra\Foundation\Http\Controllers\AdminController;

class PrintingController extends AdminController
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
        $this->beforeFilter('media.manage:acl');
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

    public function pdf($reporterId)
    {
        $reporter = MediaReporter::find($reporterId);
        $pdf = App::make('dompdf');
        $pdf->loadView('blupl/printmedia::printing._print-single', [
            'name'=>$reporter->name,
            'role'=>$reporter->role,
            'organization'=>$reporter->organization->name,
            'photo'=>$reporter->photo
        ]);

        return $pdf->stream();
    }




}
