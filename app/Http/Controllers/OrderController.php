<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Classes\CurrencyConversion;
use App\Mail\OrderConfirmation;
use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function deliveryPaymentPage(Request $request) {
        // check if cart is not empty
        $cartCount = Cart::countCartItems($request);
        if ($cartCount == 0) return redirect()->route('cart');

        // get countries for selection
        $countries = ShippingPrice::getCountries();

        // get cartItems cookie
        $cookie = $request->cookie('cartItems');
        $cookieObj = json_decode($cookie);
        // get cartItems
        $cartProducts = Product::getCartItems($cookieObj);

        // set postage to null
        $postageCZK = null;
        $postageEUR = null;

        $destination = null;
        // get shipping price if the destination is set
        if($request->hasCookie('destination')) {
            // get the destination from cookies
            $destination = $request->cookie('destination');
            // get shipping price in CZK
            $postageCZK = ShippingPrice::getPrice($destination, $cartProducts);
            $postageEUR = $postageCZK / 25;
        }

        // get subtotal in EUR
        $subtotalEUR = Product::getSubtotal($cartProducts);
        $subtotalCZK = CurrencyConversion::EURtoCZK($subtotalEUR);

        return view('delivery-payment-selection',[
            "countries" => $countries,
            "cartItems" => $cartProducts,
            "postageEUR" => $postageEUR,
            "postageCZK" => $postageCZK,
            "subtotalEUR" => $subtotalEUR,
            "subtotalCZK" => $subtotalCZK,
        ]);
    }

    public function selectDestination(Request $request) {
        // save payment selection to cookies
        $payment = $request->get("payment");
        Cookie::queue('payment', $payment, 43800);

        // get cartItems
        $cookie = $request->cookie('cartItems');
        $cookieObj = json_decode($cookie);
        $cartProducts = Product::getCartItems($cookieObj);

        // set postage to null
        $postageCZK = null;
        $postageEUR = null;

        // save destination to cookies if destination was selected
        $destination = $request->get("destination");
        if($destination) {
            Cookie::queue('destination', $destination, 43800);
            // get shipping price in CZK
            $postageCZK = ShippingPrice::getPrice($destination, $cartProducts);
            $postageEUR = CurrencyConversion::CZKtoEUR($postageCZK);
        }

        // get subtotal in EUR
        $subtotalEUR = Product::getSubtotal($cartProducts);
        $subtotalCZK = CurrencyConversion::EURtoCZK($subtotalEUR);

        return view("layouts.partials.order-summary", [
            "cartItems" => $cartProducts,
            "postageEUR" => $postageEUR,
            "postageCZK" => $postageCZK,
            "subtotalEUR" => $subtotalEUR,
            "subtotalCZK" => $subtotalCZK,
        ]);

    }

    public function contactDetailsPage(Request $request) {

        // if the destination is not set, return to the delivery summary page
        if(!$request->hasCookie('destination')) return redirect("/delivery-payment-selection")->with('status', 'Select destination');

        // get the destination from cookies
        $destination = $request->cookie('destination');

        return view('contact-form',[
            "destination" => $destination
        ]);
    }

    public function contactForm(Request $request) {
        // validate inputs
        $request->validate([
            "name" => 'required|string|max:255',
            "email" => 'required|email|max:60',
            "phone" => 'required|string|max:20',
            "delAddressLine1" => 'required|string|max:80',
            "delAddressLine2" => 'nullable|string|max:80',
            "delAddressLine3" => 'nullable|string|max:80',
            "delCity" => 'required|string|max:80',
            "delPostcode" => 'required|string|max:15',
            "bilAddressLine1" => 'required_if:sameBilAddress,false|max:80',
            "bilAddressLine2" => 'nullable|string|max:80',
            "bilAddressLine3" => 'nullable|string|max:80',
            "bilCity" => 'required_without:sameBilAddress|max:80',
            "bilPostcode" => 'required_without:sameBilAddress|max:15',
            "bilCountry" => 'required_without:sameBilAddress|max:60',
            "agreement" => 'required'
        ]);

        // get currency
        if(App::isLocale('cs')) $currency = "CZK";
        else $currency = "EUR";

        // get destination
        $destination = $request->cookie('destination');

        // get cartItems
        $cookieObj = json_decode($request->cookie('cartItems'));
        $products = Product::getCartItems($cookieObj);

        // get shipping price
        $postageCZK = ShippingPrice::getPrice($destination, $products);
        $postageEUR = CurrencyConversion::CZKtoEUR($postageCZK);

        // get total price
        $subtotalEUR = Product::getSubtotal($products);
        $subtotalCZK = CurrencyConversion::EURtoCZK($subtotalEUR);

        // save order details and order items
        Order::insertOrder($request, $destination, $products, $subtotalCZK, $subtotalEUR, $postageCZK, $postageEUR);

        // send emails
        $email = $request->get("email");
        $transfer = false;
        if($request->hasCookie("payment")) {
            // get payment cookie
            $payment = $request->cookie('payment');
            if ($payment == "transfer") $transfer = true;
        }
        Mail::to($email)->send(new OrderConfirmation($products, $subtotalCZK, $subtotalEUR, $postageCZK, $postageEUR, $transfer));

        // set orderSent cookie
        Cookie::queue('order-success', true, 43800);

        // reset cookies
        Cookie::queue(Cookie::forget('cartItems'));
        Cookie::queue(Cookie::forget('destination'));
        Cookie::queue(Cookie::forget('payment'));

        return redirect()->route('orderSuccess');
    }

    public function orderSuccessPage(Request $request) {

        if(!$request->hasCookie('order-success')) return redirect("/contact-details");

        Cookie::queue(Cookie::forget('order-success'));

        return view('order-success',[
        ]);
    }
}
