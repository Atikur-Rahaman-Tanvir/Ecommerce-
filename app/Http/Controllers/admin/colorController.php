<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class colorController extends Controller
{
    public function index(){
        $colors = Color::latest()->get();
        return view('backend.pages.color.index', compact('colors'));
    }

    //store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:colors,name',
            'color_picker' => 'required|unique:colors,color_code',
        ]);

        if (!$validator->fails()) {
            $color = new Color();
            $color->name = $request->name;
            $color->slug = str::slug($request->name);
            $color->color_code = $request->color_picker;
            $color->save();
            return response()->json(['success' => 'New Color Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request)
    {
        $color = Color::find($request->id);
        return response()->json(['color' => $color]);
    }

    // edit
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'color_picker' => 'required',
        ]);

        if (!$validator->fails()) {
            $color = Color::find($request->id);
            $color->name = $request->name;
            $color->slug = str::slug($request->name);
            $color->color_code = $request->color_picker;
            $color->save();
            return response()->json(['success' => ' Color Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $color = Color::find($request->id)->delete();
        return response()->json(['success' => ' Color Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $color = Color::find($request->id);
        if ($color->status == 0) {
            $color->status = '1';
            $color->save();
            return response()->json(['success' => ' Color Activated Successfully!']);
        } else {
            $color->status = '0';
            $color->save();
            return response()->json(['success' => ' Color Deactivated Successfully!']);
        }
    }

    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $colors = Color::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if ($colors->count() >= 1) {

            return view('backend.pages.color.search', compact('colors'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }


}
