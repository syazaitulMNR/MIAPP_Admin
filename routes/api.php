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

Route::post('login' , 'App\Http\Controllers\Api\AuthController@login');
Route::post('register' , 'App\Http\Controllers\Api\AuthController@register');


Route::get('ebooks/guestIndex' , 'App\Http\Controllers\Api\EBookController@guestIndex');
Route::get('products/guestIndex' , 'App\Http\Controllers\Api\ProductController@guestIndex');
Route::get('programs/guestIndex' , 'App\Http\Controllers\Api\ProgramController@guestIndex');
Route::get('promotions/guestIndex' , 'App\Http\Controllers\Api\OfferController@guestIndex');
Route::get('profile/guestIndex' , 'App\Http\Controllers\Api\ProfileController@guestIndex');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('authenticate' , 'App\Http\Controllers\Api\AuthController@authenticate');
    Route::post('changePassword' , 'App\Http\Controllers\Api\UserController@changePassword');
    Route::resource('user', 'App\Http\Controllers\Api\UserController');

    
    Route::resource('ebooks', 'App\Http\Controllers\Api\EbookController');
    Route::resource('products', 'App\Http\Controllers\Api\ProductController');
    Route::resource('programs', 'App\Http\Controllers\Api\ProgramController');

    Route::post('offer/offerClick/{id}', 'App\Http\Controllers\Api\OfferController@offerClick');
    Route::resource('promotions', 'App\Http\Controllers\Api\OfferController');

    Route::resource('promotionshistory', 'App\Http\Controllers\Api\OfferHistoryController');
    
    Route::resource('profile', 'App\Http\Controllers\Api\ProfileController');
});