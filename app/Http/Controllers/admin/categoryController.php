<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class categoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('backend.pages.category.index', compact('categories'));
    }
    //store
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
            'image' => 'required',
        ]);

        if(!$validator->fails()){
            $category = new Category();
            $category->name = $request->name;
            $category->slug = str::slug($request->name);

            if($request->hasFile('image')){
                $image = $request->file('image');
                $image_name = "category".'-'.uniqid(50).'.'.$image->getClientOriginalExtension();

                if(!Storage::disk('public')->exists('category_image')){
                    Storage::disk('public')->makeDirectory('category_image');
                }

                $image_size = Image::make($image)->resize(450, 450)->stream();
                Storage::disk('public')->put('category_image/' . $image_name, $image_size);

            }
            $category->image = $image_name;
            $category->save();


            return response()->json(['success' => 'New Category Added Successfully!',]);
        }
        else{
            return response()->json(['fails' => $validator->errors(),]);
        }
    }


    //show
    public function show(Request $request)
    {
        $category = Category::find($request->id);
        return response()->json(['category' => $category]);
    }


    //edit

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',

        ]);

        if (!$validator->fails()) {
            $category = Category::find($request->id);
            $category->name = $request->name;
            $category->slug = str::slug($request->name);

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = "category" . '-' . uniqid(50) . '.' . $image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('category_image')) {
                    Storage::disk('public')->makeDirectory('category_image');
                }
                if (Storage::disk('public')->exists('category_image/'.$category->image)) {
                    Storage::disk('public')->delete('category_image/' . $category->image);
                }

                $image_size = Image::make($image)->resize(450, 450)->stream();
                Storage::disk('public')->put('category_image/' . $image_name, $image_size);
                $category->image = $image_name;
            }
            $category->save();


            return response()->json(['success' => ' Category Updated Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //delete
    public function delete(Request $request)
    {
        $category = Category::find($request->id);
        if (Storage::disk('public')->exists('category_image/' . $category->image)) {
            Storage::disk('public')->Delete('category_image/' . $category->image);
        }

        $category = Category::find($request->id)->delete();
        return response()->json(['success' => ' Category Deleted Successfully!']);
    }

    //status control
    public function status(Request $request)
    {
        $category = Category::find($request->id);
        if ($category->status == 0) {
            $category->status = '1';
            $category->save();
            return response()->json(['success' => ' Category Activated Successfully!']);
        } else {
            $category->status = '0';
            $category->save();
            return response()->json(['success' => ' Category Deactivated Successfully!']);
        }
    }


    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if(!is_null($search)){

            $categories = Category::where('name', 'like', '%' . $search . '%')->get();
        }
        else{
            return response()->json(['null' => 'search vlaue null.']);
        }

        if ($categories->count() >= 1) {

            return view('backend.pages.category.search', compact('categories'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }


}
