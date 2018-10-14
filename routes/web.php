<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return redirect(route('map.index', ['category_id' => 'all']));
});
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.show');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::middleware('auth')->get('/{category_id}', 'MapController@index')->name('map.index');

