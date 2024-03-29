<?php

use App\Models\Product;
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

// Mail preview
Route::get('/mailable', function (\Illuminate\Http\Request $request) {

    $cookieObj = json_decode($request->cookie('cartItems'));
    $products = Product::getCartItems($cookieObj);
    return new App\Mail\OrderConfirmation($products, 2500, 100, 25, 1, true);
});

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

// Order
Route::get('/delivery-payment-selection', [App\Http\Controllers\OrderController::class, 'deliveryPaymentPage'])->name('deliveryPayment');
Route::get('/contact-details', [App\Http\Controllers\OrderController::class, 'contactDetailsPage']);
Route::get('/order-success', [App\Http\Controllers\OrderController::class, 'orderSuccessPage'])->name('orderSuccess');

Route::post('/select-destination', [App\Http\Controllers\OrderController::class, 'selectDestination']);
Route::post('/contact-form', [App\Http\Controllers\OrderController::class, 'contactForm']);

// Home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin
Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

// TwoFactor
Route::get('/two-factor', [App\Http\Controllers\TwoFactorController::class, 'index'])->name('verify.index');
Route::get('/send-code', [App\Http\Controllers\TwoFactorController::class, 'sendCode']);

Route::post('/check-code', [App\Http\Controllers\TwoFactorController::class, 'checkCode']);
