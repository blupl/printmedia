<?php namespace Blupl\PrintMedia\Http\Controllers;

use Orchestra\Routing\Controller;

class HomeController extends Controller
{
    /**
     * Get landing page.
     *
     * @return mixed
     */
    public function index()
    {
        return $this->select();
    }

    public function show()
    {
        return view('blupl/printmedia::select');
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
        return view('blupl/printmedia::select-media');
    }

}
