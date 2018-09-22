<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api'], function () {

    Route::resource('/q', 'QuestionController');
    Route::get('/m', 'QuestionController@manyQuestions');
    Route::post('/r', 'QuestionController@reportQuestion');

    Route::group(['prefix'=>'metrics'], function(){
        Route::get('/subjects-call', 'MetricsController@subjectsApiCallCounts');
    });

});
