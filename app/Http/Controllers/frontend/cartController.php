<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Mail\orderPlaceMail;
use App\Models\Billing_Address;
use App\Models\Billing_information;
use App\Models\Cart;
use App\Models\Cupon;
use App\Models\Divission;
use App\Models\Order_Detail;
use App\Models\Order_Summery;
use App\Models\OrderReport;
use App\Models\Product;
use App\Models\Product_report;
use App\Models\Shipping;
use App\Models\Shipping_Address;
use App\Models\Shipping_method;
use App\Models\Test;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class cartController extends Controller
{
    //cart index
    public function index(){
        $carts = Cart::where('user_id', Auth::id())->count();
        if($carts == 0){
            return view('frontend.pages.shop.empty_cart');
        }else{

            return view('frontend.pages.shop.cart');
        }
    }
    // store cart data
    public function store(Request $request)
    {
        $porduct = Product::find($request->product_id);


        if(Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->where('color', $request->color_name)->where('size', $request->size_name)->exists()){
            $new_cart = Cart::where('user_id', Auth::id())->where('product_id', $request->product_id)->get();
             $new_cart[0]->quentity =  $new_cart[0]->quentity+$request->quentity;
            $new_cart[0]->total = $new_cart[0]->quentity *  $new_cart[0]->price;
            $new_cart[0]->save();
            return response()->json(['output' => $new_cart[0]->id ]);
        }
        else{
            $cart = new Cart();
            $cart->product_id = $request->product_id;
            $cart->user_id = Auth::user()->id;
            $cart->color = $request->color_name;
            $cart->size = $request->size_name;
            if($porduct->discount){
                $cart->price = $porduct->price - ($porduct->discount * $porduct->price)/100;
            }else{
               $cart->price = $porduct->price;
            }
            $cart->quentity = $request->quentity;
            $cart->total = $cart->quentity *  $cart->price;
            $cart->save();
            return response()->json(['output' => $request->product_id]);
        }

    }


    //auth check
    public function authCheck(){
       if(Auth::check()){
        return response()->json(['logdIn' => 'Authenticate User']);
       }else{
            return response()->json(['not_log_in' => 'UnAuthenticate User']);
       }
    }

    // remove product form cart
    public function remove_product(Request $request){
        $cart = Cart::find($request->id)->delete();
        return response()->json(['success' => 'Product Delete Successfully!']);

    }

   public function quentity(Request $request){
    $cart = Cart::find($request->cart_id);
    $cart->quentity = $request->quentity;
    $cart->total = $cart->price * $cart->quentity;
    $cart->save();
    return response()->json(['success' => $request->quentity]);
   }


    //clear shopping cart
    public function clearshoppingCart()
    {

        foreach(Cart::all() as $cart){
            $cart->where('user_id', Auth::id())->delete();
        }
        return response()->json(['success' => 'shopping cart clear successfully!']);
    }

    //proceed to checkout
    public function proceedToCheckOut(){
        $divissions = Divission::where('status', true)->get();
        return view('frontend.pages.shop.porceed_to_checkout', compact('divissions'));
    }

    // divission_to_zilla
    public function divission_to_zilla(Request $request){
        $id = $request->id;
        $zillas = Shipping::select('zilla')->where('divission', $id )->get();
        return view('frontend.pages.shop.zilla', compact('zillas'));
    }
    // zilla_to_upozilla
    public function zilla_to_upozilla(Request $request){
        $id = $request->id;
        $upozillas = Shipping::select('upozilla')->where('zilla', $id )->get();
        return view('frontend.pages.shop.upozilla', compact('upozillas'));
    }

    // coupon
    public function coupon(Request $request){
        $coupon = Cupon::where('name', $request->coupon)->get();
        if(Cupon::where('name', $request->coupon)->exists()){
            return response()->json(['success' => $coupon]);
        }
        else{
            return response()->json(['fails' => 'coupon not found']);
        }
    }

    //place order
    public function placeOrder(Request $request){

        $validator = Validator::make($request->all(),[
            'f_name' => 'required',
            'l_name' => 'required',
            'divission' => 'required',
            'zilla' => 'required',
            'upozilla' => 'required',
            'zip_code' => 'required',
            'address' => 'required',
            'b_f_name' => 'required',
            'b_l_name' => 'required',
            'b_divission' => 'required',
            'b_zilla' => 'required',
            'b_upozilla' => 'required',
            'b_zip_code' => 'required',
            'b_address' => 'required',
        ]);

        if(!$validator->fails()){
        // data insert in order summery tabel
        $order_summery = new Order_Summery();
        $order_summery->user_id = Auth::id();
        $order_summery->order_id = uniqid(50);
        $order_summery->cart_total = $request->cart_total;
        $order_summery->coupon_id = $request->coupon_id;
        $order_summery->sipping_price = $request->sipping_price;
        $order_summery->order_total = $request->order_total;
        $order_summery->p_m_input = $request->p_m_input;
        $order_summery->created_at = Carbon::now();

        $delivery_date = Shipping_method::where('price' , $order_summery->sipping_price)->first();
        $order_summery->delivery_date =  Carbon::now()->addDays($delivery_date->delivery_days);
        $order_summery->save();





        //insert data in order report
        if ($request->p_m_input == 1) {
            if(OrderReport::where('created_at', Carbon::today())->exists()){
                $order = OrderReport::where('created_at', Carbon::today())->first();
                $order->cod_payment = $order->cod_payment + 1;
                if ($order_summery->cart_total + $order_summery->sipping_price > $order_summery->order_total) {
                    $order->cod_total = $order->cod_total + ($order_summery->order_total - $order_summery->sipping_price) ;
            }else{
                $order->cod_total = $order->cod_total + $order_summery->cart_total;
            }
                $order->order_total = $order->online_payment + $order->cod_payment;
                $order->cart_total = $order->online_total +  $order->cod_total;
                $order->shipping_total = $order->shipping_total + $order_summery->sipping_price;
                $order->grand_total = $order->cart_total + $order->shipping_total;
                $order->save();
            }else{

                $order_report = new OrderReport();
                $order_report->online_payment = '0';
                $order_report->online_total = '0';
                $order_report->cod_payment = '1';
                if ($order_summery->cart_total + $order_summery->sipping_price > $order_summery->order_total){
                    $order_report->cod_total = $order_summery->order_total - $order_summery->sipping_price ;
                }else{
                    $order_report->cod_total = $order_summery->cart_total;
                }
                $order_report->order_total = $order_report->online_payment + $order_report->cod_payment;
                $order_report->cart_total = $order_report->online_total +  $order_report->cod_total ;
                $order_report->shipping_total = $order_summery->sipping_price;
                $order_report->grand_total = $order_report->cart_total +  $order_report->shipping_total ;
                $order_report->created_at = Carbon::today();
                $order_report->save();
            }

            }
       // data insert in shipping address tabel
        $shipping_address = new Shipping_Address();
        $shipping_address->order__summery_id = $order_summery->id;
        $shipping_address->f_name = $request->f_name;
        $shipping_address->l_name = $request->l_name;
        $shipping_address->email = $request->email;
        $shipping_address->divission = $request->divission;
        $shipping_address->zilla = $request->zilla;
        $shipping_address->upozilla = $request->upozilla;
        $shipping_address->zip_code = $request->zip_code;
        $shipping_address->address = $request->address;
        $shipping_address->save();

       // data insert in billings address tabel
        $billings_address = new Billing_information();
        $billings_address->order__summery_id = $order_summery->id;
        $billings_address->b_f_name = $request->b_f_name;
        $billings_address->b_l_name = $request->b_l_name;
        $billings_address->b_email = $request->b_email;
        $billings_address->b_divission = $request->b_divission;
        $billings_address->b_zilla = $request->b_zilla;
        $billings_address->b_upozilla = $request->b_upozilla;
        $billings_address->b_zip_code = $request->b_zip_code;
        $billings_address->b_address = $request->b_address;
        $billings_address->save();

        //data insert in Orders Delails Table
        foreach(Cart::where('user_id', Auth::id())->get() as $cart){
            $order_detail = new Order_Detail();
            $order_detail->order__summery_id = $order_summery->id;
            $order_detail->user_id = Auth::id();
            $order_detail->product_id = $cart->product_id;
            $order_detail->color = $cart->color;
            $order_detail->size = $cart->size;
            $order_detail->price = $cart->price;
            $order_detail->quentity = $cart->quentity;
            $order_detail->total = $cart->total;


            $order_detail->save();

            Product::where('id', $cart->product_id)->decrement('quentity', $cart->quentity);
            Product::where('id', $cart->product_id)->increment('sell_quentity', $cart->quentity);



            if($request->p_m_input == 1){
                    if (Product_report::where('product_id', $cart->product_id)->where('payment_method', $request->p_m_input)->where('price', $cart->price)->where('buy_price', $cart->product->buy_price)->where('created_at', Carbon::today())->exists()) {
                        Product_report::where('product_id', $cart->product_id)->increment('quentity', $cart->quentity);
                        $product_price = Product_report::where('product_id', $cart->product_id)->where('price', $cart->price)->where('buy_price', $cart->product->buy_price)->first();
                        $product_price->total_price = $product_price->price * $product_price->quentity;

                        $product_price->buy_total_price = $product_price->buy_price * $product_price->quentity;

                        $product_price->save();
                    } else {
                        $product_report = new Product_report();
                        $product_report->product_id = $cart->product_id;
                        $product_report->quentity = $cart->quentity;
                        $product_report->payment_method = $request->p_m_input;
                        $product_report->buy_price = $cart->product->buy_price;
                        $product_report->price = $cart->price;
                        $product_report->total_price = $product_report->price * $product_report->quentity;
                        $product_report->buy_total_price = $cart->product->buy_price * $cart->quentity;
                        $product_report->created_at = Carbon::today();
                        $product_report->save();
                    }
            }
            Cart::where('user_id', Auth::id())->delete();

        }
        if($request->p_m_input == 2){
            session::put('order_summery_id', $order_summery->id);
            Session::put('order_total', $request->order_total);
            return response()->json(['online_payment' => 'online payment']);
        }
        else{

                $place_order_mail =  DB::table('billing_informations')->select('b_email')->where('order__summery_id', $order_summery->id)->first();

                $order_details = Order_Detail::where('order__summery_id',$order_summery->id)->get();
                $order_summery = Order_Summery::where('id', $order_summery->id)->first();

                Mail::to($place_order_mail->b_email)->send(new orderPlaceMail($order_details, $order_summery));

            return response()->json(['cod' => 'cash on delivery']);
        }

        }
        else{
            return response()->json(['fails' => $validator->errors(), 'divission' => $request->divission]);
        }
    }








}













