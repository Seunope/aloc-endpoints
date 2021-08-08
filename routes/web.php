<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\AuthController;

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


Route::group(['prefix'=> 'secure'], function () {

    Route::get('/signup',  [AuthController::class, 'signup']);
    Route::post('/signup', [AuthController::class, 'handleSignup'])->name('signup');

    Route::get('/login',   [AuthController::class, 'login']);
    Route::post('/login',  [AuthController::class, 'handleLogin'])->name('login');
    Route::get('/logout',  [AuthController::class, 'handleLogout'])->name('logout');

    Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
    Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

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


