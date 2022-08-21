<?php

use App\Http\Controllers\admin\adminDashboardController;
use App\Http\Controllers\admin\brandController;
use App\Http\Controllers\admin\categoryController as AdminCategoryController;
use App\Http\Controllers\admin\colorController;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\sizeController;
use App\Http\Controllers\admin\tagContorller;
use App\Http\Controllers\admin\tagController;
use App\Http\Controllers\backend\cuponController;
use App\Http\Controllers\backend\DivissionController;
use App\Http\Controllers\backend\shippingController;
use App\Http\Controllers\backend\shippingMethodController;
use App\Http\Controllers\backend\UpozilaController;
use App\Http\Controllers\backend\zilaController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\frontend\AccountController;
use App\Http\Controllers\frontend\AccountControoller;
use App\Http\Controllers\frontend\cartController;
use App\Http\Controllers\frontend\frontendDashboardController;
use App\Http\Controllers\frontend\loginController;
use App\Http\Controllers\frontend\productSearchController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\imageUploadeController;
use App\Http\Controllers\frontend\wishListController;
use App\Http\Controllers\inventoryManagement;
use App\Http\Controllers\orderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\OrderTrackController;
use App\Http\Controllers\sellReport;
use App\Http\Controllers\SslCommerzPaymentController;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('redirect', [homeController::class, 'index']);

Route::get('/', [frontendDashboardController::class, 'home'])->name('home');
Route::get('shop', [frontendDashboardController::class, 'shop'])->name('shop');
Route::get('product/details/{id}', [frontendDashboardController::class, 'product_details'])->name('product.details');
Route::get('product/category/{id}', [frontendDashboardController::class, 'category'])->name('product.category');
Route::get('product/color/{id}', [frontendDashboardController::class, 'color'])->name('product.color');
Route::get('product/brandsize/{id}', [frontendDashboardController::class, 'brand'])->name('product.brand');
Route::get('product/size/{id}', [frontendDashboardController::class, 'size'])->name('product.size');
Route::get('product/tag/{id}', [frontendDashboardController::class, 'tag'])->name('product.tag');

//product file filte in shop page
Route::get('product/price/filter', [frontendDashboardController::class, 'price_fileter'])->name('product.price.filter');

//login
Route::post('partial/login', [loginController::class, 'login'])->name('partial.login');
//Authentication check;
Route::get('auth.check', [cartController::class, 'authCheck'])->name('auth.check');

// cart product store
Route::post('cart/product/store', [cartController::class, 'product_store'])->name('cart.product.store');

//product search
Route::get('featch/product', [productSearchController::class, 'featchProduct'])->name('featch.product');
Route::post('product/search', [productSearchController::class, 'productSearch'])->name('product.search');


//Authenticate User Route Group
Route::group(['prefix' => 'frontend', 'as' => 'frontend.', 'middleware' => ['auth']], function () {
    Route::get('myAccount', [AccountController::class, 'index'])->name('myAccount');
    Route::get('order/details/{id}', [AccountController::class, 'order_details'])->name('order.details');

    // product add to cart
    Route::get('cart', [cartController::class, 'index'])->name('cart.index');
    Route::post('cart/store', [cartController::class, 'store'])->name('cart.store');
    Route::get('cart/quentity/minus', [cartController::class, 'quentity'])->name('cart.quentity');
    Route::get('cart/product/remove', [cartController::class, 'remove_product'])->name('cart.product.remove');
    Route::get('clear/shopping/cart', [cartController::class, 'clearshoppingCart'])->name('clear.shopping.cart');

    //proceed to checkout
    Route::get('proceed/to/checkout', [cartController::class, 'proceedToCheckOut'])->name('proceed.to.checkout');
    Route::get('divission/to/zilla', [cartController::class, 'divission_to_zilla'])->name('divission_to_zilla');
    Route::get('zilla/to/upozilla', [cartController::class, 'zilla_to_upozilla'])->name('zilla_to_upozilla');
    //check cupon
    Route::get('coupon/check/', [cartController::class, 'coupon'])->name('coupon.check');

    //place order route
    Route::post('place/order', [cartController::class, 'placeOrder'])->name('place.order');



    //product add to wishlist
    Route::get('wishlist', [wishListController::class, 'index'])->name('wishlist.index');
    Route::post('wishlist/store', [wishListController::class, 'store'])->name('wishlist.store');
    Route::get('wishlist/product/remove', [wishListController::class, 'remove_product'])->name('wishlist.product.remove');
    Route::get('wishlist/to/cart', [wishListController::class, 'wishlistToCart'])->name('wishlist.to.cart');


    //order tracking route
    Route::post('order/track', [OrderTrackController::class, 'orderTrack'])->name('order.track');

});


