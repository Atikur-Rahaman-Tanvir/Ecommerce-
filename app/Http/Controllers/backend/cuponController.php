<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class cuponController extends Controller
{
    public function index()
    {
        $cupons = cupon::latest()->get();
        return view('backend.pages.cupon.index', compact('cupons'));
    }
    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:cupons,name',
            'discount' => 'required',
        ]);

        if (!$validator->fails()) {
            $cupon = new Cupon();
            $cupon->name = $request->name;
            $cupon->discount = $request->discount;
            $cupon->save();
            return response()->json(['success' => 'New Cupon Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request)
    {
        $cupon = cupon::find($request->id);
        return response()->json(['cupon' => $cupon]);
    }

    // edit
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'discount' => 'required',
        ]);

        if (!$validator->fails()) {
            $cupon = cupon::find($request->id);
            $cupon->name = $request->name;
            $cupon->discount = $request->discount;

            $cupon->save();
            return response()->json(['success' => ' cupon Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $cupon = cupon::find($request->id)->delete();
        return response()->json(['success' => ' cupon Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $cupon = cupon::find($request->id);
        if ($cupon->status == 0) {
            $cupon->status = '1';
            $cupon->save();
            return response()->json(['success' => ' cupon Activated Successfully!']);
        } else {
            $cupon->status = '0';
            $cupon->save();
            return response()->json(['success' => ' cupon Deactivated Successfully!']);
        }
    }

    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $cupons = cupon::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($cupons->count() >= 1) {

            return view('backend.pages.cupon.search', compact('cupons'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }
}


