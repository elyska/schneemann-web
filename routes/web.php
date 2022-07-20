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

Route::get('/', [App\Http\Controllers\GeneralController::class, 'index']);
Route::get('/cs', [App\Http\Controllers\GeneralController::class, 'indexCS']);
Route::get('/en', [App\Http\Controllers\GeneralController::class, 'indexEN']);
