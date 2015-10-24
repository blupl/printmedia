<?php namespace Blupl\PrintMedia\Http\Controllers;

use Orchestra\Routing\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Get landing page.
     *
     * @return mixed
     */
    public function index()
    {
        return 'check Auth';
    }


    public function form($role)
    {
        return view('blupl/printmedia::edit', compact('role'));
    }

    /**
     * @return \Illuminate\View\View Bipon
     */
    public function select()
    {

    }

}
