<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Category::truncate();
        CategoryItem::truncate();
        Product::truncate();

        Category::factory()->times(5)->hasCategories(2)->create();
        //Product::factory()->times(10)->hasCategories(2)->create();
    }
}
