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

Auth::routes(['verify' => true]);

// General
Route::get('/', [App\Http\Controllers\GeneralController::class, 'index']);
Route::get('/products', [App\Http\Controllers\GeneralController::class, 'products'])->name('products');
Route::get('/products/{url}', [App\Http\Controllers\GeneralController::class, 'productDetail']);
Route::get('/products/{url}/{colour}', [App\Http\Controllers\GeneralController::class, 'productDetailColour']);

Route::post('/changeLanguage', [App\Http\Controllers\GeneralController::class, 'changeLanguage'])->name('changeLanguage');
Route::post('/add-to-cart', [App\Http\Controllers\GeneralController::class, 'addToCart']);

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['twofactor']);

// TwoFactor
Route::get('/two-factor', [App\Http\Controllers\TwoFactorController::class, 'index'])->name('verify.index');
Route::get('/send-code', [App\Http\Controllers\TwoFactorController::class, 'sendCode']);

Route::post('/check-code', [App\Http\Controllers\TwoFactorController::class, 'checkCode']);
