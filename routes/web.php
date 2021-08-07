<?php

use Illuminate\Support\Facades\Route;

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
    return view('landing.index');
});

Route::group(['namespace' => 'Admin', 'prefix'=> 'secure'], function () {

    Route::get('/signup', 'AuthController@signup');
    Route::post('/signup', 'AuthController@handleSignup')->name('signup');

    Route::get('/login', 'AuthController@login');
    Route::post('/login', 'AuthController@handleLogin')->name('login');
    Route::get('/logout', 'AuthController@handleLogout')->name('logout');

});

Route::group(['namespace' => 'Admin', 'prefix'=> 'admin'], function () {

    Route::group(['middleware' => 'auth'], function () {

        Route::get('/dashboard', 'DashboardController@index');
        Route::get('/access-token', 'AccessTokenController@index');
        Route::get('/access-token/generate', 'AccessTokenController@generateNewToken');

        Route::get('/pricing', 'BillingController@index');
        Route::get('/pricing/paystack/callback', 'BillingController@paystackCallBack');



    });
});


