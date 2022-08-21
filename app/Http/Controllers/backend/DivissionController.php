<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Divission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DivissionController extends Controller
{
    public function index()
    {
        $divissions = Divission::latest()->get();
        return view('backend.pages.divission.index', compact('divissions'));
    }
    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:divissions,name',
        ]);

        if (!$validator->fails()) {
            $divission = new divission();
            $divission->name = $request->name;
            $divission->slug = str::slug($request->name);
            $divission->save();
            return response()->json(['success' => 'New divission Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request)
    {
        $divission = divission::find($request->id);
        return response()->json(['divission' => $divission]);
    }

    // edit
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $divission = divission::find($request->id);
            $divission->name = $request->name;
            $divission->slug = str::slug($request->name);
            $divission->save();
            return response()->json(['success' => ' divission Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $divission = divission::find($request->id)->delete();
        return response()->json(['success' => ' divission Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $divission = divission::find($request->id);
        if ($divission->status == 0) {
            $divission->status = '1';
            $divission->save();
            return response()->json(['success' => ' divission Activated Successfully!']);
        } else {
            $divission->status = '0';
            $divission->save();
            return response()->json(['success' => ' divission Deactivated Successfully!']);
        }
    }

    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $divissions = divission::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($divissions->count() >= 1) {

            return view('backend.pages.divission.search', compact('divissions'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }

}
