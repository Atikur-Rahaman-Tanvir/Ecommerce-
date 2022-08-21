<?php

namespace App\Http\Controllers;


use App\Mail\orderStatus;
use App\Models\Billing_information;
use App\Models\Order;
use App\Models\Order_Summery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



class orderController extends Controller
{
    //all orders
    public function allorder(){
        $orders = Order_Summery::latest()->get();
        return view('backend.pages.order.all_order', compact('orders'));
    }

    //order details
    public function details($id){
        $order = Order_Summery::find($id);
        return view('backend.pages.order.order_details', compact('order'));
    }



    //order status update
    public function status_update(Request $request){
        $order  = Order_Summery::find($request->id);
        $order->order_status = $request->data;
        $order->created_at = Carbon::now();
        $order->save();

        $bill_info = Billing_information::where('order__summery_id', $request->id)->first();
        $user= $bill_info->b_email;
        $data = [
            'name' => $bill_info->b_f_name,
            'order_id' => $order->order_id,
            'order_status' => $request->data,
        ];
        Mail::send('email.orderStatus',$data, function($message) use ($user){
                $message->to($user);
                $message->subject('Order Status');
        });

        return response()->json(['success'=>'Order Status Updated To '.  $request->data, 'order' =>$user]);
    }

    //order search
    public function search(Request $request)
    {
        $search =  $request->data;
        if (!is_null($search)) {
            $orders = Order_Summery::where('order_id', 'LIKE', '%' . $request->data . '%')->get();

            if ($orders->count() >= 1) {
                return view('backend.pages.order.search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'Not Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //order date_search
    public function date_search(Request $request){
        if(!is_null($request->date)){

            $orders = Order_Summery::whereDate('created_at', $request->date)->get();
            if($orders->count() >= 1){
                return view('backend.pages.order.search', compact('orders'));
            }
            else{
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //delete
    public function order_delete(Request $request)
    {
        $tag = Order_Summery::find($request->id)->delete();
        return response()->json(['success' => ' Order Deleted Successfully!', 'id' => $request->id]);
    }


    //payment complete order
    public function payment_complete(){
        $orders = Order_Summery::where('payment_status', 'Complete')->get();
        return view('backend.pages.order.complete.compleate', compact('orders'));
    }

    //payment complete order search
    public function payment_complete_search(Request $request)
    {
        $search =  $request->data;
        if (!is_null($search)) {
            $orders = Order_Summery::where('order_id', 'LIKE', '%' . $request->data . '%')->where('payment_status', 'Complete')->get();


            if ( $orders->count() >= 1) {
                return view('backend.pages.order.complete.complete_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'Not Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //payment complete order date_search
    public function payment_complete_date_search(Request $request)
    {
        if (!is_null($request->date)) {

            $orders = Order_Summery::whereDate('created_at', $request->date)->where('payment_status', 'Complete')->get();
            if ($orders->count() >= 1) {
                return view('backend.pages.order.complete.complete_order_search', compact('orders'));

            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //payment cod order
    public function cod(){
        $orders = Order_Summery::where('payment_status', 'cod')->get();
        return view('backend.pages.order.cod.cod', compact('orders'));
    }

    //payment cod order search
    public function payment_cod_search(Request $request)
    {
        $search =  $request->data;
        if (!is_null($search)) {
            $orders = Order_Summery::where('order_id', 'LIKE', '%' . $request->data . '%')->where('payment_status', 'cod')->get();


            if ( $orders->count() >= 1) {
                return view('backend.pages.order.cod.cod_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'Not Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //payment cod order date_search
    public function payment_cod_date_search(Request $request)
    {
        if (!is_null($request->date)) {

            $orders = Order_Summery::whereDate('created_at', $request->date)->where('payment_status', 'cod')->get();
            if ($orders->count() >= 1) {
                return view('backend.pages.order.cod.cod_order_search', compact('orders'));

            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //payment cancled order
    public function cancled(){
        $orders = Order_Summery::where('payment_status', 'Canceled')->get();
        return view('backend.pages.order.cancled.cancle_payment_order', compact('orders'));
    }

    //payment cancled order search
    public function payment_cancled_search(Request $request)
    {
        $search =  $request->data;
        if (!is_null($search)) {
            $orders = Order_Summery::where('order_id', 'LIKE', '%' . $request->data . '%')->where('payment_status', 'Canceled')->get();


            if ( $orders->count() >= 1) {
                return view('backend.pages.order.cancled.cancled_payment_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'Not Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //payment cancled order date_search
    public function payment_cancled_date_search(Request $request)
    {
        if (!is_null($request->date)) {

            $orders = Order_Summery::whereDate('created_at', $request->date)->where('payment_status', 'Canceled')->get();
            if ($orders->count() >= 1) {
                return view('backend.pages.order.cancled.cancle_payment_order', compact('orders'));

            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }
}
