<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingPrice extends Model
{
    use HasFactory;

    public function getCountries() {
        $countries = self::select("country")->distinct()->get();
        return $countries;
    }

    function getWeight($products) {
        // calculate total weight
        $contentWeight = 0;
        foreach ($products as $product) {
            $contentWeight += $product->weight * $product->quantity;
        }

        return $contentWeight;
    }

    function priceFromWeight($destination, $weight) {
        // if weight is in the table
        $price = self::select("price_czk")->where("country", $destination)->where("weight", ">=", $weight)->min("price_czk");
        // if weight is out of weight range, apply highest rate
        if (is_null($price)) $price = self::select("price_czk")->where("country", $destination)->max("price_czk");
        // if no price is found
        if (is_null($price)) $price = 300;

        return $price;
    }


    public function getPrice($destination, $products) {
        // calculate total weight
        $contentWeight = self::getWeight($products);

        $price = self::priceFromWeight($destination, $contentWeight);

        return $price; // returns price in CZK
    }
}
