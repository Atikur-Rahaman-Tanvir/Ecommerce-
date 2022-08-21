<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Color;
use App\Models\Order_Summery;
use App\Models\Product;
use App\Models\Shipping_method;
use App\Models\Size;
use App\Models\Tag;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {



        View::share('categories', Category::where('status', '1')->latest()->get());
        // View::share('products', Product::where('status', '1')->latest()->paginate(9));
        View::share('colors', Color::where('status', '1')->latest()->get());
        View::share('sizes', Size::where('status', '1')->latest()->get());
        View::share('tags', Tag::where('status', '1')->latest()->get());
        View::share('brands', Brand::where('status', '1')->latest()->get());

        View::share('cart_products', Product::all());
        View::share('carts', Cart::latest()->get());
        View::share('wishlists', Wishlist::latest()->get());
        view::share('shipping_methods', Shipping_method::where('status', 1)->get());


    }
}
