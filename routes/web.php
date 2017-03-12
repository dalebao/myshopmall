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

Route::get('/home', 'HomeController@index');

Route::get('/user', function () {
    return Auth::user();
});
Route::get('/islogout', function () {
    return response()->json([
        'code' => 200,
        'msg' => 'success'
    ]);
});



Route::get('{all}', function () {
    return view('front.index');
})->where('all', '.*');


