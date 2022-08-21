<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Divission;
use App\Models\Shipping;
use App\Models\Upozila;
use App\Models\Zila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class shippingController extends Controller
{
    public function index()
    {
        $shippings = Shipping::latest()->get();
        $divissions = Divission::latest()->get();
        $zillas = Zila::latest()->get();
        $upozillas = Upozila::latest()->get();
        return view('backend.pages.shipping.index', compact('shippings', 'divissions', 'zillas', 'upozillas'));
    }
    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'divission' => 'required',
            'zilla' => 'required',
            'upozilla' => 'required',
        ]);

        if (!$validator->fails()) {
            $shipping = new shipping();
            $shipping->divission = $request->divission;
            $shipping->zilla = $request->zilla;
            $shipping->upozilla = $request->upozilla;
            $shipping->save();
            return response()->json(['success' => $request->divission,]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request)
    {
        $shipping = shipping::find($request->id);
        return response()->json(['shipping' => $shipping]);
    }

    // edit
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $shipping = shipping::find($request->id);
            $shipping->name = $request->name;
            $shipping->slug = str::slug($request->name);
            $shipping->save();
            return response()->json(['success' => ' shipping Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $shipping = shipping::find($request->id)->delete();
        return response()->json(['success' => ' shipping Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $shipping = shipping::find($request->id);
        if ($shipping->status == 0) {
            $shipping->status = '1';
            $shipping->save();
            return response()->json(['success' => ' shipping Activated Successfully!']);
        } else {
            $shipping->status = '0';
            $shipping->save();
            return response()->json(['success' => ' shipping Deactivated Successfully!']);
        }
    }

    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $shippings = shipping::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($shippings->count() >= 1) {

            return view('backend.pages.shipping.search', compact('shippings'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }
}
