<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\ColourImage;
use App\Models\Product;
use App\Models\ProductColour;
use App\Models\ProductImage;
use App\Models\ProductSize;
use App\Models\User;
use Database\Factories\ColourImageFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::factory()->create([
            "email" => "eliskaryklova@gmail.com",
            "role" => "admin"
        ]);
        User::factory()->create([
            "email" => "eryklova@gmail.com"
        ]);

        Category::truncate();
        CategoryItem::truncate();
        Product::truncate();
        ProductImage::truncate();
        ProductColour::truncate();
        ColourImage::truncate();
        ProductSize::truncate();


        // each product colour variant has 1 main image and 2 other images
        $mainColourImage = ColourImage::factory()->state([
            'main' => true,
        ]);
        $sizes = ProductSize::factory()->count(2)->state(new Sequence(
            ['size' => 'S'],
            ['size' => 'M'],
            ['size' => 'L'],
        ));
        $productColours = ProductColour::factory()->count(2)->has($sizes, "sizes")->hasImages(2)->has($mainColourImage, "images");
        $productColoursNoSize = ProductColour::factory()->count(2)->hasImages(2)->has($mainColourImage, "images");

        $mainProductImage = ProductImage::factory()->state([
            'main' => true,
        ]);
        $products = Product::factory()->count(3)
            ->hasImages()->has($mainProductImage, "images") // each product colour has 2 images
            ->has($productColours, "colours"); // each product colour has 2 colours

        $productsNoSize = Product::factory()->count(1)
            ->hasImages()->has($mainProductImage, "images") // each product colour has 2 images
            ->has($productColoursNoSize, "colours"); // each product colour has 2 colours

        $productsWithoutColour = Product::factory()->count(2)
            ->hasImages()->has($mainProductImage, "images"); // each product colour has 2 images

        // 3 categories, each category has 3 products, 9 products in total
        Category::factory()->count(3)
            ->has($products)
            ->has($productsNoSize)
            ->has($productsWithoutColour)
            ->create();
    }
}
