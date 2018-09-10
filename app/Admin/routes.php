<?php

use Illuminate\Routing\Router;
Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/projects', 'ProjectController');
    $router->resource('/categories', 'CategoryController');
    $router->get('/provinces', 'AreaController@provinces')->name('provinces');
    $router->get('/cities', 'AreaController@cities')->name('cities'); 
    $router->get('/areas', 'AreaController@areas')->name('areas');
});
