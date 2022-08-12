<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ShippingPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    public function deliveryPaymentPage(Request $request) {
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

        return view('delivery-payment-selection',[
            "countries" => $countries,
            "cartItems" => $cartProducts,
            "postageEUR" => $postageEUR,
            "postageCZK" => $postageCZK,
            "subtotalEUR" => $subtotalEUR
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
            $postageEUR = $postageCZK / 25;
        }

        // get subtotal in EUR
        $subtotalEUR = Product::getSubtotal($cartProducts);

        return view("layouts.partials.order-summary", [
            "cartItems" => $cartProducts,
            "postageEUR" => $postageEUR,
            "postageCZK" => $postageCZK,
            "subtotalEUR" => $subtotalEUR
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
}
