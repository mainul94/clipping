<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::group(['prefix'=>'admin'], function () {
    Route::resource('user','UserController');
    Route::resource('role','RoleController');
    Route::resource('permission','PermissionController');
    Route::resource('setting','SettingController');
    Route::resource('task','TaskController');
    Route::resource('image','ImageController');
    Route::resource('quotation', 'QuotationController');
    Route::resource('trail', 'TrailController');
});
Route::group(['middleware'=>['auth','api']], function () {
    Route::get('/api/getvalue/','APIController@getValue');
    Route::get('/api/get-values/','APIController@getValues');
    Route::delete('/api/delete/','APIController@deleteRecord');
    Route::delete('/api/child-menu/','APIController@deleteChildMenu');
    Route::patch('/api/child-menu/','APIController@updateChildMenu');
    Route::post('/api/child-menu/','APIController@storeChildMenu');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
