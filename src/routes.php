<?php

use Illuminate\Routing\Router;
use Orchestra\Support\Facades\Foundation;

/*
|--------------------------------------------------------------------------
| Frontend Routing
|--------------------------------------------------------------------------
*/

Foundation::group('blupl/printmedia', 'media', ['namespace' => 'Blupl\PrintMedia\Http\Controllers'], function (Router $router) {
    $router->get('printing/{id}', 'PrintingController@show');
    $router->get('printing', 'PrintingController@index');
    $router->get('approval/reporter/{id}', 'ApprovalController@showReporter');
    $router->put('approval/zone/{id}', ['as' => 'media.approval.zone', 'uses'=>'ApprovalController@update']);
    $router->get('approval/{id}', 'ApprovalController@show');
    $router->get('approval', 'ApprovalController@index');
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
        $router->get('/', 'HomeController@index');
        $router->match(['GET', 'HEAD', 'DELETE'], 'profile/{roles}/delete', 'HomeController@delete');

    });
});
