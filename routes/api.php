<?php

use App\Http\Controllers\UrlController;
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

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::group(['prefix' => 'shorten-url', 'as' => 'shorten-url.'], function () {
        Route::get('/', 'App\Http\Controllers\UrlController@index')->name('index');
        Route::post('/', 'App\Http\Controllers\UrlController@store')->name('store');
        Route::delete('/', 'App\Http\Controllers\UrlController@destroy')->name('destroy');
    });
});
