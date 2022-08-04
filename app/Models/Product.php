<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories() {
        return $this->belongsToMany(Category::class, "category_items");
    }
    public function images() {
        return $this->hasMany(ProductImage::class);
    }
    public function colours() {
        return $this->hasMany(ProductColour::class);
    }

    public function getCartItems($cartItems) {
        $productDetails = [];
        foreach ($cartItems as $item) {
            //$newItem = new stdClass();
            $newItem = self::where("id", $item->productId)->with(['images' => function ($query) {
                $query->where('main', true);
            }, 'colours' => function ($query) use ($item) {
                $query->where('colour', $item->colour);
            }, 'colours.images' => function ($query) {
                $query->where('main', true);
            }])->get()[0];
            // add cart quantity and size to product details
            $newItem->quantity = $item->quantity;
            $newItem->size = $item->size;
            $newItem->colour = $item->colour;

            array_push($productDetails, $newItem);
        }

        return $productDetails;
    }
}
