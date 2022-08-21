<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Shipping_method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class shippingMethodController extends Controller
{
    public function index()
    {
        $shipping_methods = Shipping_method::latest()->get();
        return view('backend.pages.shipping_method.index', compact('shipping_methods'));
    }
    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:shipping_methods,name',
            'price' => 'required',
            'delivery_days' => 'required',
        ]);

        if (!$validator->fails()) {
            $shipping_method = new Shipping_method();
            $shipping_method->name = $request->name;
            $shipping_method->price = $request->price;
            $shipping_method->delivery_days = $request->delivery_days;
            $shipping_method->save();
            return response()->json(['success' => 'New shipping method Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request)
    {
        $shipping_method = shipping_method::find($request->id);
        return response()->json(['shipping_method' => $shipping_method]);
    }

    // edit
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $shipping_method = shipping_method::find($request->id);
            $shipping_method->name = $request->name;
            $shipping_method->price = $request->price;
            $shipping_method->delivery_days = $request->delivery_days;
            $shipping_method->save();
            return response()->json(['success' => ' shipping_method Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $shipping_method = shipping_method::find($request->id)->delete();
        return response()->json(['success' => ' shipping method Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $shipping_method = shipping_method::find($request->id);
        if ($shipping_method->status == 0) {
            $shipping_method->status = '1';
            $shipping_method->save();
            return response()->json(['success' => ' shipping_method Activated Successfully!']);
        } else {
            $shipping_method->status = '0';
            $shipping_method->save();
            return response()->json(['success' => ' shipping_method Deactivated Successfully!']);
        }
    }

    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $shipping_methods = shipping_method::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($shipping_methods->count() >= 1) {

            return view('backend.pages.shipping_method.search', compact('shipping_methods'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }
}
