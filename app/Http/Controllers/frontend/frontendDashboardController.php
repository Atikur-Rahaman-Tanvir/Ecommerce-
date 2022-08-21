<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Product_featured_image;
use App\Models\Size;
use App\Models\Tag;
use Illuminate\Http\Request;

class frontendDashboardController extends Controller
{
    public function home(){
        $categories = Category::where('status', '1')->latest()->take(3)->get();
        $products = Product::where('status', '1')->orderBy('sell_quentity', 'DESC')->latest()->take(8)->get();
        $brands = Brand::where('status', '1')->latest()->get();
        return view('frontend.pages.home',compact('categories', 'products', 'brands'));
    }


    //shop
    public function shop(Request $request){
        $categories = Category::where('status', '1')->latest()->get();
        $products = Product::where('status', '1')->latest()->paginate(9);
        $colors = Color::where('status', '1')->latest()->get();
        $sizes = Size::where('status', '1')->latest()->get();
        $tags = Tag::where('status', '1')->latest()->get();
        $brands = Brand::where('status', '1')->latest()->get();
        $best_sell = Product::where('status', '1')->orderBy('sell_quentity', 'DESC')->latest()->take(8)->get();
        // return $best_sell[0]->id;
        return view('frontend.pages.shop.index', compact('products', 'best_sell'));
    }

    public function product_details($id){

        $product = Product::find($id);
        $f_image = Product_featured_image::where('product_id', $id)->take(1)->get();

        foreach($f_image as $image){
           $f_f_image = $image->product_featured_image;
        }

        return view('frontend.pages.shop.details', compact('product', 'f_f_image'));
    }

    //show all category products
    public function category($id, Request $request){
        $category = Category::find($id);
        $products = $category->products()->paginate(9);
        return view('frontend.pages.shop.category', compact('products', 'category'));
    }
    //show all color products
    public function color($id, Request $request){
        $color = Color::find($id);
        $products = $color->products()->paginate(9);
        return view('frontend.pages.shop.color', compact('products', 'color'));
    }
    //show all brand products
    public function brand($id, Request $request){
        $brand = brand::find($id);
        $products = $brand->products()->paginate(9);
        return view('frontend.pages.shop.brand', compact('products', 'brand'));
    }
    //show all soze products
    public function size($id, Request $request){
        $size = Size::find($id);
        $products = $size->products()->paginate(9);
        return view('frontend.pages.shop.size', compact('products', 'size'));
    }
    //show all brand products
    public function tag($id, Request $request){
        $tag = Tag::find($id);
        $products = $tag->products()->paginate(9);
        return view('frontend.pages.shop.tag', compact('products', 'tag'));
    }

    //product price filtering;
    public function price_fileter(Request $request){
        // alert($('#amount').val().split(' ')[0].split('$')[1]);
        $frist_price = explode(" ", $request->amount);
        $frist_price = explode("$", $frist_price[0]);
        $frist_price =  $frist_price[1];


        $secoend_price = explode(" ", $request->amount);
        $secoend_price = explode("$", $secoend_price[2]);
        $secoend_price =  $secoend_price[1];


        $products = Product::whereBetween('price', [$frist_price, $secoend_price] )->get();


        if($products->count() != 0){
            return view('frontend.pages.shop.price_filter', compact('products'));
        }
        else{
            return response()->json(['not_pound' => 'No Product Available ate the range']);
        }


    }


}
