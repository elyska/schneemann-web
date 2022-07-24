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

Route::post('/changeLanguage', [App\Http\Controllers\GeneralController::class, 'changeLanguage'])->name('changeLanguage');

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['twofactor']);

// TwoFactor
Route::get('/two-factor', [App\Http\Controllers\TwoFactorController::class, 'index'])->name('verify.index');
Route::get('/send-code', [App\Http\Controllers\TwoFactorController::class, 'sendCode']);

Route::post('/check-code', [App\Http\Controllers\TwoFactorController::class, 'checkCode']);