//Admin Route Group
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'accessDenied']], function () {

    Route::get('home', [adminDashboardController::class, 'home'])->name('home');

    // category route
    Route::get('category', [AdminCategoryController::class, 'index'])->name('category.index');
    Route::post('category/store', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::get('category/show', [AdminCategoryController::class, 'show'])->name('category.show');
    Route::post('category/edit', [AdminCategoryController::class, 'edit'])->name('category.edit');
    Route::get('category/delete', [AdminCategoryController::class, 'delete'])->name('category.delete');
    Route::get('category/status', [AdminCategoryController::class, 'status'])->name('category.status');
    Route::get('category/search', [AdminCategoryController::class, 'search'])->name('category.search');

    // tag route
    Route::get('tag', [tagController::class, 'index'])->name('tag.index');
    Route::post('tag/store', [tagController::class, 'store'])->name('tag.store');
    Route::get('tag/show', [tagController::class, 'show'])->name('tag.show');
    Route::post('tag/edit', [tagController::class, 'edit'])->name('tag.edit');
    Route::get('tag/delete', [tagController::class, 'delete'])->name('tag.delete');
    Route::get('tag/status', [tagController::class, 'status'])->name('tag.status');
    Route::get('tag/search', [tagController::class, 'search'])->name('tag.search');


    //brand route
    Route::get('brand', [brandController::class, 'index'])->name('brand.index');
    Route::post('brand/insert', [brandController::class, 'insert'])->name('brand.insert');
    Route::get('show/brand/data/', [brandController::class, 'show'])->name('brand.show');
    Route::post('edit/brand/data/', [brandController::class, 'edit'])->name('brand.edit');
    Route::get('delet/brand/data/', [brandController::class, 'delete'])->name('brand.delete');
    Route::get('stats/brand/data/', [brandController::class, 'status'])->name('brand.status');
    Route::get('search/brand/data/', [brandController::class, 'search'])->name('brand.search');

    // color route
    Route::get('color', [colorController::class, 'index'])->name('color.index');
    Route::post('color/store', [colorController::class, 'store'])->name('color.store');
    Route::get('color/show', [colorController::class, 'show'])->name('color.show');
    Route::post('color/edit', [colorController::class, 'edit'])->name('color.edit');
    Route::get('color/delete', [colorController::class, 'delete'])->name('color.delete');
    Route::get('color/status', [colorController::class, 'status'])->name('color.status');
    Route::get('color/search', [colorController::class, 'search'])->name('color.search');

    // size route
    Route::get('size', [sizeController::class, 'index'])->name('size.index');
    Route::post('size/store', [sizeController::class, 'store'])->name('size.store');
    Route::get('size/show', [sizeController::class, 'show'])->name('size.show');
    Route::post('size/edit', [sizeController::class, 'edit'])->name('size.edit');
    Route::get('size/delete', [sizeController::class, 'delete'])->name('size.delete');
    Route::get('size/status', [sizeController::class, 'status'])->name('size.status');
    Route::get('size/search', [sizeController::class, 'search'])->name('size.search');


    // porduct route
    Route::get('product', [productController::class, 'index'])->name('product.index');
    Route::post('product/store', [productController::class, 'store'])->name('product.store');
    Route::get('product/show', [productController::class, 'show'])->name('product.show');
    Route::post('product/edit', [productController::class, 'edit'])->name('product.edit');
    Route::get('product/delete', [productController::class, 'delete'])->name('product.delete');
    Route::get('product/status', [productController::class, 'status'])->name('product.status');
    Route::get('product/search', [productController::class, 'search'])->name('product.search');

    Route::post('product/insert', [productController::class, 'insert'])->name('product.insert');
    Route::get('product/{id}/view', [productController::class, 'view'])->name('product.view');
    Route::post('product/image/change', [productController::class, 'product_image_change'])->name('product.image.change');
    Route::get('product/featured/image/delete', [productController::class, 'porduct_feature_image_delete'])->name('product.feature.image.delete');
    Route::post('product/feature/image/change', [productController::class, 'product_feature_image_upload'])->name('product.feature.image.upload');

    //shipping route
    Route::get('shipping', [shippingController::class, 'index'])->name('shipping.index');
    Route::post('shipping/store', [shippingController::class, 'store'])->name('shipping.store');
    Route::get('shipping/show', [shippingController::class, 'show'])->name('shipping.show');
    Route::post('shipping/edit', [shippingController::class, 'edit'])->name('shipping.edit');
    Route::get('shipping/delete', [shippingController::class, 'delete'])->name('shipping.delete');
    Route::get('shipping/status', [shippingController::class, 'status'])->name('shipping.status');
    Route::get('shipping/search', [shippingController::class, 'search'])->name('shipping.search');


    //Divission route
    Route::get('divission', [DivissionController::class, 'index'])->name('divission.index');
    Route::post('divission/store', [DivissionController::class, 'store'])->name('divission.store');
    Route::get('divission/show', [DivissionController::class, 'show'])->name('divission.show');
    Route::post('divission/edit', [DivissionController::class, 'edit'])->name('divission.edit');
    Route::get('divission/delete', [DivissionController::class, 'delete'])->name('divission.delete');
    Route::get('divission/status', [DivissionController::class, 'status'])->name('divission.status');
    Route::get('divission/search', [DivissionController::class, 'search'])->name('divission.search');


    //zilla route
    Route::get('zilla', [zilaController::class, 'index'])->name('zilla.index');
    Route::post('zilla/store', [zilaController::class, 'store'])->name('zila.store');
    Route::get('zilla/show', [zilaController::class, 'show'])->name('zila.show');
    Route::post('zilla/edit', [zilaController::class, 'edit'])->name('zila.edit');
    Route::get('zilla/delete', [zilaController::class, 'delete'])->name('zila.delete');
    Route::get('zilla/status', [zilaController::class, 'status'])->name('zila.status');
    Route::get('zilla/search', [zilaController::class, 'search'])->name('zila.search');


    //zilla route
    Route::get('upozilla', [UpozilaController::class, 'index'])->name('upozilla.index');
    Route::post('upozilla/store', [UpozilaController::class, 'store'])->name('upozila.store');
    Route::get('upozilla/show', [UpozilaController::class, 'show'])->name('upozila.show');
    Route::post('upozilla/edit', [UpozilaController::class, 'edit'])->name('upozila.edit');
    Route::get('upozilla/delete', [UpozilaController::class, 'delete'])->name('upozila.delete');
    Route::get('upozilla/status', [UpozilaController::class, 'status'])->name('upozila.status');
    Route::get('upozilla/search', [UpozilaController::class, 'search'])->name('upozila.search');

    // shipping method
    Route::get('shipping/method', [shippingMethodController::class, 'index'])->name('shipping.method.index');
    Route::post('shipping/method/store', [shippingMethodController::class, 'store'])->name('shipping.method.store');
    Route::get('shipping/method/show', [shippingMethodController::class, 'show'])->name('shipping.method.show');
    Route::post('shipping/method/edit', [shippingMethodController::class, 'edit'])->name('shipping.method.edit');
    Route::get('shipping/method/delete', [shippingMethodController::class, 'delete'])->name('shipping.method.delete');
    Route::get('shipping/method/status', [shippingMethodController::class, 'status'])->name('shipping.method.status');
    Route::get('shipping/method/search', [shippingMethodController::class, 'search'])->name('shipping.method.search');

    //  routecupon
    Route::get('cupon', [cuponController::class, 'index'])->name('cupon.index');
    Route::post('cupon/store', [cuponController::class, 'store'])->name('cupon.store');
    Route::get('cupon/show', [cuponController::class, 'show'])->name('cupon.show');
    Route::post('cupon/edit', [cuponController::class, 'edit'])->name('cupon.edit');
    Route::get('cupon/delete', [cuponController::class, 'delete'])->name('cupon.delete');
    Route::get('cupon/status', [cuponController::class, 'status'])->name('cupon.status');
    Route::get('cupon/search', [cuponController::class, 'search'])->name('cupon.search');



    //Order manage route
    Route::get('all/order', [orderController::class, 'allorder'])->name('all.order');
    Route::get('order/details/{id}', [orderController::class, 'details'])->name('order.details');
    Route::get('order/search', [orderController::class, 'search'])->name('order.search');
    Route::get('order/search/by/date', [orderController::class, 'date_search'])->name('order.date.search');
    Route::get('order/status/update', [orderController::class, 'status_update'])->name('admin.order.status.update');


    Route::get('order/delete', [orderController::class, 'order_delete'])->name('order.delete');

    //payment complete Order
    Route::get('payment/complete/order', [orderController::class, 'payment_complete'])->name('payment.complete.order');
    Route::get('payment/complete/order/search', [orderController::class, 'payment_complete_search'])->name('payment.complete.order.search');
    Route::get('payment/complete/order/search/by/date', [orderController::class, 'payment_complete_date_search'])->name('payment.complete.order.date.search');



    //payment cod Order
    Route::get('payment/cod/order', [orderController::class, 'cod'])->name('payment.cod.order');
    Route::get('payment/cod/order/search', [orderController::class, 'payment_cod_search'])->name('payment.cod.order.search');
    Route::get('payment/cod/order/search/by/date', [orderController::class, 'payment_cod_date_search'])->name('payment.cod.order.date.search');

    //payment Cancled Order
    Route::get('payment/cancled/order', [orderController::class, 'cancled'])->name('payment.cancled.order');
    Route::get('payment/cancled/order/search', [orderController::class, 'payment_cancled_search'])->name('payment.cancled.order.search');
    Route::get('payment/cancled/order/search/by/date', [orderController::class, 'payment_cancled_date_search'])->name('payment.cancled.order.date.search');





    //inventory management
    Route::get('inventory/management', [inventoryManagement::class, 'inventory_management'])->name('inventory.management');
    Route::get('all/product/search',[inventoryManagement::class, 'product_search'])->name('all.product.search');

    Route::get('product/report/{id}', [inventoryManagement::class, 'product_report'])->name('product.report');

    // cash sell or online sell
    Route::get('cash/sell', [inventoryManagement::class, 'cash_sell'])->name('cash.sell');
    Route::get('product/sell/search/by/date', [inventoryManagement::class, 'date_search'])->name('producet.sell.date.search');

    //cod sell
    Route::get('cod/sell', [inventoryManagement::class, 'cod_sell'])->name('product.cod.sell');
    Route::get('product/cod/sell/search/by/date', [inventoryManagement::class, 'cod_date_search'])->name('producet.cod.date.search');

    //order monthly report
    Route::get('monthly/order/sell/report', [sellReport::class, 'order_sell_report'])->name('monthly.sell.order.report');
    // Route::get('monthly/order/sell/report/date/search', [sellReport::class, 'order_sell_report_date'])->name('monthly.sell.order.report.date.search');
Route::get('monthly/order/sell/report/date/search', [sellReport::class, 'order_sell_report_date'])->name('monthly.sell.order.date.search');

    //order monthly report
    Route::get('yearly/order/sell/report', [sellReport::class, 'yearly_order_sell_report'])->name('yearly.sell.order.report');
    Route::get('yearly/order/sell/report/date/search', [sellReport::class, 'yearly_order_sell_report_delete'])->name('yearly.sell.order.report.date.search');


});

