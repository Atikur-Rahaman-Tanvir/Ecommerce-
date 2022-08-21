@extends('frontend.layouts.master')
@section('title')
empty cart page
@endsection
@section('content')


            <!--Body Container-->
            <div id="page-content">
                <!--Collection Banner-->
                <div class="collection-header">
                    <div class="collection-hero">
                        <div class="collection-hero__image"></div>
                        <div class="collection-hero__title-wrapper container">
                            <h1 class="collection-hero__title">Order Completed!</h1>
                            <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index-2.html" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Cart Empty</span></div>
                        </div>
                    </div>
                </div>
                <!--End Collection Banner-->

                <!--Container-->
                <div class="container">
                    <!--Category Empty-->
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 text-center pt-5 pb-5">
                            <p><img width="100" src="{{asset('assets/frontend/assets')}}/images/order_complete.png" alt="" /></p>
                            <h2 class="mt-4"><strong>SORRY,</strong> Your Payment Successfully Completed!</h2>
                            <p class="mb-3 pb-1">If you want to shop more click bellow Continue Shopping.</p>
                            <p><a href="{{route('shop')}}" class="btn rounded mb-2 text-capitalize">Continue shopping</a></p>
                        </div>
                    </div>
                    <!--End Category Empty-->
                </div>
                <!--End Container-->
            </div>
            <!--End Body Container-->

@endsection
