<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class productSearchController extends Controller
{
    //featch all product
    public function featchProduct(){
        $products = Product::select('name')->where('status', 1)->get();

        $product_name = [];
        foreach($products as $product){
            $product_name[] = $product->name;
        }
        return $product_name;
    }

    //go to product details page
    public function productSearch(Request $request){
        if($request->product_search){
            $product = Product::where('name', 'LIKE', "%$request->product_search%")->get();
            if($product){
                return redirect()->route('product.details',$product[0]->id);
            }
        }
    }
}
