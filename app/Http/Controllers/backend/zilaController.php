<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Zila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class zilaController extends Controller
{
    public function index()
    {
        $zilas = zila::latest()->get();
        return view('backend.pages.zila.index', compact('zilas'));
    }
    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:zilas,name',
        ]);

        if (!$validator->fails()) {
            $zila = new zila();
            $zila->name = $request->name;
            $zila->slug = str::slug($request->name);
            $zila->save();
            return response()->json(['success' => 'New zila Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request)
    {
        $zila = zila::find($request->id);
        return response()->json(['zila' => $zila]);
    }

    // edit
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $zila = zila::find($request->id);
            $zila->name = $request->name;
            $zila->slug = str::slug($request->name);
            $zila->save();
            return response()->json(['success' => ' zila Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $zila = Zila::find($request->id)->delete();
        return response()->json(['success' => ' zila Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $zila = zila::find($request->id);
        if ($zila->status == 0) {
            $zila->status = '1';
            $zila->save();
            return response()->json(['success' => ' zila Activated Successfully!']);
        } else {
            $zila->status = '0';
            $zila->save();
            return response()->json(['success' => ' zila Deactivated Successfully!']);
        }
    }

    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $zilas = zila::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($zilas->count() >= 1) {

            return view('backend.pages.zila.search', compact('zilas'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }

}
