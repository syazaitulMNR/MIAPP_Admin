<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\EBookController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\OfferHistoryController;

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
    return view('auth.login');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

// EBook
Route::get('ebooks',[ EBookController::class, 'index'])->name('ebooks');
Route::get('ebook/create',[ EBookController::class, 'create'])->name('ebook.create');
Route::post('ebook/save',[ EBookController::class, 'store'])->name('ebook.save');
Route::get('ebook/edit/{id}',[ EBookController::class, 'edit'])->name('ebook.edit');
Route::post('ebook/update/{id}',[ EBookController::class, 'update'])->name('ebook.update');
Route::post('ebook/delete/{id}',[ EBookController::class, 'destroy'])->name('ebook.destroy');

// Program
Route::get('programs',[ ProgramController::class, 'index'])->name('programs');
Route::get('program/create',[ ProgramController::class, 'create'])->name('program.create');
Route::post('program/save',[ ProgramController::class, 'store'])->name('program.save');
Route::get('program/edit/{id}',[ ProgramController::class, 'edit'])->name('program.edit');
Route::post('program/update/{id}',[ ProgramController::class, 'update'])->name('program.update');
Route::post('program/delete/{id}',[ ProgramController::class, 'destroy'])->name('program.destroy');

// Product
Route::get('products',[ ProductController::class, 'index'])->name('products');
Route::get('product/create',[ ProductController::class, 'create'])->name('product.create');
Route::post('product/save',[ ProductController::class, 'store'])->name('product.save');
Route::get('product/edit/{id}',[ ProductController::class, 'edit'])->name('product.edit');
Route::post('product/update/{id}',[ ProductController::class, 'update'])->name('product.update');
Route::post('product/delete/{id}',[ ProductController::class, 'destroy'])->name('product.destroy');

// Offer
Route::get('promotions',[ OfferController::class, 'index'])->name('offers');
Route::get('promotion/create',[ OfferController::class, 'create'])->name('offer.create');
Route::post('promotion/save',[ OfferController::class, 'store'])->name('offer.save');
Route::get('promotion/edit/{offer_id}',[ OfferController::class, 'edit'])->name('offer.edit');
Route::post('promotion/update/{offer_id}',[ OfferController::class, 'update'])->name('offer.update');
Route::post('promotion/delete/{offer_id}',[ OfferController::class, 'destroy'])->name('offer.destroy');

// User
Route::get('users',[ UserController::class, 'index'])->name('users');
Route::get('user/view/{id}',[ UserController::class, 'view'])->name('user.view');


Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

