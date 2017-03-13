<?php
//显示后台登录页面
//Route::get('login', 'AdminAuth\LoginController@showLoginForm');

//登录请求
Route::post('login', 'Admin\LoginController@login');

//退出登录
Route::post('logout', 'Admin\LoginController@logout');

//显示注册页面
//Route::get('register', 'AdminAuth\RegisterController@showRegistrationForm');

//注册请求
Route::post('register', 'Admin\RegisterController@register');


Route::middleware('auth.admin')->get('info', function () {
    return Auth::guard('admin')->user();
});

Route::get('test', function () {
    return 1111;
});