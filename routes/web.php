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
$middleware = ['auth'];
if (!empty(auth()->check())) {
    $prefix = strtolower(auth()->user()->type);
}else {
    $prefix = '';
}

Route::group(compact('middleware', 'prefix'), function () {
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
    Route::resource('ftp', 'FTPController');
    Route::group(['prefix'=>'report'], function () {
        Route::get('{report}', 'ReportController');
    });
    Route::any('directory','ImageController@directory');
    Route::any('file','ImageController@file');
    Route::get('profile/edit','ProfileController@edit');
    Route::get('profile/{user?}','ProfileController@show');
    Route::patch('profile/{profile}','ProfileController@update');
});
Route::group(['middleware'=>['auth','api','cors']], function () {
    Route::get('/api/getvalue/','APIController@getValue');
    Route::get('/api/trail/','TrailController@create');
    Route::get('/api/get-values/','APIController@getValues');
    Route::delete('/api/delete/','APIController@deleteRecord');
    Route::delete('/api/child-menu/','APIController@deleteChildMenu');
    Route::patch('/api/child-menu/','APIController@updateChildMenu');
    Route::post('/api/child-menu/','APIController@storeChildMenu');

    Route::get('notification', function () {
        return response()->json(
            auth()->user()->notifications
        );
    });

    Route::post('notification', function () {
        if (request('all')) {
            auth()->user()->unreadNotifications->markAsRead();
            $type = 'success';
            $msg = 'Marked All Notification as Read';
        } elseif (request('id')) {
            $notification = auth()->user()->notifications()->where('id',request('id'));
            if (request('mark_as', 'Read') == 'Read') {
                $read_at = \Carbon\Carbon::now();
            } elseif (request('mark_as') == 'Unread') {
                $read_at = null;
            }
            $notification->update(['read_at' => $read_at]);
            $type = 'success';
            $msg = 'Marked All Notification as '.request('mark_as');
        }
        return response()->json([
            'type' => $type,
            'msg' => $msg
        ]);
    });

//    Get FTP Details
    Route::get('ftp-details/{task}','TaskController@getFTPDetails');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/user/activation/{token}', 'Auth\RegisterController@userActivation');


