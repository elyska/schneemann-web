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

            $details = self::where("id", $item->productId)->with(['images' => function ($query) {
                $query->where('main', true);
            }, 'colours' => function ($query) use ($item) {
                $query->where('colour', $item->colour);
            }, 'colours.images' => function ($query) {
                $query->where('main', true);
            }])->get()[0];

            // add cart quantity and size to product details
            /*$newItem = new stdClass();
            $newItem->quantity = $item->quantity;
            $newItem->size = $item->size;
            $newItem->colour = $item->colour;*/

            $item->title_cz = $details->title_cz;
            $item->price = $details->price;
            $item->url = $details->url;

            // add correct image
            if(count($details->colours) == 0) $item->image = $details->images[0]->file_name;
            else $item->image = $details->colours[0]->images[0]->file_name;


            //array_push($productDetails, $newItem);
        }

        return $cartItems;
    }
}
