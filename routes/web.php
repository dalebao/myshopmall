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
    $id = Auth::user()->id;
    return \App\User::with('userInfo')->where('id', $id)->first();
});


//管理员后台路由
Route::group(['prefix' => 'admin'], function () {
    //登录请求
    Route::post('login', 'Admin\LoginController@login');

//退出登录
    Route::post('logout', 'Admin\LoginController@logout');


//注册请求
    Route::post('register', 'Admin\RegisterController@register');

    Route::middleware('auth:admin')->get('info', function () {
        return Auth::guard('admin')->user();
    });


});


//api for admin
Route::group(['middleware' => 'auth:admin', 'prefix' => 'api'], function () {
    //order controller
    //order controller
    Route::resource('order', 'Api\Admin\OrderController');
    //item api controller
    Route::resource('item', 'Api\Admin\ItemController');
    //kd company controller
    Route::get('getKd/{id}', 'Api\Admin\KdController@getKd');
    //profit controller
    Route::get('showProfit', 'Api\Admin\ProfitController@showProfit');

});


//api for front end
Route::group(['prefix' => 'api/front'], function () {
    //index
    Route::resource('item', 'Api\Front\ItemController');
    //comment
    Route::resource('comment', 'Front\CommentController');
    //high score
    Route::resource('high_score', 'Front\HighScoreController');
    //kd company controller
    Route::get('getKd/{id}', 'Api\Admin\KdController@getKd');
});

//api for user
Route::group(['prefix' => 'api/user', 'middleware' => 'auth'], function () {
    //user's address
    Route::resource('address', 'Api\Front\AddressController');
    //user's info
    Route::resource('user_info', 'Api\Front\UserInfoController');
    //new order
    Route::resource('new_order', 'Api\Front\OrderController');
    //user-admin order
//    Route::resource('order','Api\Admin\OrderController');
    //comment controller
    Route::resource('comment', 'Api\Front\CommentController');
});


Route::get('{all}', function () {
    return view('front.index');
})->where('all', '.*');


