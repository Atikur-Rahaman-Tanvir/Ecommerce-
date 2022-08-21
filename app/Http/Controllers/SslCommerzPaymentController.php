<?php

namespace App\Http\Controllers;

// use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Mail\orderPlaceMail;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Order_Summery;
use App\Models\OrderReport;
use App\Models\Product;
use App\Models\Product_report;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Livewire\Features\Placeholder;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        if (strpos(url()->previous(), 'frontend/proceed/to/checkout')) {
            # Here you have to receive all the order data to initate the payment.
            # Let's say, your oder transaction informations are saving in a table called "orders"
            # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

            $post_data = array();
            $post_data['total_amount'] = Session::get('order_total'); # You cant not pay less than 10
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = uniqid(); // tran_id must be unique
            $post_data['order__summery_id'] = session::get('order_summery_id');

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = 'Customer Name';
            $post_data['cus_email'] = 'customer@mail.com';
            $post_data['cus_add1'] = 'Customer Address';
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = '8801XXXXXXXXX';
            $post_data['cus_fax'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "Bangladesh";

            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Computer";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "ref001";
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";

            #Before  going to initiate the payment order status need to insert or update as Pending.
            $update_product = DB::table('orders')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'status' => 'Pending',
                    'address' => $post_data['cus_add1'],
                    'transaction_id' => $post_data['tran_id'],
                    'currency' => $post_data['currency'],
                    'order__summery_id' => $post_data['order__summery_id'],
                ]);

            $sslc = new SslCommerzNotification();
            # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
            $payment_options = $sslc->makePayment($post_data, 'hosted');

            if (!is_array($payment_options)) {
                print_r($payment_options);
                $payment_options = array();
            }
        }
    }

    public function payViaAjax(Request $request)
    {

        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = '10'; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);

        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }
    }

    public function success(Request $request)
    {
        echo "Transaction is Successful";

        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($request->all(), $tran_id, $amount, $currency);

            if ($validation == TRUE) {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Complete']);

                $order_summery_id = DB::table('orders')->select('order__summery_id')->where('transaction_id', $tran_id)->first();
                $o_s_id =  $order_summery_id->order__summery_id;

                $place_order_mail =  DB::table('billing_informations')->select('b_email')->where('order__summery_id', $o_s_id)->first();

                $order_details =Order_Detail::where('order__summery_id', $o_s_id)->get();
                $order_summery =Order_Summery::where('id', $o_s_id)->first();

                Mail::to($place_order_mail->b_email)->send(new orderPlaceMail($order_details, $order_summery));
                
                $order =
                    DB::table('orders')
                    ->where('transaction_id', $tran_id)->first();

                DB::table('order__summeries')->where('id', $order->order__summery_id)
                    ->update(['payment_status' => $order->status, 'transaction_id' => $order->transaction_id]);


                $order_details = Order_Detail::where('order__summery_id', $order->order__summery_id)->get();
                // $order_details = DB::table('order__details')->where('order__summery_id', $order->order__summery_id)->get();
                foreach ($order_details as $order) {
                    if (Product_report::where('product_id', $order->product_id)->where('payment_method', $request->p_m_input)->where('price', $order->price)->where('buy_price', $order->product->buy_price)->where('created_at', Carbon::today())->exists()) {
                        Product_report::where('product_id', $order->product_id)->increment('quentity', $order->quentity);
                        $product_price = Product_report::where('product_id', $order->product_id)->where('price', $order->price)->where('buy_price', $order->product->buy_price)->first();
                        $product_price->total_price = $product_price->price * $product_price->quentity;


                        $product_price->buy_total_price = $product_price->buy_price * $product_price->quentity;

                        $product_price->save();
                    } else {
                        $product_report = new Product_report();
                        $product_report->product_id = $order->product_id;
                        $product_report->quentity = $order->quentity;
                        $product_report->payment_method = 2;

                        $product_report->buy_price = $order->product->buy_price;

                        $product_report->price = $order->price;
                        $product_report->total_price = $product_report->price * $product_report->quentity;

                        $product_report->buy_total_price = $order->product->buy_price * $order->quentity;

                        $product_report->created_at = Carbon::today();
                        $product_report->save();
                    }
                }

                $order_summery = Order_Summery::where('id', $order->order__summery_id)->first();

                if (OrderReport::where('created_at', Carbon::today())->exists()) {
                    $order = OrderReport::where('created_at', Carbon::today())->first();
                    $order->online_payment = $order->online_payment + 1;
                    if ($order_summery->cart_total + $order_summery->sipping_price > $order_summery->order_total) {
                        $order->online_total = $order->online_total + ($order_summery->order_total - $order_summery->sipping_price);
                    } else {
                        $order->online_total = $order->online_total + $order_summery->cart_total;
                    }
                    $order->order_total = $order->online_payment +  $order->cod_payment;
                    $order->cart_total = $order->online_total +  $order->cod_total;
                    $order->shipping_total = $order->shipping_total + $order_summery->sipping_price;
                    $order->grand_total = $order->cart_total + $order->shipping_total;
                    $order->save();
                } else {

                    $order_report = new OrderReport();
                    $order_report->online_payment = '1';
                    if ($order_summery->cart_total + $order_summery->sipping_price > $order_summery->order_total) {
                        $order_report->online_total = $order_summery->order_total - $order_summery->sipping_price;
                    } else {
                        $order_report->online_total = $order_summery->cart_total;
                    }
                    $order_report->cod_payment = '0';
                    $order_report->cod_total = '0';
                    $order_report->order_total = $order_report->online_payment +  $order_report->cod_payment;


                    $order_report->cart_total = $order_report->online_total +  $order_report->cod_total;
                    $order_report->shipping_total = $order_summery->sipping_price;
                    $order_report->grand_total = $order_report->cart_total +  $order_report->shipping_total;
                    $order_report->created_at = Carbon::today();
                    $order_report->save();
                }






                return view('frontend.pages.shop.order_Complete');
                echo "<br >Transaction is successfully Complete";
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                echo "validation Fail";
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
            echo "Transaction is successfully Completed";
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            echo "Invalid Transaction";
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);
            $order =
                DB::table('orders')
                ->where('transaction_id', $tran_id)->first();

            DB::table('order__summeries')->where('id', $order->order__summery_id)
                ->update(['payment_status' => $order->status, 'transaction_id' => $order->transaction_id]);

            echo "Transaction is Falied";
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);


            $order =
                DB::table('orders')
                ->where('transaction_id', $tran_id)->first();

            DB::table('order__summeries')->where('id', $order->order__summery_id)
                ->update(['payment_status' => $order->status, 'transaction_id' => $order->transaction_id]);

                //decremnt product
            $order_details = DB::table('order__details')->where('order__summery_id', $order->order__summery_id)->get();
            foreach($order_details as $order){
                Product::where('id', $order->product_id)->increment('quentity', $order->quentity);
                Product::where('id', $order->product_id)->decrement('sell_quentity', $order->quentity);

            }

            echo "Transaction is Cancel";


        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            echo "Transaction is already Successful";
        } else {
            echo "Transaction is Invalid";
        }
    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->amount, $order_details->currency);
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    echo "Transaction is successfully Completed";
                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    echo "validation Fail";
                }
            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.

                echo "Transaction is already successfully Completed";
            } else {
                #That means something wrong happened. You can redirect customer to your product page.

                echo "Invalid Transaction";
            }
        } else {
            echo "Invalid Data";
        }
    }
}
