<?php

namespace Tests\Unit;

use App\Models\ShippingPrice;
use Tests\TestCase;
use stdClass;

class ShippingTest extends TestCase
{
    // php artisan test --filter ShippingTest
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_weight()
    {
        $item = new stdClass();
        $item->productId = 2;
        $item->quantity = 5;
        $item->colour = "praesentium";
        $item->size = "L";
        $item->weight = 0.8;

        $item2 = new stdClass();
        $item2->productId = 1;
        $item2->quantity = 2;
        $item2->colour = "ex";
        $item2->size = "S";
        $item2->weight = 0.3;

        $weight = ShippingPrice::getWeight([$item, $item2]);

        $this->assertTrue($weight == 5 * 0.8 + 2 * 0.3);
    }

    public function test_price() {

        $price = ShippingPrice::priceFromWeight("Czech Republic", 0.2);
        $this->assertTrue($price == 60);

        $price = ShippingPrice::priceFromWeight("Czech Republic", 10);
        $this->assertTrue($price == 119);

        $price = ShippingPrice::priceFromWeight("Slovakia", 1.9);
        $this->assertTrue($price == 250);

        $price = ShippingPrice::priceFromWeight("Slovakia", 3);
        $this->assertTrue($price == 275);

    }
}
