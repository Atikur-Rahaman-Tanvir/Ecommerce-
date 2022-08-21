@section('title')
myAccount
@endsection
@extends('frontend.layouts.master')
@section('content')
            <!--Body Container-->
            <div id="page-content">
                <!--Collection Banner-->
                <div class="collection-header">
                    <div class="collection-hero">
                        <div class="collection-hero__image"></div>
                        <div class="collection-hero__title-wrapper container">
                            <h1 class="collection-hero__title">My Account</h1>
                            <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index-2.html" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">My Account</span></div>
                        </div>
                    </div>
                </div>
                <!--End Collection Banner-->

                <!--Container-->
                <div class="container pt-2">
                    <!--Main Content-->
                    <div class="dashboard-upper-info">
                        <div class="row align-items-center g-0">
                            <div class="col-xl-3 col-lg-3 col-sm-6">
                                <div class="d-single-info">
                                    <p class="user-name">Hello <span class="fw-600">optimal</span></p>
                                    {{-- <p>(not optimal? <a class="link-underline fw-600" href="{{route('logout')}}">Log Out</a>)</p> --}}

                                        <form method="POST" name="logout" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="javascript:document.logout.submit()">Log Out</a>
                                        </form>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-sm-6">
                                <div class="d-single-info">
                                    <p>Need Assistance? Customer service at.</p>
                                    <p><a href="mailto:admin@example.com">admin@example.com</a></p>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-sm-6">
                                <div class="d-single-info">
                                    <p>E-mail them at </p>
                                    <p><a href="mailto:support@example.com">{{Auth::user()->email}}</a></p>
                                </div>
                            </div>
                            <div class="col-xl-2 col-lg-2 col-sm-6">
                                <div class="d-single-info text-lg-center">
                                    <a class="link-underline fw-600 view-cart" href="{{route('frontend.cart.index')}}"><i class="icon an an-sq-bag me-2"></i>View Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4 mb-lg-5 pb-lg-5">
                        <div class="col-xl-3 col-lg-2 col-md-12 mb-4 mb-lg-0">
                            <!-- Nav tabs -->
                            <ul class="nav flex-column bg-light h-100 dashboard-list" role="tablist">
                                <li><a class="nav-link active" data-bs-toggle="tab" href="#dashboard">Dashboard</a></li>
                                <li><a class="nav-link" data-bs-toggle="tab" href="#orders">Orders</a></li>
                                <li><a class="nav-link" data-bs-toggle="tab" href="#orderstracking">Orders tracking</a></li>
                                <li><a class="nav-link" data-bs-toggle="tab" href="#downloads">Downloads</a></li>
                                <li><a class="nav-link" data-bs-toggle="tab" href="#address">Addresses</a></li>
                                <li><a class="nav-link" data-bs-toggle="tab" href="#account-details">Account details</a></li>
                                <li><a class="nav-link" data-bs-toggle="tab" href="#wishlist">Wishlist</a></li>
                                <li><a class="nav-link" href="login.html">logout</a></li>
                            </ul>
                            <!-- End Nav tabs -->
                        </div>

                        <div class="col-xl-9 col-lg-10 col-md-12">
                            <!-- Tab panes -->
                            <div class="tab-content dashboard-content">
                                <!-- Dashboard -->
                                <div id="dashboard" class="tab-pane fade active show">
                                    <h3>Dashboard </h3>
                                    <p>From your account dashboard. you can easily check &amp; view your
                                        <a class="text-decoration-underline" href="#">recent orders</a>, manage your
                                        <a class="text-decoration-underline" href="#">shipping and billing addresses</a> and
                                        <a class="text-decoration-underline" href="#">edit your password and account details.</a>
                                    </p>
                                    <div class="row user-profile mt-4">
                                        <div class="col-12 col-lg-6">
                                            <div class="profile-img">
                                                <div class="img"><img src="{{asset('assets/frontend/assets')}}/images/avatar-img3.jpg" alt="profile" width="65" /></div>
                                                <div class="detail ms-3">
                                                    <h5 class="mb-1">Optimal</h5>
                                                    <p>Balance: <strong>$500</strong></p>
                                                </div>
                                                <div class="lbl">SILVER USER</div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6">
                                            <ul class="profile-order mt-3 mt-lg-0">
                                                <li>
                                                    <h3 class="mb-1">{{$order_summeries->count()}}</h3>
                                                    All Orders
                                                </li>
                                                <li>
                                                    <h3 class="mb-1">02</h3>
                                                    Awaiting Payments
                                                </li>
                                                <li>
                                                    <h3 class="mb-1">00</h3>
                                                    Awaiting Shipment
                                                </li>
                                                <li>
                                                    <h3 class="mb-1">01</h3>
                                                    Awaiting Delivery
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="table-responsive order-table mt-4">
                                        <table class="table table-bordered table-hover align-middle text-center mb-0">
                                            <thead class="alt-font">
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Product</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order_summeries as $order_summery )
                                                <tr>
                                                    <td>1</td>
                                                    <td>#{{$order_summery->order_id}}</td>
                                                    <td>{{$order_summery->created_at->format('M-d-y')}}</td>

                                                    @if($order_summery->p_m_input ==2)
                                                    <td class="text-success">{{$order_summery->order->status}}</td>
                                                    @else
                                                          <td class="text-danger">Pending</td>
                                                    @endif
                                                    <td>${{$order_summery->order_total}} for {{$order_summery->order_details->sum('quentity')}} item </td>

                                                    <td><a class="link-underline view" href="{{route('frontend.order.details', $order_summery->id)}}">View</a></td>
                                                </tr>
                                                @endforeach
                                                {{-- <tr>
                                                    <td>2</td>
                                                    <td>Floral Crop Top</td>
                                                    <td>May 12, 2021</td>
                                                    <td class="text-danger">Processing</td>
                                                    <td>$113.00 for 3 item </td>
                                                    <td><a class="link-underline view" href="cart-style1.html">View</a></td>
                                                </tr> --}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End Dashboard -->

                                <!-- Orders -->
                                <div id="orders" class="product-order tab-pane fade">
                                    <h3>Orders</h3>
                                    <div class="table-responsive order-table">
                                        <table class="table table-bordered table-hover align-middle text-center mb-0">
                                            <thead class="alt-font">
                                                <tr>
                                                    <th>Order</th>
                                                    <th>Product</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Total</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Long Sleeve T-shirts</td>
                                                    <td>March 04, 2021</td>
                                                    <td class="text-success">Completed</td>
                                                    <td>$165.00 for 1 item </td>
                                                    <td><a class="link-underline view" href="cart-style1.html">View</a></td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>Floral Crop Top</td>
                                                    <td>May 19, 2021</td>
                                                    <td class="text-success">Completed</td>
                                                    <td>$150.00 for 1 item </td>
                                                    <td><a class="link-underline view" href="cart-style1.html">View</a></td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>Bodysuit Black</td>
                                                    <td>June 24, 2021</td>
                                                    <td class="text-danger">Processing</td>
                                                    <td>$190.00 for 2 item </td>
                                                    <td><a class="link-underline view" href="cart-style1.html">View</a></td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>Hoodie Sweatshirt</td>
                                                    <td>July 28, 2021</td>
                                                    <td class="text-danger">Processing</td>
                                                    <td>$170.00 for 1 item </td>
                                                    <td><a class="link-underline view" href="cart-style1.html">View</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End Orders -->
                                <!-- Orders tracking -->
                                <div id="orderstracking" class="order-tracking tab-pane fade">
                                    <h3>Orders tracking</h3>
                                    <form class="orderstracking-from mt-3" method="post" action="#" id="order_tracking_form">
                                        <p class="mb-3">To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                        <div class="row align-items-center">
                                            <div class="form-group col-md-5 col-lg-5">
                                                <label for="orderId" class="d-none">Order ID <span class="required-f">*</span></label>
                                                <input name="orderId" placeholder="Order ID" value="" id="orderId" type="text" required>
                                            </div>
                                            <div class="form-group col-md-5 col-lg-5">
                                                <label for="billingEmail" class="d-none">Billing email <span class="required-f">*</span></label>
                                                <input name="billingEmail" placeholder="Billing email" value="" id="billingEmail" type="text" required>
                                            </div>
                                            <div class="form-group col-md-2 col-lg-2">
                                                <button type="submit" class="btn rounded w-100 h-100"><span>Track</span></button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row mt-2 d-none" id="track_details">
                                        <div class="col-sm-12">
                                            <h3 >Status for order no: <span id="order_id"></span></h3>
                                            <!-- Status Order -->
                                            <div class="row mt-3">
                                                {{-- <div class="col-lg-2 col-md-3 col-sm-4">
                                                    <div class="product-img mb-3 mb-sm-0">
                                                        <img class="blur-up lazyload" data-src="assets/images/products/product-6-1.jpg" src="assets/images/products/product-6-1.jpg" alt="product" title="">
                                                    </div>
                                                </div> --}}
                                                <div class="col-lg-6 col-md-9 col-sm-8">
                                                    <div class="tracking-detail d-flex-center">
                                                        <ul>

                                                            <li>
                                                                <div class="left"><span>order date</span></div>
                                                                <div class="right"><span id="order_date"></span></div>
                                                            </li>
                                                            <li>
                                                                <div class="left"><span>Ship Date</span></div>
                                                                <div class="right"><span id="delivery_date"></span></div>
                                                            </li>
                                                            <li>
                                                                <div class="left"><span>shipping address</span></div>
                                                                <div class="right"><span id="shipping_address"></span></div>
                                                            </li>

                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-12 col-sm-12 mt-4 mt-lg-0">
                                                    <div class="tracking-map map-section ratio ratio-16x9 h-100">
                                                        <iframe src="https://www.google.com/maps/embed?pb=" allowfullscreen="" height="650"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Status Order -->
                                            <!-- Tracking Steps -->
                                            <div id="tracking_panale" class="tracking-steps nav mt-5 mb-4 clearfix">
                                                <div id="placed" class="step"><span>order placed</span></div>
                                                <div id="packaging" class="step "><span>preparing to ship</span></div>
                                                <div id="shipped" class="step"><span>shipped</span></div>
                                                <div id="delivered" class="step"><span>delivered</span></div>
                                            </div>
                                            <!-- End Tracking Steps -->
                                            <!-- Order Table -->
                                            <div class="table-responsive order-table">
                                                <table class="table table-bordered table-hover align-middle text-center mb-0">
                                                    <thead class="">
                                                        <tr>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Time</th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Location</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>14 Nov 2021</td>
                                                            <td>08.00 AM</td>
                                                            <td>Shipped</td>
                                                            <td>Canada</td>
                                                        </tr>
                                                        <tr>
                                                            <td>15 Nov 2021</td>
                                                            <td>12.00 AM</td>
                                                            <td>Shipping info received</td>
                                                            <td>California</td>
                                                        </tr>
                                                        <tr>
                                                            <td>16 Nov 2021</td>
                                                            <td>10.00 AM</td>
                                                            <td>Origin scan</td>
                                                            <td>Landon</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- End Order Table -->
                                        </div>
                                    </div>
                                </div>
                                <!-- End Orders tracking -->

                                <!-- Downloads -->
                                <div id="downloads" class="product-order tab-pane fade">
                                    <h3>Downloads</h3>
                                    <div class="table-responsive order-table">
                                        <table class="table table-bordered table-hover align-middle text-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Downloads remaining</th>
                                                    <th>Expires</th>
                                                    <th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Long Sleeve T-shirts</td>
                                                    <td>July 22, 2021</td>
                                                    <td>Never</td>
                                                    <td><a class="link-underline view" href="#">Click Here To Download Your File</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Floral Crop Top</td>
                                                    <td>Dec 17, 2021</td>
                                                    <td>Never</td>
                                                    <td><a class="link-underline view" href="#">Click Here To Download Your File</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Bodysuit Black</td>
                                                    <td>June 24, 2021</td>
                                                    <td>Never</td>
                                                    <td><a class="link-underline view" href="#">Click Here To Download Your File</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Hoodie Sweatshirt</td>
                                                    <td>July 28, 2021</td>
                                                    <td>Never</td>
                                                    <td><a class="link-underline view" href="#">Click Here To Download Your File</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End Downloads -->

                                <!-- Address -->
                                <div id="address" class="address tab-pane">
                                    <h3>Addresses</h3>
                                    <p class="xs-fon-13 margin-10px-bottom">The following addresses will be used on the checkout page by default.</p>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <h4 class="billing-address">Shipping address</h4>
                                            <a class="link-underline view" href="#">Edit</a>
                                            <p>No 40 Baria Sreet <br> 133/2 NewYork City, <br> NY, United States.</p>

                                            <div class="accordion add-address mt-3" id="address1">
                                                <button class="collapsed btn btn--small rounded" type="button" data-bs-toggle="collapse" data-bs-target="#shipping" aria-expanded="false" aria-controls="shipping">Add Address</button>
                                                <div id="shipping" class="accordion-collapse collapse" data-bs-parent="#address">
                                                    <form class="address-from mt-3" method="post" action="#">
                                                        <fieldset>
                                                            <h2 class="login-title mb-3">Shipping details</h2>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-firstname1" class="d-none">First Name <span class="required-f">*</span></label>
                                                                    <input name="firstname" placeholder="First Name" value="" id="input-firstname1" type="text">
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-lastname1" class="d-none">Last Name <span class="required-f">*</span></label>
                                                                    <input name="lastname" placeholder="Last Name" value="" id="input-lastname1" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-email1" class="d-none">Email <span class="required-f">*</span></label>
                                                                    <input name="email" placeholder="Email" value="" id="input-email1" type="email" required>
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-telephone1" class="d-none">Telephone <span class="required-f">*</span></label>
                                                                    <input name="telephone" placeholder="Telephone" value="" id="input-telephone1" type="tel">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-company1" class="d-none">Company</label>
                                                                    <input name="company" placeholder="Company" value="" id="input-company1" type="text">
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-address-11" class="d-none">Address <span class="required-f">*</span></label>
                                                                    <input name="address_1" placeholder="Address" value="" id="input-address-11" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-address-21" class="d-none">Apartment <span class="required-f">*</span></label>
                                                                    <input name="address_2" placeholder="Apartment" value="" id="input-address-21" type="text">
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-city1" class="d-none">City <span class="required-f">*</span></label>
                                                                    <input name="city" placeholder="City" value="" id="input-city1" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-postcode1" class="d-none">Post Code <span class="required-f">*</span></label>
                                                                    <input name="postcode" placeholder="Post Code" value="" id="input-postcode1" type="text">
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-country1" class="d-none">Country <span class="required-f">*</span></label>
                                                                    <select name="country_id" id="input-country1">
                                                                        <option value="">Select Country</option>
                                                                        <option value="244">Aaland Islands</option>
                                                                        <option value="1">Afghanistan</option>
                                                                        <option value="2">Albania</option>
                                                                        <option value="3">Algeria</option>
                                                                        <option value="4">American Samoa</option>
                                                                        <option value="5">Andorra</option>
                                                                        <option value="6">Angola</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                                                    <label for="input-zone1" class="d-none">Region / State <span class="required-f">*</span></label>
                                                                    <select name="zone_id" id="input-zone1">
                                                                        <option value="">Select Region / State</option>
                                                                        <option value="3513">Aberdeen</option>
                                                                        <option value="3514">Aberdeenshire</option>
                                                                        <option value="3515">Anglesey</option>
                                                                        <option value="3516">Angus</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn rounded mt-1"><span>Add Address</span></button>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <h4 class="billing-address">Billing address</h4>
                                            <a class="link-underline view" href="#">Edit</a>
                                            <p>No 40 Baria Sreet <br> 133/2 NewYork City, <br> NY, United States.</p>

                                            <div class="accordion add-address mt-3" id="address2">
                                                <button class="collapsed btn btn--small rounded" type="button" data-bs-toggle="collapse" data-bs-target="#billing" aria-expanded="false" aria-controls="billing">Add Address</button>
                                                <div id="billing" class="accordion-collapse collapse" data-bs-parent="#address">
                                                    <form class="address-from mt-3" method="post" action="#">
                                                        <fieldset>
                                                            <h2 class="login-title mb-3">Billing details</h2>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-firstname2" class="d-none">First Name <span class="required-f">*</span></label>
                                                                    <input name="firstname" placeholder="First Name" value="" id="input-firstname2" type="text">
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-lastname2" class="d-none">Last Name <span class="required-f">*</span></label>
                                                                    <input name="lastname" placeholder="Last Name" value="" id="input-lastname2" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-email2" class="d-none">Email <span class="required-f">*</span></label>
                                                                    <input name="email" placeholder="Email" id="input-email2" type="email" required>
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-telephone2" class="d-none">Telephone <span class="required-f">*</span></label>
                                                                    <input name="telephone" placeholder="Telephone" value="" id="input-telephone2" type="tel">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-company2" class="d-none">Company</label>
                                                                    <input name="company" placeholder="Company" value="" id="input-company2" type="text">
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-address-12" class="d-none">Address <span class="required-f">*</span></label>
                                                                    <input name="address_1" placeholder="Address" value="" id="input-address-12" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-address-22" class="d-none">Apartment <span class="required-f">*</span></label>
                                                                    <input name="address_2" placeholder="Apartment" value="" id="input-address-22" type="text">
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-city2" class="d-none">City <span class="required-f">*</span></label>
                                                                    <input name="city" placeholder="City" value="" id="input-city2" type="text">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-postcode2" class="d-none">Post Code <span class="required-f">*</span></label>
                                                                    <input name="postcode" placeholder="Post Code" value="" id="input-postcode2" type="text">
                                                                </div>
                                                                <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                                    <label for="input-country2" class="d-none">Country <span class="required-f">*</span></label>
                                                                    <select name="country_id" id="input-country2">
                                                                        <option value="">Select Country</option>
                                                                        <option value="244">Aaland Islands</option>
                                                                        <option value="1">Afghanistan</option>
                                                                        <option value="2">Albania</option>
                                                                        <option value="3">Algeria</option>
                                                                        <option value="4">American Samoa</option>
                                                                        <option value="5">Andorra</option>
                                                                        <option value="6">Angola</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="form-group col-md-12 col-lg-12 col-xl-12">
                                                                    <label for="input-zone2" class="d-none">Region / State <span class="required-f">*</span></label>
                                                                    <select name="zone_id" id="input-zone2">
                                                                        <option value="">Select Region / State</option>
                                                                        <option value="3513">Aberdeen</option>
                                                                        <option value="3514">Aberdeenshire</option>
                                                                        <option value="3515">Anglesey</option>
                                                                        <option value="3516">Angus</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="btn rounded mt-1"><span>Add Address</span></button>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Address -->

                                <!-- Account Details -->
                                <div id="account-details" class="tab-pane fade">
                                    <h3>Account details </h3>
                                    <div class="account-login-form bg-light-gray padding-20px-all">
                                        <form>
                                            <fieldset>
                                                <p>Already have an account? <a href="login.html" class="link-underline"> Log in instead!</a></p>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="d-flex mt-3 col-md-12 col-lg-12 col-xl-12">
                                                            <label class="control-label me-3 mb-0"><strong>Title</strong></label>
                                                            <div class="customRadio clearfix me-3 mb-0">
                                                                <input name="mr" id="mr" value="1" checked="checked" type="radio" class="padding-10px-right">
                                                                <label for="mr" class="mb-0">Mr. &nbsp;</label>
                                                            </div>
                                                            <div class="customRadio clearfix me-3 mb-0">
                                                                <input name="mr" id="mrs" value="0" type="radio" class="padding-10px-right">
                                                                <label for="mrs" class="mb-0">Mrs.</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                        <label for="input-firstname" class="d-none">First Name <span class="required-f">*</span></label>
                                                        <input name="firstname" placeholder="First Name" value="" id="input-firstname" class="form-control" type="text">
                                                    </div>
                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                        <label for="input-lastname" class="d-none">Last Name <span class="required-f">*</span></label>
                                                        <input name="lastname" placeholder="Last Name" value="" id="input-lastname" class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                        <label for="input-email" class="d-none">Email <span class="required-f">*</span></label>
                                                        <input name="email" placeholder="Email" value="" id="input-email" class="form-control" type="email" required>
                                                    </div>
                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                        <label for="input-password" class="d-none">Password <span class="required-f">*</span></label>
                                                        <input name="password" placeholder="Password" value="" id="input-password" class="form-control" type="password">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                        <label for="input-telephone" class="d-none">Telephone <span class="required-f">*</span></label>
                                                        <input name="telephone" placeholder="Telephone" value="" id="input-telephone" class="form-control" type="tel">
                                                    </div>
                                                    <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                        <label class="d-none">Birthdate <span class="required-f">*</span></label>
                                                        <input name="birthdate" class="form-control" type="date">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                        <div class="customCheckbox clearfix mb-2">
                                                            <input id="offers" name="offers" type="checkbox" />
                                                            <label for="offers">Receive offers from our partners</label>
                                                        </div>
                                                        <div class="customCheckbox clearfix">
                                                            <input id="newsletter" name="newsletter" type="checkbox" />
                                                            <label for="newsletter">Sign up for our newsletter</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary rounded">Save</button>
                                        </form>
                                    </div>
                                </div>
                                <!-- End Account Details -->

                                <!-- Wishlist -->
                                <div id="wishlist" class="product-wishlist tab-pane fade">
                                    <h3>My Wishlist</h3>
                                    <!-- Grid Product -->
                                    <div class="grid-products grid--view-items wishlist-grid mt-4">
                                        <div class="row">
                                            @foreach ($wishlists as $wishlist )

                                            <div class="col-6 col-sm-6 col-md-3 col-lg-3 item position-relative">
                                                <a id="{{$wishlist->id}}" class="wilshList_porduct_remove" ><button type="button" class="btn remove-icon close-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove"><i class="icon an an-times-r"></i></button></a>


                                                <!-- Product Image -->
                                                <div class="product-image">
                                                    <!-- Product Image -->
                                                    <a href="{{route('product.details',$wishlist->product->id)}}" class="product-img">
                                                        <!-- image -->
                                                        <img class="primary blur-up lazyload" data-src="{{asset("storage/product_image/".$wishlist->product->image)}}" src="{{asset("storage/product_image/".$wishlist->product->image)}}" alt="product" title="product" />
                                                        <!-- End image -->
                                                        <!-- Hover image -->
                                                        <img class="hover blur-up lazyload" data-src="{{asset("storage/product_image/".$wishlist->product->image)}}" src="ass{{asset("storage/product_image/".$wishlist->product->image)}}" alt="product" title="product" />
                                                        <!-- End hover image -->
                                                        <!-- product label -->
                                                        @if ($wishlist->product->quentity <= 10)
                                                        <div class="product-labels rectangular"><span class="lbl pr-label3">Low in stock</span></div>
                                                        @elseif ($wishlist->product->quentity == 0)
                                                        <div class="product-labels rectangular"><span class="lbl pr-label3">out of stock</span></div>

                                                        @endif
                                                        <!-- End product label -->
                                                    </a>
                                                    <!-- End Product Image -->
                                                </div>
                                                <!-- End Product Image -->

                                                <!-- Product Details -->
                                                <div class="product-details text-center">
                                                    <!-- Product Name -->
                                                    <div class="product-name">
                                                        <a href="{{route('product.details',$wishlist->product->id)}}">{{$wishlist->product->name}}</a>
                                                    </div>
                                                    <!-- End Product Name -->
                                                    <!-- Product Price -->
                                                    <div class="product-price">
                                                        @if(!$wishlist->product->discount)
                                                        <span class="old-price">${{$wishlist->product->price}}</span>
                                                        @else
                                                        <span class="old-price">${{$wishlist->product->price}}</span>
                                                        <span class="price">${{round($wishlist->product->price - ($wishlist->product->discount*$wishlist->product->price)/100)}}</span>
                                                        @endif
                                                    </div>
                                                    <!-- End Product Price -->
                                                    <!-- Product Review -->
                                                    <div class="product-review d-flex align-items-center justify-content-center">
                                                        <i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i> <i class="an an-star-o"></i>
                                                        <span class="caption hidden ms-2">9 reviews</span>
                                                    </div>
                                                    <!-- End Product Review -->
                                                    <!-- Product Button -->
                                                    <form method="post" action="https://template.annimexweb.com/cart/add" class="cart-form mt-3" enctype="multipart/form-data">
                                                        @if (!$wishlist->product->quentity == 0)
                                                        <a id="{{$wishlist->id}}" class="btn btn-small rounded-1 text-nowrap wishlist_to_cart">Add To Cart</a>
                                                        @else
                                                        <a class="btn btn-small rounded-1 text-nowrap soldOutBtn disabled">Out Of stock</a>
                                                        @endif
                                                    </form>
                                                    <!-- End Product Button -->
                                                </div>
                                                <!-- End Product Details -->
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!-- End Grid Product-->
                                </div>
                                <!-- End Wishlist -->
                            </div>
                            <!-- End Tab panes -->
                        </div>
                    </div>
                    <!--End Main Content-->
                </div>
                <!--End Container-->
            </div>
            <!--End Body Container-->


@endsection
@section('scripts')
<script>
    // order tracking
    $('#order_tracking_form').submit(function(e){
       e.preventDefault();
       let order_track = new FormData($('#order_tracking_form')[0]);
       $.ajax({
        type:'post',
        url:"{{route('frontend.order.track')}}",
        data:order_track,
        contentType: false,
         processData: false,
         success:function(response){
             // console.log(response);
             $('#track_details').removeClass('d-none');
             $('#order_id').text('#'+response.order.order_id);
             $('#order_date').text(response.order_date);
             $('#delivery_date').text(response.order.delivery_date);
             $('#shipping_address').text( response.upozilla+', '+response.zilla+', '+response.divission+', '+response.shipping.address);
            if(response.order_placed){
                $('#placed').addClass('current');
            }
            if(response.order_packaing){
            $('#placed').addClass('done');
            $('#packaging').addClass('current');
         }
            if(response.order_shipped){
            $('#placed').addClass('done');
            $('#packaging').addClass('done');
            $('#shipped').addClass('current');
         }
            if(response.order_delivered){
            $('#placed').addClass('done');
            $('#packaging').addClass('done');
            $('#shipped').addClass('done');
            $('#delivered').addClass('current');
         }
         }
       });
    });

         // remove product form wishlist
            $('.wilshList_porduct_remove').click(function(){
                var id = $(this).attr('id');
                $.ajax({
                    type:'get',
                    url:"{{route('frontend.wishlist.product.remove')}}",
                    data:{'id':id},

                    success:function(response){
                       if(response.success){
                            location.reload();
                       }
                    }
                });

            });

               //product wishlist to cart
             $('.wishlist_to_cart').click(function(e){
                e.preventDefault();
              var id = $(this).attr('id');

                   $.ajax({
                    type:'get',
                    url:"{{route('frontend.wishlist.to.cart')}}",
                    data:{'id':id},
                    success:function(response){
                       if(response.success){
                            // window.location.href="{{route('frontend.cart.index')}}";
                            location.reload();
                            // $('#wishlist').load(location.href + ' #wishlist');
                       }
                    }
                });


             });
</script>
@endsection
