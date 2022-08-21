<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Summery extends Model
{
    use HasFactory;
    public function order(){
        return $this->hasOne('App\Models\Order');
    }
    public function order_details(){
        return $this->hasMany('App\Models\Order_Detail');
    }
}
