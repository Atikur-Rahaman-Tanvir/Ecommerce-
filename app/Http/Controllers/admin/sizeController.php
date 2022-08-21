<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class sizeController extends Controller
{
    public function index()
    {
        $sizes = Size::latest()->get();
        return view('backend.pages.size.index', compact('sizes'));
    }
    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:sizes,name',
        ]);

        if (!$validator->fails()) {
            $size = new Size();
            $size->name = $request->name;
            $size->slug = str::slug($request->name);
            $size->save();
            return response()->json(['success' => 'New Size Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request)
    {
        $size = Size::find($request->id);
        return response()->json(['size' => $size]);
    }

    // edit
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if (!$validator->fails()) {
            $size = Size::find($request->id);
            $size->name = $request->name;
            $size->slug = str::slug($request->name);
            $size->save();
            return response()->json(['success' => ' Size Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $size = Size::find($request->id)->delete();
        return response()->json(['success' => ' Size Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $size = Size::find($request->id);
        if ($size->status == 0) {
            $size->status = '1';
            $size->save();
            return response()->json(['success' => ' Size Activated Successfully!']);
        } else {
            $size->status = '0';
            $size->save();
            return response()->json(['success' => ' Size Deactivated Successfully!']);
        }
    }

    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $sizes = Size::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($sizes->count() >= 1) {

            return view('backend.pages.size.search', compact('sizes'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }

}
