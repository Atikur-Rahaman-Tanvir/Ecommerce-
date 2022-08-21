<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_report extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
