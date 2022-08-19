<?php

namespace App\Classes;


class CurrencyConversion {
    public function EURtoCZK($price_eur) {
        return $price_eur * 25;
    }

    public function CZKtoEUR($price_czk) {
        return $price_czk / 25;
    }
}
