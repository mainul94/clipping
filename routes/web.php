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
//    return redirect('login');
    $user = \App\User::first();
    $task = \App\Task::first();
    $user->notify(new \App\Notifications\TaskUpdate($task));
});

Route::group(['middleware'=>['auth'],'prefix'=>'admin'], function ($admin ='admin') {
    Route::resource('user','UserController');
    Route::resource('role','RoleController');
    Route::resource('permission','PermissionController');
    Route::resource('setting','SettingController');
    Route::resource('task','TaskController');
    Route::resource('image','ImageController');
    Route::resource('quotation', 'QuotationController');
    Route::resource('trail', 'TrailController');
    Route::resource('comment', 'CommentController');
    Route::resource('invoice', 'InvoiceController');
    Route::group(['prefix'=>'report'], function () {
        Route::get('{report}', 'ReportController');
    });
    Route::resource('profile','ProfileController');
});
Route::group(['middleware'=>['auth','api','cors']], function () {
    Route::get('/api/getvalue/','APIController@getValue');
    Route::get('/api/trail/','TrailController@create');
    Route::get('/api/get-values/','APIController@getValues');
    Route::delete('/api/delete/','APIController@deleteRecord');
    Route::delete('/api/child-menu/','APIController@deleteChildMenu');
    Route::patch('/api/child-menu/','APIController@updateChildMenu');
    Route::post('/api/child-menu/','APIController@storeChildMenu');
});
Auth::routes();

Route::get('/home', 'HomeController@index');

