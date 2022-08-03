<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColourImage extends Model
{
    use HasFactory;
    public function colour()
    {
        return $this->belongsTo(ProductColour::class);
    }
}
