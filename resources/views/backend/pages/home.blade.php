@extends('backend.layouts.master')
@section('title')
    Admin Dashboard
@endsection
@section('content')
    <section class="main_content dashboard_part large_header_bg">
        @include('backend.layouts.partials.header')
        <div class="main_content_iner overly_inner ">
            <div class="container-fluid p-0 ">

                 <div class="row ">
                    <div class="col-xl-12">
                        <div class="white_card  mb_30">
                            <div class="white_card_body anlite_table p-0">
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="single_analite_content">
                                            <h4>Total Order</h4>
                                            <h3><span class="counter">{{ $total_order}}</span> </h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_analite_content">
                                            <h4>Today Order</h4>
                                            <h3><span class="counter">{{ $today_order }}</span> </h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_analite_content">
                                            <h4>Today Sell</h4>
                                            <h3>$<span class="counter">{{$today_total_sell}}</span> </h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="single_analite_content">
                                            <h4>Today Profit</h4>
                                            <h3>$<span class="counter">{{$today_profit}}</span> </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                            <div class="page_title_left mb_10">
                                <h3 class="mb-0">Overview</h3>
                                <p>Statistics, Predictive Analytics Data Visualization, Big Data Analytics, etc.</p>
                            </div>
                            <div class="page_title_right">
                                <div class="dropdown CRM_dropdown  mr_5 mb_10">
                                    <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        14 March 2020
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Today</a>
                                        <a class="dropdown-item" href="#">This Week</a>
                                        <a class="dropdown-item" href="#">Last week</a>
                                    </div>
                                </div>
                                <a href="#" class="white_btn mb_10">Export</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="page_title_box d-flex flex-wrap align-items-center justify-content-between">
                            <div class="page_title_left">
                                <h3 class="mb-0">Dashboard</h3>
                                <p>Dashboard/Crypto currenct</p>
                            </div>
                            <div class="monitor_list_widget">
                                <div class="simgle_monitor_list">
                                    <div class="simgle_monitor_count d-flex align-items-center">
                                        <span>Purchase</span>
                                        <div id="monitor_1"></div>
                                    </div>
                                    <h4 class="counter">6,250</h4>
                                </div>
                                <div class="simgle_monitor_list">
                                    <div class="simgle_monitor_count d-flex align-items-center">
                                        <span>Purchase</span>
                                        <div id="monitor_2"></div>
                                    </div>
                                    <h4>$ <span class="counter">55,250</span> </h4>
                                </div>
                                <div class="simgle_monitor_list">
                                    <div class="simgle_monitor_count d-flex align-items-center">
                                        <span>Purchase</span>
                                        <div id="monitor_3"></div>
                                    </div>
                                    <h4>$ <span class="counter">451.6 </span>M </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">date</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <h6 class="card-subtitle mb-2">Usage <code>type="date"</code></h6>
                                <div class=" mb-0">
                                    <input type="date" class="form-control" name="inputDate" id="inputDate">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <h1>This is table header.</h1>
                    <table>
                        @foreach ($test as $order )

                        <tr>
                            {{$order->proudct_id}}
                        </tr>
                        @endforeach
                    </table>
                </div>


                {{-- <div class="col-xl-8 ">
                    <div class="white_card mb_30 card_height_100">
                        <div class="white_card_header">
                            <div class="box_header m-0">
                                <div class="main-title">
                                    <h3 class="m-0">Revenue Statistics</h3>
                                </div>
                                <div class="header_more_tool">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown">
                                            <i class="ti-more-alt"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#"> <i class="ti-eye"></i> Action</a>
                                            <a class="dropdown-item" href="#"> <i class="ti-trash"></i> Delete</a>
                                            <a class="dropdown-item" href="#"> <i class="fas fa-edit"></i> Edit</a>
                                            <a class="dropdown-item" href="#"> <i class="ti-printer"></i> Print</a>
                                            <a class="dropdown-item" href="#"> <i class="fa fa-download"></i>
                                                Download</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="white_card_body pb-0">
                            <div id="bar_chart"></div>
                        </div>
                    </div>
                </div> --}}


            </div>
        </div>



    </section>




    @include('backend.layouts.partials.footer')
    </section>
@endsection