Route::group(['prefix' => 'admin/order/status', 'as' => 'admin.order.status.','middleware' => ['auth', 'accessDenied']], function(){
    Route::get('pending',[OrderStatusController::class, 'pending',])->name('pending');
    Route::get('pending/search',[OrderStatusController::class, 'pending_search',])->name('pending.search');
    Route::get('pending/date/search',[OrderStatusController::class, 'pending_date_search',])->name('pending.date.search');

    Route::get('packaging',[OrderStatusController::class, 'packaging',])->name('packaging');
    Route::get('packaging/search',[OrderStatusController::class, 'packaging_search',])->name('packaging.search');
    Route::get('packaging/date/search',[OrderStatusController::class, 'packaging_date_search',])->name('packaging.date.search');

    Route::get('shipped',[OrderStatusController::class, 'shipped',])->name('shipped');
    Route::get('shipped/search',[OrderStatusController::class, 'shipped_search',])->name('shipped.search');
    Route::get('shipped/date/search',[OrderStatusController::class, 'shipped_date_search',])->name('shipped.date.search');

    Route::get('delivered', [OrderStatusController::class, 'delivered',])->name('delivered');
    Route::get('delivered/search', [OrderStatusController::class, 'delivered_search',])->name('delivered.search');
    Route::get('delivered/date/search', [OrderStatusController::class, 'delivered_date_search',])->name('delivered.date.search');
});


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index'])->name('pay');
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    //SSLCOMMERZ END
