<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Order_Summery;
use App\Models\Product;
use App\Models\Product_report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;

class inventoryManagement extends Controller
{
    public function inventory_management(){
    $products = Product::orderBy('quentity', 'ASC')->get();
        return view('backend.pages.inventory.index',compact('products'));
    }
    //all product search
    public function product_search(Request $request){
        $search = $request->search;
        if (!is_null($search)) {

            $products = Product::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($products->count() >= 1) {

            return view('backend.pages.inventory.all_product_search', compact('products'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }

    //product report
    public function product_report($id){
        $product_report = Product_report::where('product_id', $id)->get();
        return view('backend.pages.inventory.produc_report', compact('product_report'));
    }
    //cash sell in a day
    public function cash_sell(){
        //  $orders = Order::where('status','Compleate')->get();
        //  $order_summerys = [];
        //  foreach($orders as $order){
        //     $order_summerys[] = $order->order__summery;
        //  }
        //  return $order_summerys;

        //  $order_summerys = Order_Summery::select(
        //     DB::raw('count(*) as count'),
        //     DB::raw('date(created_at) as day'),
        //     DB::raw("sum(cart_total) as cart_total"),
        //     DB::raw("sum(sipping_price) as shipping_price"),
        //     DB::raw("sum(order_total) as order_total"),
        //     )->whereMonth('created_at', date('m'))->where('payment_status', 'Complete')->orderBy('day', 'DESC')->groupBy('day')->get();
            // $orders = Order_Detail::all();


        $product_reports = Product_report::where('payment_method', '2' )->where('created_at', Carbon::today())->get();
        return  view('backend.pages.inventory.cash_sell', compact('product_reports'));

        //   return   $order_details = Order_Detail::select(
        //         DB::raw('count(*) as count'),
        //         DB::raw('date(created_at) as day'),
        //         // DB::raw('count(product_id) as product'),
        //         DB::raw('select(product_id)'),
        //         DB::raw('sum(quentity) as quentity'),
        //      )->whereMonth('created_at', date('m'))->groupBy('day')->get();

        // return $order_details = Order_Detail::select('product_id',DB::raw('date(created_at) as day'))->whereMonth('created_at', date('m'))->get();
    }

    //date_search
    //order date_search
    public function date_search(Request $request)
    {
        if (!is_null($request->date)) {

            $product_reports = Product_report::whereDate('created_at', $request->date)->where('payment_method', 2)->get();
            if ($product_reports->count() >= 1) {
                return view('backend.pages.inventory.date_search', compact('product_reports'));
            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }


    //cod sell
    public function cod_sell(){

        $product_reports = Product_report::where('payment_method', '1')->where('created_at', Carbon::today())->get();
        return  view('backend.pages.inventory.cod_sell', compact('product_reports'));
    }

    //order coddate_search
    public function cod_date_search(Request $request)
    {
        if (!is_null($request->date)) {

            $product_reports = Product_report::whereDate('created_at', $request->date)->where('payment_method', '1')->get();
            if ($product_reports->count() >= 1) {
                return view('backend.pages.inventory.cod_date_search', compact('product_reports'));
            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

}
