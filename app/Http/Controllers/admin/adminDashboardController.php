<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order_Summery;
use App\Models\Product_report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;

class adminDashboardController extends Controller
{
    public function home()
    {
        $today_order = Order_Summery::whereDate('created_at', Carbon::today())->where('payment_status', 'Complete')->orWhere('payment_status', 'cod')->count();
        $total_order = Order_Summery::where('payment_status', 'Complete')->orWhere('payment_status', 'cod')->count();
        $today_total_sell = Product_report::where('created_at', Carbon::today())->sum('total_price');
        $today_total_buy = Product_report::where('created_at', Carbon::today())->sum('buy_total_price');
        $today_profit = $today_total_sell - $today_total_buy;
        $today_total_buy = Product_report::where('created_at', Carbon::today())->sum('buy_total_price');

        // return $today_total_buy = Product_report::whereMonth('created_at', Carbon::now()->month)->orderBy('created_at', 'ASC')->get();
         $today_total_buy = Carbon::now()->month;

       $test =Product_report::whereYear('created_at', '=', 2022)
            ->whereMonth('created_at', '=', 8)->whereDay('created_at', 16)
            ->get();




        // return $daily_order[0];

        return view('backend.pages.home', compact('total_order', 'today_order', 'today_total_sell', 'today_profit','test'));
    }
}
