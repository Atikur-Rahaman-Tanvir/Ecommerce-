<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class brandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->get();
        return view('backend.pages.brand.index', compact('brands'));
    }
    //insert
    public function insert(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:brands,name',
            'image' => 'required',
        ]);

        if (!$validator->fails()) {
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = str::slug($request->name);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = "Brand" . '-' . uniqid(50) . '.' . $image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('brand_image')) {
                    Storage::disk('public')->makeDirectory('brand_image');
                }

                $image_size = Image::make($image)->resize(143, 73)->stream();
                Storage::disk('public')->put('brand_image/' . $image_name, $image_size);
            }
            $brand->image = $image_name;
            $brand->save();


            return response()->json(['success' => 'New Brand Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //show
    public function show(Request $request){
        $brand = Brand::find($request->id);
        return response()->json(['brand' => $brand]);
    }


    //edit
    public function edit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if (!$validator->fails()) {

            $brand = Brand::find($request->id);
            $brand->name = $request->name;
            $brand->slug = str::slug($request->name);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = "Brand" . '-' . uniqid(50) . '.' . $image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('brand_image')) {
                    Storage::disk('public')->makeDirectory('brand_image');
                }
                if (Storage::disk('public')->exists('brand_image/'.$brand->image)) {
                    Storage::disk('public')->delete('brand_image/' . $brand->image);
                }

                $image_size = Image::make($image)->resize(143, 73)->stream();
                Storage::disk('public')->put('brand_image/' . $image_name, $image_size);
                $brand->image = $image_name;
            }
            $brand->save();


            return response()->json(['success' => ' Brand Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }

    }
    //delete
    public function delete(Request $request){
        $brand = Brand::find($request->id);
        if (Storage::disk('public')->exists('brand_image/' . $brand->image)) {
            Storage::disk('public')->delete('brand_image/' . $brand->image);
        }
        $brands = Brand::find($request->id)->delete();
        return response()->json(['success' => ' Brand Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $brand = Brand::find($request->id);
        if($brand->status == 0 ){
            $brand->status = '1';
            $brand->save();
            return response()->json(['success' => ' Brand Activated Successfully!']);
        }
        else{
            $brand->status = '0';
            $brand->save();
            return response()->json(['success' => ' Brand Deactivated Successfully!']);
        }
    }
    //search
    public function search(Request $request){
        $search = $request->search;
        if (!is_null($search)) {
            $brands = Brand::where('name', 'like', '%'. $search.'%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null']);
        }

        if($brands->count() >= 1){

            return view('backend.pages.brand.search', compact('brands'));

        }
        else{
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }
}


