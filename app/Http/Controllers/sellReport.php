<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order_Summery;
use App\Models\OrderReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sellReport extends Controller
{
    //monthly order report
    public function order_sell_report(){
        $daily_order = OrderReport::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->orderBy('created_at', 'ASC')->get();
        $this_month = Carbon::now()->format('M Y');
        $total = OrderReport::select(
            DB::raw("month(created_at) as month"),
            DB::raw("sum(online_payment) as online_payment"),
            DB::raw("sum(online_total) as online_total"),
            DB::raw("sum(cod_payment) as cod_payment"),
            DB::raw("sum(cod_total) as cod_total"),
            DB::raw("sum(cart_total) as cart_total"),
            DB::raw("sum(shipping_total) as shipping_total"),
            DB::raw("sum(grand_total) as grand_total"),
            DB::raw("sum(order_total) as order_total"),
            )->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->orderBy('created_at', 'ASC')->groupBy('month')->first();
        return view('backend.pages.order.report.montyly_order_report', compact('daily_order', 'this_month','total'));
    }

    //monthly order report date serach
    public function order_sell_report_date(Request $request){
        if (!is_null($request->date)) {
            $date = explode('-', $request->date);
            $year = $date[0];
            $month = $date[1];

            $total = OrderReport::select(
                DB::raw("month(created_at) as month"),
                DB::raw("sum(online_payment) as online_payment"),
                DB::raw("sum(online_total) as online_total"),
                DB::raw("sum(cod_payment) as cod_payment"),
                DB::raw("sum(cod_total) as cod_total"),
                DB::raw("sum(cart_total) as cart_total"),
                DB::raw("sum(shipping_total) as shipping_total"),
                DB::raw("sum(grand_total) as grand_total"),
                DB::raw("sum(order_total) as order_total"),
            )->whereMonth('created_at', $month)->whereYear('created_at', $year)->groupBy('month')->first();

            // return response()->json(['hi' => 'hi']);

            $daily_order = OrderReport::whereMonth('created_at', $month)->whereYear('created_at', $year)->orderBy('created_at', 'ASC')->get();
            if ($daily_order->count() >= 1) {
                // $this_month = $daily_order[0]->created_at->format('M Y');
                return view('backend.pages.order.report.montyly_order_report_date_search', compact('daily_order', 'total'));
            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //yearly order report
    public function yearly_order_sell_report()
    {
        $this_year = Carbon::now()->format('Y');
         $monthly_order = OrderReport::select(
            DB::raw("monthName(created_at) as month"),
            DB::raw("sum(online_payment) as online_payment"),
            DB::raw("sum(online_total) as online_total"),
            DB::raw("sum(cod_payment) as cod_payment"),
            DB::raw("sum(cod_total) as cod_total"),
            DB::raw("sum(cart_total) as cart_total"),
            DB::raw("sum(shipping_total) as shipping_total"),
            DB::raw("sum(grand_total) as grand_total"),
            DB::raw("sum(order_total) as order_total"),
        )->whereYear('created_at', Carbon::now()->year)->groupBy('month')->orderBy('created_at', 'ASC')->get();
         $total = OrderReport::select(
            DB::raw("Year(created_at) as year"),
            DB::raw("sum(online_payment) as online_payment"),
            DB::raw("sum(online_total) as online_total"),
            DB::raw("sum(cod_payment) as cod_payment"),
            DB::raw("sum(cod_total) as cod_total"),
            DB::raw("sum(cart_total) as cart_total"),
            DB::raw("sum(shipping_total) as shipping_total"),
            DB::raw("sum(grand_total) as grand_total"),
            DB::raw("sum(order_total) as order_total"),
        )->whereYear('created_at', Carbon::now()->year)->groupBy('year')->first();
        return view('backend.pages.order.report.yearly_order_report', compact('monthly_order', 'this_year', 'total'));
    }


    //yearly order report date serach
    public function yearly_order_sell_report_delete(Request $request)
    {
        if (!is_null($request->date)) {
            $date = explode('-', $request->date);
            $year = $date[0];
            $monthly_order = OrderReport::select(
                DB::raw("monthName(created_at) as month"),
                DB::raw("sum(online_payment) as online_payment"),
                DB::raw("sum(online_total) as online_total"),
                DB::raw("sum(cod_payment) as cod_payment"),
                DB::raw("sum(cod_total) as cod_total"),
                DB::raw("sum(cart_total) as cart_total"),
                DB::raw("sum(shipping_total) as shipping_total"),
                DB::raw("sum(grand_total) as grand_total"),
                DB::raw("sum(order_total) as order_total"),
            )->whereYear('created_at', $year)->groupBy('month')->orderBy('created_at', 'ASC')->get();
            $total = OrderReport::select(
                DB::raw("Year(created_at) as year"),
                DB::raw("sum(online_payment) as online_payment"),
                DB::raw("sum(online_total) as online_total"),
                DB::raw("sum(cod_payment) as cod_payment"),
                DB::raw("sum(cod_total) as cod_total"),
                DB::raw("sum(cart_total) as cart_total"),
                DB::raw("sum(shipping_total) as shipping_total"),
                DB::raw("sum(grand_total) as grand_total"),
                DB::raw("sum(order_total) as order_total"),
            )->whereYear('created_at', $year)->groupBy('year')->first();


            if ($monthly_order->count() >= 1) {
                // $this_year = $monthly_order[0]->created_at->format('Y');
                return view('backend.pages.order.report.yearly_order_report_date_search', compact('monthly_order', 'total'));
            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

}
