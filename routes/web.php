<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EBookController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\OfferHistoryController;
use App\Http\Controllers\ApplicableToController;

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
    return view('welcome');
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
Route::get('program/edit/{program_id}',[ ProgramController::class, 'edit'])->name('program.edit');
Route::post('program/update/{program_id}',[ ProgramController::class, 'update'])->name('program.update');
Route::post('program/delete/{program_id}',[ ProgramController::class, 'destroy'])->name('program.destroy');

// Product
Route::get('products',[ ProductController::class, 'index'])->name('products');
Route::get('product/create',[ ProductController::class, 'create'])->name('product.create');
Route::post('product/save',[ ProductController::class, 'store'])->name('product.save');
Route::get('product/edit/{product_id}',[ ProductController::class, 'edit'])->name('product.edit');
Route::post('product/update/{product_id}',[ ProductController::class, 'update'])->name('product.update');
Route::post('product/delete/{product_id}',[ ProductController::class, 'destroy'])->name('product.destroy');

// Offer
Route::get('offers',[ OfferController::class, 'index'])->name('offers');
Route::get('offer/create',[ OfferController::class, 'create'])->name('offer.create');
Route::post('offer/save',[ OfferController::class, 'store'])->name('offer.save');
Route::get('offer/edit/{offer_id}',[ OfferController::class, 'edit'])->name('offer.edit');
Route::post('offer/update/{offer_id}',[ OfferController::class, 'update'])->name('offer.update');
Route::post('offer/delete/{offer_id}',[ OfferController::class, 'destroy'])->name('offer.destroy');

// Applicable_to

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

