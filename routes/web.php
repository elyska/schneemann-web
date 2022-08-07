<?php

use Illuminate\Support\Facades\Auth;
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
Route::get('/cart', [App\Http\Controllers\GeneralController::class, 'cart'])->name('cart');

Route::post('/changeLanguage', [App\Http\Controllers\GeneralController::class, 'changeLanguage'])->name('changeLanguage');
Route::post('/add-to-cart', [App\Http\Controllers\GeneralController::class, 'addToCart']);
Route::post('/remove-from-cart', [App\Http\Controllers\GeneralController::class, 'removeFromCart']);
Route::post('/change-quantity', [App\Http\Controllers\GeneralController::class, 'changeQuantity']);

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

// TwoFactor
Route::get('/two-factor', [App\Http\Controllers\TwoFactorController::class, 'index'])->name('verify.index');
Route::get('/send-code', [App\Http\Controllers\TwoFactorController::class, 'sendCode']);

Route::post('/check-code', [App\Http\Controllers\TwoFactorController::class, 'checkCode']);
