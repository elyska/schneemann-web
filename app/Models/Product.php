<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany(Category::class, "category_items");
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function colours()
    {
        return $this->hasMany(ProductColour::class);
    }
}
