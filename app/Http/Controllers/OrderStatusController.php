<?php

namespace App\Http\Controllers;

use App\Models\Order_Summery;
use Illuminate\Http\Request;

class OrderStatusController extends Controller
{
    // prnding
    public function pending(){
        $orders = Order_Summery::where('order_status', 'Pending')->orderBy('created_at', 'ASC')->get();
        return view('backend.pages.inventory.order_status.pending_order', compact('orders'));
    }


    //pending order search
    public function pending_search(Request $request)
    {
        $search =  $request->data;
        if (!is_null($search)) {
            $orders = Order_Summery::where('order_id', 'LIKE', '%' . $request->data . '%')->where('order_status', 'Pending')->get();

            if ($orders->count() >= 1) {
                return view('backend.pages.inventory.order_status.pending_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'Not Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //pending order date_search
    public function pending_date_search(Request $request)
    {
        if (!is_null($request->date)) {

            $orders = Order_Summery::whereDate('created_at', $request->date)->where('order_status', 'Pending')->get();
            if ($orders->count() >= 1) {
                return view('backend.pages.inventory.order_status.pending_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    // packaging
    public function packaging(){
        $orders = Order_Summery::where('order_status', 'Packaging')->orderBy('created_at', 'ASC')->get();
        return view('backend.pages.inventory.order_status.packaging_order', compact('orders'));
    }


    //Packaging order search
    public function packaging_search(Request $request)
    {
        $search =  $request->data;
        if (!is_null($search)) {
            $orders = Order_Summery::where('order_id', 'LIKE', '%' . $request->data . '%')->where('order_status', 'Packaging')->get();

            if ($orders->count() >= 1) {
                return view('backend.pages.inventory.order_status.packaging_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'Not Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //Packaging order date_search
    public function packaging_date_search(Request $request)
    {
        if (!is_null($request->date)) {

            $orders = Order_Summery::whereDate('created_at', $request->date)->where('order_status', 'Packaging')->get();
            if ($orders->count() >= 1) {
                return view('backend.pages.inventory.order_status.packaging_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }







    // shipped
    public function shipped(){
        $orders = Order_Summery::where('order_status', 'Shipped')->orderBy('created_at', 'ASC')->get();
        return view('backend.pages.inventory.order_status.shipped_order', compact('orders'));
    }


    //shipped order search
    public function shipped_search(Request $request)
    {
        $search =  $request->data;
        if (!is_null($search)) {
            $orders = Order_Summery::where('order_id', 'LIKE', '%' . $request->data . '%')->where('order_status', 'Shipped')->get();

            if ($orders->count() >= 1) {
                return view('backend.pages.inventory.order_status.shipped_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'Not Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //shipped order shipped_date_search
    public function shipped_date_search(Request $request)
    {
        if (!is_null($request->date)) {

            $orders = Order_Summery::whereDate('created_at', $request->date)->where('order_status', 'Shipped')->get();
            if ($orders->count() >= 1) {
                return view('backend.pages.inventory.order_status.shipped_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }



    // delivered
    public function delivered(){
        $orders = Order_Summery::where('order_status', 'Delivered')->orderBy('created_at', 'ASC')->get();
        return view('backend.pages.inventory.order_status.delivered_order', compact('orders'));
    }


    //delivered order search
    public function delivered_search(Request $request)
    {
        $search =  $request->data;
        if (!is_null($search)) {
            $orders = Order_Summery::where('order_id', 'LIKE', '%' . $request->data . '%')->where('order_status', 'Delivered')->get();

            if ($orders->count() >= 1) {
                return view('backend.pages.inventory.order_status.delivered_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'Not Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }

    //delivered order date_search
    public function delivered_date_search(Request $request)
    {
        if (!is_null($request->date)) {

            $orders = Order_Summery::whereDate('created_at', $request->date)->where('order_status', 'Delivered')->get();
            if ($orders->count() >= 1) {
                return view('backend.pages.inventory.order_status.delivered_order_search', compact('orders'));
            } else {
                return response()->json(['not_found' => 'No Oder Found']);
            }
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }
    }
}
