@extends('frontend.layouts.master')
@section('title')
    order detail
@endsection
@section('content')
    <!--Main Content-->
    <div class="container">
        <!--Cart Page-->
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-1 main-col">
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-10 main-col mb-3">

                <div class="col-md-12 col-lg-12 mt-2 mt-lg-0">
                    <h2 class="title fs-6 badge bg-warning ">ORDER Items</h2>
                    <a href="{{route('frontend.myAccount')}}" class="btn btn--small rounded " style="float: right">Back</a>
                    <div class="table-responsive order-table style1">
                        <table class="table table-bordered align-middle table-hover text-center mb-1">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th class="">Name</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($order_detail as $order)
                                    <tr>
                                        <td class="thumbImg"><a href="{{ route('product.details', $order->product->id) }}"
                                                class="thumb d-inline-block"><img class="cart__image"
                                                    src="{{ asset('storage/product_image/' . $order->product->image) }}"
                                                    alt="Sunset Sleep Scarf Top" width="80" /></a></td>
                                        <td class="">
                                            <a
                                                href="{{ route('product.details', $order->product->id) }}">{{ $order->product->name }}</a>
                                            <div class="cart__meta-text">
                                                Color: {{ $order->color }}<br>Size: {{ $order->size }}<br>
                                            </div>
                                        </td>
                                        <td>${{ $order->price }}</td>
                                        <td>{{ $order->quentity }}</td>
                                        <td class="fw-500">${{ $order->total }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot class="font-weight-600">
                                <tr>
                                    <td colspan="4" class="text-end fw-bolder">Shipping </td>
                                    <td class="fw-bolder">${{ $order->order__summery->sipping_price }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-end fw-bolder">Total</td>
                                    <td class="fw-bolder">${{ $order->order__summery->order_total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-1 main-col">
            </div>
            <div class="col-md-5 col-lg-1 mt-2 mt-lg-0"></div>
            <div class="col-md-5 col-lg-5 mt-2 mt-lg-0">
                <div class="card card--grey">
                    <div class="card-body">
                        <h2 class="pb-1 fs-6 badge bg-warning ">Shipping Details</h2>

                        <h6 class=""> Name : <span style="font-weight:400">{{ $billings_address->b_f_name }}
                                {{ $billings_address->b_l_name }}</span></h6>
                        <h6 class=""> Divission : <span style="font-weight:400">{{ $divission->name }}</span>
                        </h6>
                        <h6 class=""> Zilla : <span style="font-weight:400">{{ $zilla->name }}</span></h6>
                        <h6 class=""> Upozila : <span style="font-weight:400">{{ $upozilla->name }}</span></h6>
                        <h6 class=""> Zip Code : <span
                                style="font-weight:400">{{ $billings_address->b_zip_code }}</span></h6>
                        <h6 class=""> Address : <span
                                style="font-weight:400">{{ $billings_address->b_address }}</span></h6>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-5 mt-2 mt-lg-0">
                <div class="card card--grey">
                    <div class="card-body">
                        <h2 class="pb-1 fs-6 badge bg-warning ">Billings Details</h2>

                        <h6 class=""> Name : <span style="font-weight:400">{{ $billings_address->b_f_name }}
                                {{ $billings_address->b_l_name }}</span></h6>
                        <h6 class=""> Divission : <span style="font-weight:400">{{ $divission->name }}</span>
                        </h6>
                        <h6 class=""> Zilla : <span style="font-weight:400">{{ $zilla->name }}</span></h6>
                        <h6 class=""> Upozila : <span style="font-weight:400">{{ $upozilla->name }}</span></h6>
                        <h6 class=""> Zip Code : <span
                                style="font-weight:400">{{ $billings_address->b_zip_code }}</span></h6>
                        <h6 class=""> Address : <span
                                style="font-weight:400">{{ $billings_address->b_address }}</span></h6>
                    </div>
                </div>

            </div>

            <!--End Cart Page-->
        </div>
        <!--End Main Content-->
    </div>
    <!--End Body Container-->
@endsection
