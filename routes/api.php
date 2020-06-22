<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', 'Api\AuthController@login');

Route::namespace('Api')->middleware('auth:sanctum')->prefix('providers')->group(function () {
    Route::get('', 'ProviderController@index')->name('providers.list');
    Route::get('show/{provider}', 'ProviderController@show')->name('providers.show');
    Route::post('', 'ProviderController@store')->name('providers.store');
    Route::delete('{provider}', 'ProviderController@destroy')->name('providers.destroy');

    Route::prefix('payment')->group(function () {
        Route::get('total', 'ProviderController@totalPayments')->name('providers.payment.total');
    });
});
