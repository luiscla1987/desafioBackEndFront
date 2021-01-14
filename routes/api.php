<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

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

Route::get('testPHP', function () {
    phpinfo();
});

Route::namespace('Api')->group(
    function () {
        Route::prefix('movies')->group(function () {
            Route::get('/', 'MovieController@index');
            Route::get('/{id}', 'MovieController@show');
            Route::post('/', 'MovieController@store');
            Route::put('/{id}', 'MovieController@update');
            Route::patch('/', 'MovieController@update');
            Route::delete('/{id}', 'MovieController@destroy');
        });

        Route::prefix('ratings')->group(function () {
            Route::get('/', 'RatingController@index');
            Route::get('/{id}', 'RatingController@show');
            Route::post('/', 'RatingController@store');
            Route::put('/{id}', 'RatingController@update');
        });
    }
);
