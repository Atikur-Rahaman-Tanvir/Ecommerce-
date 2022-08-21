<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Billing_information;
use App\Models\Divission;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Order_Summery;
use App\Models\Shipping_Address;
use App\Models\Upozila;
use App\Models\Zila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index(){
        $order_summeries =  Order_Summery::where('user_id', Auth::id())->latest()->take(3)->get();
        return view('frontend.pages.account.myAccount', compact('order_summeries'));
    }

    //order details
    public function order_details($id){
        $order_detail = Order_Detail::where('order__summery_id', $id)->get();
        $billings_address= Billing_information::where('order__summery_id', $id)->first();
        $Shipping_address = Shipping_Address::where('order__summery_id', $id)->first();
        $divission = Divission::select('name')->where('id', $billings_address->b_divission)->first();
        $zilla = Zila::select('name')->where('id', $billings_address->b_zilla)->first();
        $upozilla = Upozila::select('name')->where('id', $billings_address->b_upozilla)->first();

        return view('frontend.pages.account.order_detail', compact('order_detail', 'billings_address', 'Shipping_address', 'divission', 'zilla', 'upozilla'));
    }
}
