<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Product_featured_image;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class productController extends Controller
{
    public function index()
    {
        $products = product::latest()->get();
        $categories = Category::where('status', true)->latest()->get();
        $tags = Tag::where('status', true)->latest()->get();
        $brands = Brand::where('status', true)->latest()->get();
        $colors = Color::where('status', true)->latest()->get();
        $sizes = Size::where('status', true)->latest()->get();
        return view('backend.pages.product.index', compact('products', 'categories', 'tags', 'brands', 'colors', 'sizes'));
    }
    // store
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:products,name',
            'price' => 'required',
            'buy_price' => 'required',
            'quentity' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'brands' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
            'image' => 'required',
        ]);

        if (!$validator->fails()) {
            $product = new product();
            $product->name = $request->name;
            $product->slug = str::slug($request->name);
            $product->price = $request->price;
            $product->buy_price = $request->buy_price;
            $product->discount = $request->discount;
            $product->quentity = $request->quentity;
            $product->category_id = $request->category;
            $product->description = $request->description;



            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = "product" . '-' . uniqid(50) . '.' . $image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('product_image')) {
                    Storage::disk('public')->makeDirectory('product_image');
                }

                $image_size = Image::make($image)->resize(275, 329)->stream();
                Storage::disk('public')->put('product_image/' . $image_name, $image_size);
                $product->image = $image_name;
            }

            $product->save();

            $product->tags()->attach($request->tags);
            $product->brands()->attach($request->brands);
            $product->colors()->attach($request->colors);
            $product->sizes()->attach($request->sizes);

            if ($request->hasFile('product_featured_images')) {

                foreach ($request->file('product_featured_images') as $image) {

                    $image_name = "product_featured_image" . '-' . uniqid(50) . '.' . $image->getClientOriginalExtension();

                    // product_featured_image_big
                    if (!Storage::disk('public')->exists('product_featured_image')) {
                        Storage::disk('public')->makeDirectory('product_featured_image');
                    }
                    $image_size = Image::make($image)->resize(800, 960)->stream();
                    Storage::disk('public')->put('product_featured_image/' . $image_name, $image_size);

                    //product_featured_image_small
                    if (!Storage::disk('public')->exists('product_featured_image_small')) {
                        Storage::disk('public')->makeDirectory('product_featured_image_small');
                    }

                    $image_size = Image::make($image)->resize(99, 119)->stream();
                    Storage::disk('public')->put('product_featured_image_small/' . $image_name, $image_size);

                    $product_featured_image = new Product_featured_image();
                    $product_featured_image->product_id = $product->id;
                    $product_featured_image->product_featured_image = $image_name;
                    $product_featured_image->save();
                }
            }

            return response()->json(['success' => 'New product Added Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //edit

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',
            'buy_price' => 'required',
            'quentity' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'brands' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
        ]);

        if (!$validator->fails()) {
            $product = Product::find($request->id);
            $product->name = $request->name;
            $product->slug = str::slug($request->name);
            $product->price = $request->price;
            $product->buy_price = $request->buy_price;
            $product->discount = $request->discount;
            $product->quentity = $request->quentity;
            $product->category_id = $request->category;
            $product->description = $request->description;
            $product->save();


            $product->tags()->sync($request->tags);
            $product->brands()->sync($request->brands);
            $product->colors()->sync($request->colors);
            $product->sizes()->sync($request->sizes);
;


            return response()->json(['success' => 'Update Successfully!', 'route' => route('admin.product.index')]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    // product_image_change
    public function product_image_change(Request $request){
        $validator = Validator::make($request->all(), [
            'image' => 'required',

        ]);

        if (!$validator->fails()) {
            $product = Product::find($request->id);
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = "product" . '-' . uniqid(50) . '.' . $image->getClientOriginalExtension();

                if (!Storage::disk('public')->exists('product_image')) {
                    Storage::disk('public')->makeDirectory('product_image');
                }
                if (!Storage::disk('public')->exists('product_image/' . $product->image)) {
                    Storage::disk('public')->delete('product_image/' . $product->image);
                }

                $image_size = Image::make($image)->resize(275, 329)->stream();
                Storage::disk('public')->put('product_image/' . $image_name, $image_size);
                $product->image = $image_name;
            }

            $product->save();




            return response()->json(['success' => 'Product Image Update Successfully!', 'src' => asset('storage/product_image/'.$image_name)]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }
    }

    //product_feature_image_upload
    public function product_feature_image_upload(Request $request){
        $validator = Validator::make($request->all(), [
            'product_featured_images' => 'required',
        ]);
        if (!$validator->fails()) {

            if ($request->hasFile('product_featured_images')) {

                foreach ($request->file('product_featured_images') as $image) {

                    $image_name = "product_featured_image" . '-' . uniqid(50) . '.' . $image->getClientOriginalExtension();

                    // product_featured_image_big
                    if (!Storage::disk('public')->exists('product_featured_image')) {
                        Storage::disk('public')->makeDirectory('product_featured_image');
                    }
                    $image_size = Image::make($image)->resize(800, 960)->stream();
                    Storage::disk('public')->put('product_featured_image/' . $image_name, $image_size);

                    //product_featured_image_small
                    if (!Storage::disk('public')->exists('product_featured_image_small')) {
                        Storage::disk('public')->makeDirectory('product_featured_image_small');
                    }

                    $image_size = Image::make($image)->resize(99, 119)->stream();
                    Storage::disk('public')->put('product_featured_image_small/' . $image_name, $image_size);

                    $product_featured_image = new Product_featured_image();
                    $product_featured_image->product_id = $request->id;
                    $product_featured_image->product_featured_image = $image_name;
                    $product_featured_image->save();
                }
            }

            return response()->json(['success' => 'Product Feature Image Upload Successfully!',]);
        } else {
            return response()->json(['fails' => $validator->errors(),]);
        }

    }

    //porduct_feature_image_delete
    public function porduct_feature_image_delete(Request $request){
         $product_featured_image = Product_featured_image::find($request->f_i_id);
        if($product_featured_image->product_featured_image){
            Storage::disk('public')->delete('product_featured_image/' . $product_featured_image->product_featured_image);
             Product_featured_image::find($request->f_i_id)->delete();
        }
        return response()->json(['success' => 'Image Delete Successfully!', 'product_featured_image_id' => $request->f_i_id]);
    }
    //delete
    public function delete(Request $request)
    {
        $product = product::find($request->id);
        if (Storage::disk('public')->exists('product_image/' . $product->image)) {
            Storage::disk('public')->Delete('product_image/' . $product->image);
        }



        foreach($product->product_featured_images as $product_featured_image){
            if ($product_featured_image->product_featured_image) {
                Storage::disk('public')->delete('product_featured_image/' . $product_featured_image->product_featured_image);
            }
        }
       $images = $product->product_featured_images;

        $product = product::find($request->id)->delete();
        return response()->json(['success' => ' product Deleted Successfully!' , 'images' => $images]);
    }

    //status control
    public function status(Request $request)
    {
        $product = product::find($request->id);
        if ($product->status == 0) {
            $product->status = '1';
            $product->save();
            return response()->json(['success' => ' product Activated Successfully!']);
        } else {
            $product->status = '0';
            $product->save();
            return response()->json(['success' => ' product Deactivated Successfully!']);
        }
    }


    //search
    public function search(Request $request)
    {
        $search = $request->search;
        if (!is_null($search)) {

            $products = product::where('name', 'like', '%' . $search . '%')->get();
        } else {
            return response()->json(['null' => 'search vlaue null.']);
        }

        if ($products->count() >= 1) {

            return view('backend.pages.product.search', compact('products'));
        } else {
            return response()->json(['not_found' => 'No Data Found.', 'search' => $request->search]);
        }
    }


    public function view($id)
    {
        $product = Product::find($id);
        $categories = Category::where('status', true)->latest()->get();
        $tags = Tag::where('status', true)->latest()->get();
        $brands = Brand::where('status', true)->latest()->get();
        $colors = Color::where('status', true)->latest()->get();
        $sizes = Size::where('status', true)->latest()->get();
        return view('backend.pages.product.view', compact('product', 'categories', 'tags', 'brands', 'colors', 'sizes'));
    }

}
