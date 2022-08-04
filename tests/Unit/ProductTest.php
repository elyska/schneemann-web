<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\TestCase;
use stdClass;

class ProductTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_one_item()
    {
        $item = new stdClass();
        $item->productId = 2;
        $item->quantity = 5;
        $item->colour = "praesentium";
        $item->size = "L";

        $productDetails = Product::getCartItems([$item])[0];
        $this->assertTrue($productDetails->id == $item->productId);
        $this->assertTrue($productDetails->colours[0]->colour == $item->colour);
        $this->assertTrue($productDetails->colours[0]->images[0]->file_name == "dolores.png");
        $this->assertTrue($productDetails->quantity == $item->quantity);
        $this->assertTrue($productDetails->size == $item->size);

    }
    public function test_two_items()
    {
        $item = new stdClass();
        $item->productId = 2;
        $item->quantity = 5;
        $item->colour = "praesentium";
        $item->size = "L";

        $item2 = new stdClass();
        $item2->productId = 7;
        $item2->quantity = 3;
        $item2->colour = "fuga";
        $item2->size = "S";

        $productDetails = Product::getCartItems([$item, $item2])[0];
        $this->assertTrue($productDetails->id == $item->productId);
        $this->assertTrue($productDetails->colours[0]->colour == $item->colour);
        $this->assertTrue($productDetails->colours[0]->images[0]->file_name == "dolores.png");
        $this->assertTrue($productDetails->quantity == $item->quantity);
        $this->assertTrue($productDetails->size == $item->size);

        $productDetails = Product::getCartItems([$item, $item2])[1];
        $this->assertTrue($productDetails->id == $item2->productId);
        $this->assertTrue($productDetails->colours[0]->colour == $item2->colour);
        $this->assertTrue($productDetails->colours[0]->images[0]->file_name == "nemo.png");
        $this->assertTrue($productDetails->quantity == $item2->quantity);
        $this->assertTrue($productDetails->size == $item2->size);
    }
    public function test_no_size()
    {
        $item = new stdClass();
        $item->productId = 4;
        $item->quantity = 1;
        $item->colour = "neque";
        $item->size = null;

        $productDetails = Product::getCartItems([$item])[0];
        $this->assertTrue($productDetails->id == $item->productId);
        $this->assertTrue($productDetails->colour == $item->colour);
        $this->assertTrue($productDetails->colours[0]->images[0]->file_name == "earum.png");
        $this->assertTrue($productDetails->quantity == $item->quantity);
        $this->assertTrue($productDetails->size == $item->size);
    }
    public function test_no_colour()
    {
        $item = new stdClass();
        $item->productId = 5;
        $item->quantity = 7;
        $item->colour = null;
        $item->size = null;

        $productDetails = Product::getCartItems([$item])[0];
        $this->assertTrue($productDetails->id == $item->productId);
        $this->assertTrue(count($productDetails->colours) == 0);
        $this->assertTrue($productDetails->colour == $item->colour);
        $this->assertTrue($productDetails->quantity == $item->quantity);
        $this->assertTrue($productDetails->size == $item->size);
    }
}
