@extends('frontend.layouts.master')
@section('title')
    proceed to checkout
@endsection
@section('content')
    <!--Body Container-->
    <div id="page-content">
        <!--Collection Banner-->
        <div class="collection-header">
            <div class="collection-hero">
                <div class="collection-hero__image"></div>
                <div class="collection-hero__title-wrapper container">
                    <h1 class="collection-hero__title">Checkout Style1</h1>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index-2.html"
                            title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Checkout Style1</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End Collection Banner-->

        <!--Main Content-->
        <div class="container">
            {{-- <form class="checkout-form" id="checkout_form" method="post" action="{{route('frontend.place.order')}}"> --}}
            <form class="checkout-form" id="checkout_form">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-lg-4">
                        <div class="card card--grey">
                            <div class="card-body">
                                <h2 class="fs-6">SHIPPING ADDRESS</h2>
                                <div class="row mt-2">
                                    <div id="f_name_error" class="text-danger"></div>
                                    <div class="col-sm-12"><label class="text-uppercase d-none">First Name:</label>
                                        <div class="form-group"><input id="f_name" name="f_name" type="text"
                                                placeholder="First Name" class="form-control"></div>
                                    </div>
                                    <div id="l_name_error" class="text-danger"></div>
                                    <div class="col-sm-12"><label class="text-uppercase d-none">Last Name:</label>
                                        <div class="form-group"><input id="l_name" name="l_name" type="text"
                                                placeholder="Last Name" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-12"><label class="text-uppercase d-none">Email :</label>
                                        <div id="b_l_name_error" class="text-danger"></div>
                                        <div class="form-group"><input id="email" name="email" type="email"
                                                placeholder="Enter your email" class="form-control"></div>
                                    </div>
                                </div>
                                <label class="text-uppercase d-none">Divission:</label>
                                <div id="divission_error" class="text-danger"></div>
                                <div class="form-group select-wrapper">
                                    <select id="divission" name="divission" data-default="United States">
                                        <option value="0" label="Select a Divission" selected="selected">Select a
                                            Divission</option>
                                        @foreach ($divissions as $divission)
                                            <option value="{{ $divission->id }}" label="{{ $divission->name }}">
                                                {{ $divission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12"><label class="text-uppercase d-none">Zilla:</label>
                                         <div id="zilla_error" class="text-danger"></div>
                                        <div id="add_zilla" class="form-group select-wrapper">
                                            <select id="zilla" name="zilla" data-default="" class="d-none">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12"><label class="text-uppercase d-none">State:</label>
                                         <div id="upozilla_error" class="text-danger"></div>
                                        <div id="add_upozilla" class="form-group select-wrapper">
                                            <select id="upozilla" name="upozilla" data-default="" class="d-none">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12"><label class="text-uppercase d-none">Zip/postal code:</label>
                                        <div id="zip_code_error" class="text-danger"></div>
                                        <div class="form-group"><input name="zip_code" id="zip_code" type="text"
                                                placeholder="Zip/postal code" class="form-control"></div>
                                    </div>
                                </div>
                                <label class="text-uppercase d-none">Address 1:</label>
                                <div id="address_error" class="text-danger"></div>
                                <div class="form-group"><input name="address" id="address" type="text"
                                        placeholder="Address" class="form-control"></div>
                                <div class="customCheckbox clearfix">
                                    <input id="formcheckoutCheckbox1" name="checkbox1" type="checkbox" />
                                    <label for="formcheckoutCheckbox1">Save address to my account</label>
                                </div>
                            </div>
                        </div>
                        <div class="card card--grey mt-2">
                            <div class="card-body">
                                <h2 class="fs-6">BILLING ADDRESS</h2>
                                <div class="customCheckbox clearfix py-2 my-2">
                                    <input id="formcheckoutCheckbox2" name="checkbox2" type="checkbox">
                                    <label for="formcheckoutCheckbox2">The same as shipping address</label>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12"><label class="text-uppercase d-none">First Name:</label>
                                         <div id="b_f_name_error" class="text-danger"></div>
                                        <div class="form-group"><input id="b_f_name" name="b_f_name" type="text"
                                                placeholder="First Name" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-12"><label class="text-uppercase d-none">Last Name:</label>
                                        <div id="b_l_name_error" class="text-danger"></div>
                                        <div class="form-group"><input id="b_l_name" name="b_l_name" type="text"
                                                placeholder="Last Name" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-12"><label class="text-uppercase d-none">Last Name:</label>
                                        <div id="b_l_name_error" class="text-danger"></div>
                                        <div class="form-group"><input id="b_email" name="b_email" type="email"
                                                placeholder="Enter your email" class="form-control"></div>
                                    </div>
                                </div>
                                <label class="text-uppercase d-none">Divission:</label>
                                <div id="b_divission_error" class="text-danger"></div>
                                <div class="form-group select-wrapper">
                                    <select id="b_divission" name="b_divission" data-default="United States">
                                        <option value="0" label="Select a Divission" selected="selected">Select a
                                            Divission</option>
                                        @foreach ($divissions as $divission)
                                            <option value="{{ $divission->id }}" label="{{ $divission->name }}">
                                                {{ $divission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12"><label class="text-uppercase d-none">State:</label>
                                        <div id="b_zilla_error" class="text-danger"></div>
                                        <div id="add_zilla" class="form-group select-wrapper">
                                            <select id="b_zilla" name="b_zilla" data-default="" class="d-none">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12"><label class="text-uppercase d-none">State:</label>
                                        <div id="b_upozilla_error" class="text-danger"></div>
                                        <div id="add_upozilla" class="form-group select-wrapper">
                                            <select id="b_upozilla" name="b_upozilla" data-default="" class="d-none">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12"><label class="text-uppercase d-none">Zip/postal code:</label>
                                        <div id="b_zip_code_error" class="text-danger"></div>
                                        <div class="form-group"><input name="b_zip_code" id="b_zip_code" type="text"
                                                placeholder="Zip/postal code" class="form-control"></div>
                                    </div>
                                </div>
                                <label class="text-uppercase d-none">Address 1:</label>
                                <div id="b_address_error" class="text-danger"></div>
                                <div class="form-group"><input name="b_address" id="b_address" type="text"
                                        placeholder="Address" class="form-control"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mt-2 mt-md-0">
                        <div class="card card--grey">
                            <div class="card-body">
                                <h2 class="pb-1 fs-6">DELIVERY METHODS</h2>
                                @foreach ($shipping_methods as $shipping_method)
                                    <div class="customRadio clearfix">
                                        <input id="s_m_{{ $shipping_method->id }}" value="{{ $shipping_method->price }}"
                                            name="s_m" type="radio" class="radio shipping_method">
                                        <label for="s_m_{{ $shipping_method->id }}">{{ $shipping_method->name }}
                                            ${{ $shipping_method->price }} ({{ $shipping_method->delivery_days }}
                                            days)</label>


                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="card card--grey mt-2">
                            <div class="card-body">
                                <h2 class="fs-6">PAYMENT METHOD</h2>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="customRadio clearfix">
                                            <input id="formcheckoutRadio5" value="1" name="radio2" type="radio"
                                                class="radio payment_method">
                                            <label for="formcheckoutRadio5">Cash On Delivey</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="customRadio clearfix">
                                            <input id="formcheckoutRadio4" value="2" name="radio2" type="radio"
                                                class="radio payment_method">
                                            <label for="formcheckoutRadio4">Online Payment</label>
                                        </div>
                                    </div>
                                    <input type="hidden" id="p_m_input" value="" name='p_m_input'>

                                </div>
                                {{-- <div class="row">
                                            <div class="col-sm-12">
                                                <label class="text-uppercase d-none">Card Number</label>
                                                <div class="form-group"><input type="text" placeholder="Card Number" class="form-control" pattern="[0-9\-]*"></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label class="text-uppercase">Month:</label>
                                                <div class="form-group select-wrapper">
                                                    <select class="form-control">
                                                        <option selected="selected" value="1">January</option>
                                                        <option value="2">February</option>
                                                        <option value="3">March</option>
                                                        <option value="4">April</option>
                                                        <option value="5">May</option>
                                                        <option value="6">June</option>
                                                        <option value="7">July</option>
                                                        <option value="8">August</option>
                                                        <option value="9">September</option>
                                                        <option value="10">October</option>
                                                        <option value="11">November</option>
                                                        <option value="12">December</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label class="text-uppercase">Year:</label>
                                                <div class="form-group select-wrapper">
                                                    <select class="form-control">
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                        <option value="2022">2022</option>
                                                        <option value="2023">2023</option>
                                                        <option value="2024">2024</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label class="text-uppercase d-none">CVV Code</label>
                                                <div class="form-group m-0"><input type="text" placeholder="CVV Code" class="form-control" pattern="[0-9\-]*"></div>
                                            </div>
                                        </div> --}}
                            </div>
                        </div>
                        <div class="card card--grey mt-2">
                            <div class="card-body">
                                <h2 class="fs-6">Order Comment</h2>
                                <label class="text-uppercase d-none">Write a comment here:</label>
                                <textarea class="form-control textarea--height-200" rows="5" placeholder="Write a comment here"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4 mt-2 mt-lg-0">
                        <h2 class="title fs-6">ORDER SUMMARY</h2>
                        <div class="table-responsive order-table style1">
                            <table class="table table-bordered align-middle table-hover text-center mb-1">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th class="text-start">Name</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts->where('user_id', Auth::id()) as $cart)
                                        <tr>
                                            <td class="thumbImg"><a href="product-layout1.html"
                                                    class="thumb d-inline-block"><img class="cart__image"
                                                        src="{{ asset('storage/product_image/' . $cart->product->image) }}"
                                                        alt="Sunset Sleep Scarf Top" width="80" /></a></td>
                                            <td class="text-start">
                                                <a href="product-layout1.html">{{ $cart->product->name }}</a>
                                                <div class="cart__meta-text">
                                                    Color: {{ $cart->color }}<br>Size: {{ $cart->size }}<br>Brand:
                                                    {{ $cart->product->brands[0]->name }}
                                                </div>
                                            </td>
                                            <td>${{ $cart->price }}</td>
                                            <td>{{ $cart->quentity }}</td>
                                            <td class="fw-500">${{ $cart->total }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="font-weight-600">
                                    <tr id="table_s_t">
                                        <td colspan="4" class="text-end fw-bolder">Sub Total </td>
                                        <td class="fw-bolder">$<span
                                                id="sub_total">{{ $carts->where('user_id', Auth::id())->sum('total') }}</span>
                                        </td>
                                        <input type="hidden" name="cart_total" id="cart_total_input" value="{{ $carts->where('user_id', Auth::id())->sum('total') }}">
                                    </tr>


                                    <tr class="d-none" id="s_row">
                                        <td colspan="4" class="text-end fw-bolder">Shipping </td>
                                        <td class="fw-bolder">$<span id="shipping_price"></span></td>
                                        <input type="hidden" id="sipping_price_input" name="sipping_price" value="">
                                    </tr>
                                    <tr class="d-none" id="s_t_row">
                                        <td colspan="4" class="text-end fw-bolder">Total</td>
                                        <td class="fw-bolder">$<span id="shipping_total"></span></td>
                                    </tr>
                                    <tr class="d-none" id="g_t_row">
                                        <td colspan="4" class="text-end fw-bolder">Grand Total <span
                                                style="color:#fe877b">(less <span id="less_discount"></span>%)</span>
                                        </td>
                                        <td class="fw-bolder">$<span id="grand_total">sdf</span></td>
                                    </tr>
                                    <input type="hidden" id="g_t_input" name="g_t_input" value="">
                                    <input type="hidden" name="order_total" id="order_total" value="">
                                </tfoot>
                            </table>
                        </div>

                        <div class="card card--grey mt-2">
                            <div class="card-body d-none" id="coupone_show">
                                <h2 class="fs-6">Apply Couponcode</h2>
                                <h6 id="coupon_not_pound" class="text-danger"></h6>
                                <label class="text-uppercase d-none">Enter Coupon code:</label>
                                <div class="input-group flex-nowrap">
                                    <input id="coupon" class="input-group__field" type="text"
                                        placeholder="Coupon code" value="" name="coupon">
                                    <span class="input-group__btn">
                                        <input id="coupon_apply"  class="btn rounded-end text-nowrap"
                                            value="Apply">
                                    </span>
                                    <input type="hidden" name="coupon_id" id="coupon_id">
                                </div>
                            </div>
                        </div>
                        <div class="order-button-payment mt-2 clearfix">
                            <button type="submit" id="place_order" class="cartCheckout fs-6 btn btn-lg rounded w-100 fw-600 text-white">Place order</button>
                            </div>
                        <div class="paymnet-img text-center"><img
                                src="{{ asset('assets/frontend/assets') }}/images/payment-img.jpg" alt="Payment"></div>
                    </div>
                </div>
            </form>
        </div>
        <!--End Main Content-->
    </div>
    <!--End Body Container-->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            //set zilla
            $('#divission').change(function() {
                var id = $(this).val();

                $.ajax({
                    type: 'get',
                    url: "{{ route('frontend.divission_to_zilla') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#zilla').removeClass('d-none');
                        $('#zilla').html(response);
                    }

                });
            });

            //set upozila
            $('#zilla').change(function() {
                var id = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('frontend.zilla_to_upozilla') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#upozilla').removeClass('d-none');
                        $('#upozilla').html(response);
                    }

                });
            });
            //set b_zilla
            $('#b_divission').change(function() {
                var id = $(this).val();


                $.ajax({
                    type: 'get',
                    url: "{{ route('frontend.divission_to_zilla') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#b_zilla').removeClass('d-none');
                        $('#b_zilla').html(response);
                    }

                });
            });

            //     //set b_upozila
            $('#b_zilla').change(function() {
                var id = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('frontend.zilla_to_upozilla') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        $('#b_upozilla').removeClass('d-none');
                        $('#b_upozilla').html(response);
                    }
                });
            });


            //shipping method price
            $('.shipping_method').click(function() {
                var s_p = parseInt($(this).val());
                var s_s_t = parseInt($('#sub_total').text());

                $('#s_row').removeClass('d-none');
                $('#shipping_price').text(s_p);
                $('#sipping_price_input').val(s_p);
                $('#s_t_row').removeClass('d-none');
                $('#shipping_total').text(s_p + s_s_t);
                $('#coupone_show').removeClass('d-none');


                if (!isNaN($('#grand_total').text())) {

                    var g_t_input = parseInt($('#g_t_input').val());
                    $('#grand_total').text(g_t_input + s_p);
                    $('#order_total').val(g_t_input + s_p);

                }else{
                    $('#order_total').val(s_p + s_s_t);
                }

            });

            //cuppon apply
            $(document).on('click', '#coupon_apply', function(e) {
                e.preventDefault();
                var coupon = $('#coupon').val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('frontend.coupon.check') }}",
                    data: {
                        'coupon': coupon
                    },
                    success: function(response) {

                        if (response.fails) {
                            $('#coupon_not_pound').text(response.fails);
                        }
                        if (response.success) {
                            $('#g_t_row').removeClass('d-none');
                            var discount = response.success[0].discount;
                            $('#coupon_id').val(response.success[0].id);
                            var s_s_t = parseInt($('#sub_total').text());
                            var s_p = parseInt($('#shipping_price').text());
                            var g_toral = s_s_t - (s_s_t * discount) / 100;
                            var grand_total = parseInt(g_toral);
                            $('#grand_total').text(s_p + grand_total);
                            $('#less_discount').text(discount);
                            $('#g_t_input').val(grand_total);
                            $('#order_total').val(s_p + grand_total);


                        }
                    }
                });
            });


            //payment method
            $('.payment_method').click(function(){
                var this_vlaue = $(this).val();
                $('#p_m_input').val(this_vlaue);
                var p_m_input = $('#p_m_input').val();

            });

            // //place order
            $('#checkout_form').submit(function(e){
                e.preventDefault();
                if($('.shipping_method').is(":checked")){
                    if($('.payment_method').is(":checked")){


                     let insert_data = new FormData($('#checkout_form')[0]);
                //  var p_m_input = $('#p_m_input').val()

                    $.ajax({
                        type:'post',
                        url:"{{route('frontend.place.order')}}",
                        data:insert_data,
                        contentType: false,
                        processData: false,
                        success:function(response){
                            if(response.online_payment){
                                location.href = "{{route('pay')}}";
                            }
                            if(response.cod){
                                location.href = "{{route('shop')}}";
                                toastr.success('Your order is under processing! Thank your');
                            }
                            if(response.fails){
                                 $.each(response.fails, function(key, value) {
                                    $('#' + key + '_error').text(value);
                                });
                            }
                        }
                    });

                    }else{
                         toastr.error('paymnet metod not selected');
                    }
                }
                else{

                      toastr.error('shipping method and payment method not selected!', 'Error Alert');
                }

            });



        });
    </script>
    <script></script>
@endsection
