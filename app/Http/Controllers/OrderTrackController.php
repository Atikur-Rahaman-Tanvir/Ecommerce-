<?php

namespace App\Http\Controllers;

use App\Models\Billing_information;
use App\Models\Divission;
use App\Models\Order_Summery;
use App\Models\Shipping_Address;
use App\Models\Upozila;
use App\Models\Zila;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderTrackController extends Controller
{
    //track order
    public function orderTrack(Request $request){

        $validator = Validator::make($request->all(),[
            'orderId' => 'required',
            'billingEmail'  => 'required',
        ]);

        if(!$validator->fails()){
            if(Order_Summery::where('order_id', $request->orderId)->exists()&& Billing_information::where('b_email', $request->billingEmail)->exists()){
                $order = Order_Summery::where('order_id', $request->orderId)->first();
                $shipping = Shipping_Address::where('order__summery_id', $order->id)->first();
                $divission = Divission::where('id', $shipping->divission)->first();
                $Zilla = Zila::where('id', $shipping->zilla)->first();
                $upozilla = Upozila::where('id', $shipping->upozilla)->first();
                // $shipping_address = $upozilla->name, $Zilla->name, $divission->name, $shipping->shipping->address;

                if($order->payment_status == 'Complete' || $order->payment_status == 'cod'  && $order->order_status == "Pending"){
                    return response()->json(['order_placed' => 'Your Order Is placed.', 'order' => $order, 'shipping' => $shipping, 'order_date' => $order->created_at->format('d M Y'), 'delivery_date' => $order->delivery_date, 'divission' => $divission->name, 'zilla' => $Zilla->name, 'upozilla' => $upozilla->name]);
                }
                elseif ($order->payment_status == 'Complete' || $order->payment_status == 'cod'  && $order->order_status == "Packaging"){
                    return response()->json(['order_packaing' => 'Your Order Pepare to ship','order' => $order, 'shipping' => $shipping, 'order_date' => $order->created_at->format('d M Y'), 'delivery_date' => $order->delivery_date, 'divission' => $divission->name, 'zilla' => $Zilla->name, 'upozilla' => $upozilla->name]);
                }
                elseif($order->payment_status == 'Complete' || $order->payment_status == 'cod'  && $order->order_status == "Shipped"){
                    return response()->json(['order_shipped' => 'Your Order is shipped','order' => $order, 'shipping' => $shipping, 'order_date' => $order->created_at->format('d M Y'), 'delivery_date' => $order->delivery_date, 'divission' => $divission->name, 'zilla' => $Zilla->name, 'upozilla' => $upozilla->name]);
                }
                elseif($order->payment_status == 'Complete' || $order->payment_status == 'cod'  && $order->order_status == "Delivered"){
                    return response()->json(['order_delivered' => 'Your Order is Delivered','order' => $order, 'shipping' => $shipping, 'order_date' => $order->created_at->format('d M Y'), 'delivery_date' => $order->delivery_date, 'divission' => $divission->name, 'zilla' => $Zilla->name, 'upozilla' => $upozilla->name]);
                }
                return response()->json(['success' => 'ok']);
            }
            else{
                return response()->json(['order_not_found' => 'Order Not Found.']);
            }
        }
        else{

            return response()->json(['errors' => $validator->errors()]);
        }
        }
    }

