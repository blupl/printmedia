<?php

use Illuminate\Routing\Router;
use Orchestra\Support\Facades\Foundation;

/*
|--------------------------------------------------------------------------
| Frontend Routing
|--------------------------------------------------------------------------
*/

Foundation::group('blupl/printmedia', 'media', ['namespace' => 'Blupl\PrintMedia\Http\Controllers'], function (Router $router) {
    $router->resource('reporter', 'ReporterController');
    $router->get('/', 'HomeController@index');
});

/*
|--------------------------------------------------------------------------
| Backend Routing
|--------------------------------------------------------------------------
*/

Foundation::namespaced('Blupl\PrintMedia\Http\Controllers\Admin', function (Router $router) {
    $router->group(['prefix' => 'media'], function (Router $router) {
        $router->resource('reporter', 'ReporterController');
//        $router->get('/', 'HomeController@index');
        $router->get('/', 'HomeController@select');
        $router->match(['GET', 'HEAD', 'DELETE'], 'profile/{roles}/delete', 'HomeController@delete');

    });
});
