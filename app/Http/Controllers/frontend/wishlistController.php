<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class wishlistController extends Controller
{
    // wishlist index
    public function index(){
        if(Wishlist::where('user_id', Auth::id())->count() == 0){
            return view('frontend.pages.shop.empty_wishlist');
        }
        return view('frontend.pages.shop.wishlist');
    }

    // store in wish_list
    public function store(Request $request)
    {
        $porduct = Product::find($request->product_id);


        if (Wishlist::where('user_id', Auth::id())->where('product_id', $request->product_id)->where('color', $request->color_name)->where('size', $request->size_name)->exists()) {

            return response()->json(['product_exists' => 'This product exists in wishlist']);
        } else {
            $wishlist = new Wishlist();
            $wishlist->product_id = $request->product_id;
            $wishlist->user_id = Auth::user()->id;
            $wishlist->color = $request->color_name;
            $wishlist->size = $request->size_name;
            $wishlist->save();
            return response()->json(['output' => $porduct]);
        }
    }

    // remove product form wishlist
    public function remove_product(Request $request)
    {
        $cart = Wishlist::find($request->id)->delete();
        return response()->json(['success' => 'Product Delete Successfully!']);
    }

    //product wishlist to cart
    public function wishlistToCart(Request $request){
        $wishlist = Wishlist::find($request->id);

        $cart = new Cart();
        $cart->product_id = $wishlist->product->id;
        $cart->user_id = Auth::user()->id;
        $cart->color = $wishlist->color;
        $cart->size = $wishlist->size;
        if ($wishlist->product->discount) {
            $cart->price = $wishlist->product->price - ($wishlist->product->discount * $wishlist->product->price) / 100;
        } else {
            $cart->price = $wishlist->product->price;
        }
        $cart->total = $cart->price;
        $cart->save();


        $wishlist = Wishlist::find($request->id)->delete();
        return response()->json(['success' => $wishlist]);
    }


}
