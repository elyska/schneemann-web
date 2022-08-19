<?php

namespace App\Classes;

use Illuminate\Http\Request;

class Cart {
    public function countCartItems(Request $request) {
        $cartCount = 0;
        if($request->hasCookie('cartItems')) {
            // get cartItems cookie
            $cookie = $request->cookie('cartItems');
            $cartItems = json_decode($cookie);
            // count items
            $cartCount = count($cartItems);
        }
        return $cartCount;
    }
}
