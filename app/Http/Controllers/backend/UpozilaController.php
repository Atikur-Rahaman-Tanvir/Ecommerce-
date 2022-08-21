<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Upozila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UpozilaController extends Controller
{
    public function index()
    {
        $upozilas = upozila::latest()->get();
        return view('backend.pages.upozila.index', compact('upozilas'));
    }
    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:upozilas,name',
        ]);

        if (!$validator->fails()) {
            $upozila = new upozila();
            $upozila->name = $request->name;
            $upozila->slug = str::slug($request->name);
            $upozila->save();
            return response()->json(['success' => 'New upozila Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request)
    {
        $upozila = upozila::find($request->id);
        return response()->json(['upozila' => $upozila]);
    }

    // edit
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $upozila = upozila::find($request->id);
            $upozila->name = $request->name;
            $upozila->slug = str::slug($request->name);
            $upozila->save();
            return response()->json(['success' => ' upozila Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $upozila = upozila::find($request->id)->delete();
        return response()->json(['success' => ' upozila Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $upozila = Upozila::find($request->id);
        if ($upozila->status == 0) {
            $upozila->status = '1';
            $upozila->save();
            return response()->json(['success' => ' upozila Activated Successfully!']);
        } else {
            $upozila->status = '0';
            $upozila->save();
            return response()->json(['success' => ' upozila Deactivated Successfully!']);
        }
    }

    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $upozilas = upozila::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($upozilas->count() >= 1) {

            return view('backend.pages.upozila.search', compact('upozilas'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }
}
