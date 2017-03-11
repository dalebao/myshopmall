<?php


//显示后台登录页面
//Route::get('login', 'AdminAuth\LoginController@showLoginForm');

//登录请求
Route::post('login', 'AdminAuth\LoginController@login');

//退出登录
Route::post('logout', 'AdminAuth\LoginController@logout');

//显示注册页面
//Route::get('register', 'AdminAuth\RegisterController@showRegistrationForm');

//注册请求
Route::post('register', 'AdminAuth\RegisterController@register');


Route::middleware('auth.admin')->get('info', function () {
    return Auth::user();
});
