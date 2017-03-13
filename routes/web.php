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


Auth::routes();


//获取用户登录信息
Route::get('/user', function () {
    return Auth::user();
});


Route::get('/islogout', function () {
    return response()->json([
        'code' => 200,
        'msg' => 'success'
    ]);
});


//管理员后台路由
Route::group(['prefix' => 'admin'], function () {
    //登录请求
    Route::post('login', 'Admin\LoginController@login');

//退出登录
    Route::post('logout', 'Admin\LoginController@logout');


//注册请求
    Route::post('register', 'Admin\RegisterController@register');

    Route::middleware('auth.admin:admin')->get('info', function () {
        return Auth::guard('admin')->user();
    });

    Route::get('test', function () {
        return 123;
    });
});


Route::get('{all}', function () {
    return view('front.index');
})->where('all', '.*');


