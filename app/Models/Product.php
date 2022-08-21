<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
       return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')->withTimestamps();
    }
    public function brands()
    {
        return $this->belongsToMany('App\Models\Brand')->withTimestamps();
    }
    public function colors()
    {
        return $this->belongsToMany('App\Models\Color')->withTimestamps();
    }
    public function sizes()
    {
        return $this->belongsToMany('App\Models\Size')->withTimestamps();
    }
    public function product_featured_images()
    {
        return $this->hasMany('App\Models\Product_featured_image');
    }
}

