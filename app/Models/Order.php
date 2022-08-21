<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function order__summery()
    {
        return $this->belongsTo('App\Models\Order_Summery');
    }
}
