@extends('frontend.layouts.master')
@section('title')
    product details
@endsection
@section('setyles')
    <style>
        .tablink {
            margin-right: 20px;
            /* margin-bottom: 40px; */
            font-weight: 500;
            font-size: 16px;

        }

        .an {
            margin-top: 8px;
        }
    </style>
@endsection
@section('content')
    <!--Body Container-->
    <div id="page-content">
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper text-uppercase">
            <div class="container">
                <div class="breadcrumbs"><a href="{{ route('home') }}"
                        title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Product Details</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->

        <!--Main Content-->
        <div class="container">
            <!--Product Content-->
            <div class="product-single">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12 col-12">
                        <div class="product-details-img thumb-left clearfix d-flex-wrap mb-3 mb-md-0">
                            <div class="product-thumb">
                                <div id="gallery" class="product-dec-slider-2 product-tab-left">

                                    @foreach ($product->product_featured_images as $image)
                                        <a data-image="{{ asset('storage/product_featured_image/' . $image->product_featured_image) }}"
                                            data-zoom-image="{{ asset('storage/product_featured_image/' . $image->product_featured_image) }}"
                                            class="slick-slide slick-cloned active">
                                            <img class="blur-up lazyload"
                                                data-src="{{ asset('storage/product_featured_image/' . $image->product_featured_image) }}"
                                                src="{{ asset('storage/product_featured_image/' . $image->product_featured_image) }}"
                                                alt="product" />
                                        </a>
                                    @endforeach


                                </div>
                            </div>
                            <div class="zoompro-wrap product-zoom-right">

                                <div class="zoompro-span"><img id="zoompro" class="zoompro"
                                        src="{{ asset('storage/product_featured_image/' . $f_f_image) }}"
                                        data-zoom-image="{{ asset('storage/product_featured_image/' . $f_f_image) }}" />
                                </div>

                                <div class="product-labels"><span class="lbl pr-label1">new</span><span
                                        class="lbl on-sale">Best seller</span></div>
                                @if (App\Models\Wishlist::where('user_id', Auth::id())->where('product_id', $product->id)->exists())
                                    <div class="product-wish"><a  href="{{route('frontend.wishlist.index')}}" class="wishIcon wishlist rounded m-0 text-danger"><i
                                            class="icon an an-heart"></i><span class="tooltip-label left">Available in
                                            Wishlist</span></a></div>
                                @else
                                       <div class="product-wish"><a id="wish_list" class="wishIcon wishlist rounded m-0 text-success"><i
                                            class="icon an an-heart"></i><span class="tooltip-label left">Add in
                                            Wishlist</span></a></div>
                                @endif
                                <div class="product-buttons">
                                    <a href="https://www.youtube.com/watch?v=93A2jOW5Mog"
                                        class="mfpbox mfp-with-anim btn rounded popup-video"><i
                                            class="icon an an-video"></i><span class="tooltip-label">Watch Video</span></a>
                                    <a href="#" class="btn rounded prlightbox"><i
                                            class="icon an an-expand-l-arrows"></i><span class="tooltip-label">Zoom
                                            Image</span></a>
                                </div>
                            </div>
                            <div class="lightboximages">
                                <a href="{{ asset('storage/product_featured_image/' . $f_f_image) }}"
                                    data-size="1000x1280"></a>
                                <a href="{{ asset('assets/frontend/assets') }}/images/products/product-6-2.jpg"
                                    data-size="1000x1280"></a>
                                <a href="{{ asset('assets/frontend/assets') }}/images/products/product-6-3.jpg"
                                    data-size="1000x1280"></a>
                                <a href="{{ asset('assets/frontend/assets') }}/images/products/product-6-4.jpg"
                                    data-size="1000x1280"></a>
                                <a href="{{ asset('assets/frontend/assets') }}/images/products/product-6-5.jpg"
                                    data-size="1000x1280"></a>
                                <a href="{{ asset('assets/frontend/assets') }}/images/products/product-6-6.jpg"
                                    data-size="1000x1280"></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-6 col-sm-12 col-12">
                        <!-- Product Info -->
                        <div class="product-single__meta">
                            <h1 class="product-single__title">{{ $product->name }}</h1>
                            <div class="product-single__subtitle">From Italy</div>
                            <!-- Product Reviews -->
                            <div class="product-review mb-2"><a class="reviewLink d-flex-center" href="#reviews"><i
                                        class="an an-star"></i><i class="an an-star mx-1"></i><i class="an an-star"></i><i
                                        class="an an-star mx-1"></i><i class="an an-star-o"></i><span
                                        class="spr-badge-caption ms-2">16 Reviews</span></a></div>
                            <!-- End Product Reviews -->
                            <!-- Product Info -->
                            <div class="product-info">
                                <p class="product-type">Vendor: <span>Bohemian France</span></p>


                                <p class="product-type">Product Category: <span>{{ $product->category->name }}</span></p>

                                <p class="product-sku">SKU: <span class="variant-sku">1416PT-1</span></p>
                            </div>
                            <!-- End Product Info -->
                            <!-- Product Price -->
                            <div class="product-single__price pb-1">
                                <span class="visually-hidden">Regular price</span>
                                <span class="product-price__sale--single">
                                    <span class="product-price-old-price">${{ $product->price }}</span><span
                                        class="product-price__price product-price__sale">
                                        @if ($product->discount)
                                            {{ round($product->price - ($product->price * $product->discount) / 100) }}
                                        @endif
                                    </span>
                                    @if ($product->discount)
                                        <span class="discount-badge"><span class="devider me-2">|</span><span>Save:
                                            </span><span class="product-single__save-amount"><span
                                                    class="money">${{ round(($product->price * $product->discount) / 100) }}</span></span><span
                                                class="off ms-1">(<span>{{ $product->discount }}</span>%)</span></span>
                                    @endif
                                </span>
                                <div class="product__policies fw-normal mt-1">Tax included.</div>
                            </div>
                            <!-- End Product Price -->
                            <!-- Countdown -->
                            <div class="countdown-text d-flex-wrap mb-3 pb-1">
                                <label class="mb-2 mb-lg-0">Limited-Time Offer :</label>
                                <div class="prcountdown d-flex" data-countdown="2024/10/01"></div>
                            </div>
                            <!-- End Countdown -->
                            <!-- Product Sold -->
                            <div class="orderMsg d-flex-center" data-user="23" data-time="24">
                                <img src="{{ asset('assets/frontend/assets') }}/images/order-icon.jpg" alt="order" />
                                <p class="m-0"><strong class="items">8</strong> Sold in last <strong
                                        class="time">14</strong> hours</p>
                                <p id="quantity_message" class="ms-2 ps-2 border-start">Hurry! Only <span
                                        class="items fw-bold">4</span> left in stock.</p>
                            </div>
                            <!-- End Product Sold -->
                        </div>
                        <!-- End Product Info -->
                        <!-- Product Form -->
                        <form id="add_to_cart_form" class="product-form hidedropdown">
                            @csrf
                            <!-- Swatches Color -->

                            {{-- <label class="label d-flex">Color:<span class="required d-none">*</span><span class="slVariant ms-1 fw-bold">Red</span></label> --}}
                            <div class="sidebar_widget filterBox filter-widget">
                                <div class=""><span class="mb-2" style="font-weight: 500">COLOR : <span
                                            id="color_name_set"></span></span></div>
                                <div class="filter-color swacth-list filterDD clearfix">
                                    <ul class="clearfix">
                                        @foreach ($product->colors as $color)
                                            <li id="{{ $color->name }}" class="color"><span
                                                    class="swacth-btn medium radius"
                                                    style="background-color: {{ $color->color_code }}"></span><span
                                                    class="tooltip-label">{{ $color->name }}</span></li>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>

                            <!-- End Swatches Color -->
                            <!-- Swatches Size -->
                            <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                <div class="product-form__item">
                                    <label class="label d-flex mt-3">Size : <span id="size_name_set"> </span><span
                                            class="required d-none">*</span><span
                                            class="slVariant ms-1 fw-bold"></span></label>
                                    <ul class="swatches-size d-flex-center list-unstyled clearfix">

                                        @foreach ($product->sizes as $size)
                                            <li id="{{ $size->name }}" data-value="S"
                                                class="swatch-element s available active size">
                                                <label class="swatchLbl rounded medium"
                                                    title="S">{{ $size->name }}</label><span
                                                    class="tooltip-label">{{ $size->name }}</span>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                            </div>
                            <!-- End Swatches Size -->
                            <!-- Product Action -->
                            <div class="product-action w-100 clearfix">
                                <div class="product-form__item--quantity d-flex-center mb-3">
                                    <div class="qtyField">
                                        <a id="quentity_minus" class="qtyBtn minus" href="javascript:void(0);"><i
                                                class="icon an an-minus-r" aria-hidden="true"></i></a>
                                        <input id="quentity" type="text" name="quantity" value="1"
                                            class="product-form__input qty">
                                        <a id="quentity_plus" class="qtyBtn plus" href="javascript:void(0);"><i
                                                class="icon an an-plus-r" aria-hidden="true"></i></a>
                                    </div>
                                    <input id="product_id" type="hidden" value="{{ $product->id }}">
                                    <div class="pro-stockLbl ms-3">
                                        @if ($product->quentity > 10)
                                            <span class="d-flex-center stockLbl instock"><i
                                                    class="icon an an-check-cil"></i><span> In stock</span></span>
                                        @endif
                                        @if ($product->quentity == 0)
                                            <span class="d-flex-center stockLbl outstock "><i
                                                    class="icon an an-times-cil"></i> <span>Sold out</span></span>
                                        @endif

                                        <span class="d-flex-center stockLbl preorder d-none"><i
                                                class="icon an an-clock-r"></i><span> Pre-order Now</span></span>

                                        @if ($product->quentity <= 10 && $product->quentity != 0)
                                            <span class="d-flex-center stockLbl lowstock " data-qty="15"><i
                                                    class="icon an an-exclamation-cir"></i><span> Order now, Only <span
                                                        class="items">{{ 5 }}</span> left!</span></span>
                                        @endif
                                    </div>
                                </div>
                                <div class="product-form__item--submit">
                                    {{-- @guest
                                        <button  type="button" name="add"
                                            class="btn rounded product-form__cart-submit" data-bs-toggle="modal"
                                                    data-bs-target="#login_modal"><span>Add to cart</span></button>
                                    @else --}}
                                    @if ($product->quentity >= 1)
                                        <button id="add_to_cart" type="button" name="add"
                                            class="btn rounded product-form__cart-submit"><span>Add to cart</span></button>
                                    @else
                                        <button type="submit" name="add" class="btn rounded product-form__sold-out"
                                            disabled="disabled">Sold
                                            out</button>
                                    @endif

                                </div>
                                @if ($product->quentity >= 1)
                                    <div class="product-form__item--buyit clearfix">
                                        <button type="button"
                                            class="btn rounded btn-outline-primary proceed-to-checkout">Buy
                                            it now</button>
                                    </div>
                                @endif
                                <div class="agree-check customCheckbox clearfix d-none">
                                    <input id="prTearm" name="tearm" type="checkbox" value="tearm" required />
                                    <label for="prTearm">I agree with the terms and conditions</label>
                                </div>
                            </div>
                            <!-- End Product Action -->
                            <!-- Product Info link -->
                            <p class="infolinks d-flex-center mt-2 mb-3">
                                <a class="btn add-to-wishlist d-none" href="my-wishlist.html"><i
                                        class="icon an an-heart-l me-1" aria-hidden="true"></i> <span>Add to
                                        Wishlist</span></a>
                                <a class="btn add-to-wishlist" href="compare-style1.html"><i
                                        class="icon an an-sync-ar me-1" aria-hidden="true"></i> <span>Add to
                                        Compare</span></a>
                                <a class="btn shippingInfo" href="#ShippingInfo"><i
                                        class="icon an an-paper-l-plane me-1"></i> Delivery &amp; Returns</a>
                                <a class="btn emaillink me-0" href="#productInquiry"> <i
                                        class="icon an an-question-cil me-1"></i> Ask A Question</a>
                            </p>
                            <!-- End Product Info link -->
                        </form>
                        <!-- End Product Form -->
                        <!-- Social Sharing -->
                        <div class="social-sharing d-flex-center mb-3">
                            <span class="sharing-lbl me-2">Share :</span>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-facebook"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"><i
                                    class="icon an an-facebook mx-1"></i><span
                                    class="share-title d-none">Facebook</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-twitter"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Tweet on Twitter"><i
                                    class="icon an an-twitter mx-1"></i><span class="share-title d-none">Tweet</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-pinterest"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Pin on Pinterest"><i
                                    class="icon an an-pinterest-p mx-1"></i> <span class="share-title d-none">Pin
                                    it</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-linkedin"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Linkedin"><i
                                    class="icon an an-linkedin mx-1"></i><span
                                    class="share-title d-none">Linkedin</span></a>
                            <a href="#" class="d-flex-center btn btn-link btn--share share-email"
                                data-bs-toggle="tooltip" data-bs-placement="top" title="Share by Email"><i
                                    class="icon an an-envelope-l mx-1"></i><span
                                    class="share-title d-none">Email</span></a>
                        </div>
                        <!-- End Social Sharing -->
                        <!-- Product Info -->
                        <div class="freeShipMsg" data-price="199"><i class="icon an an-truck"
                                aria-hidden="true"></i>SPENT <b class="freeShip"><span class="money"
                                    data-currency-usd="$199.00" data-currency="USD">$199.00</span></b> MORE FOR FREE
                            SHIPPING</div>
                        <div class="shippingMsg"><i class="icon an an-clock-r" aria-hidden="true"></i>Estimated Delivery
                            Between <b id="fromDate">Wed, May 1</b> and <b id="toDate">Tue, May 7</b>.</div>
                        <div class="userViewMsg" data-user="20" data-time="11000"><i class="icon an an-eye-r"
                                aria-hidden="true"></i><strong class="uersView">21</strong> People are Looking for this
                            Product</div>
                        <div class="trustseal-img mt-4"><img
                                src="{{ asset('assets/frontend/assets') }}/images/powerby-cards.jpg"
                                alt="powerby cards" /></div>
                        <!-- End Product Info -->
                    </div>
                </div>
            </div>
            <!--Product Content-->

            <!--Product Nav-->
            <a href="product-layout7.html" class="product-nav prev-pro d-flex-center justify-content-between"
                title="Previous Product">
                <span class="details">
                    <span class="name">Mini Sleev Top</span>
                    <span class="price">$199.00</span>
                </span>
                <span class="img"><img src="{{ asset('assets/frontend/assets') }}/images/products/product-7.jpg"
                        alt="product" /></span>
            </a>
            <a href="product-layout2.html" class="product-nav next-pro d-flex-center justify-content-between"
                title="Next Product">
                <span class="img"><img src="{{ asset('assets/frontend/assets') }}/images/products/product-2.jpg"
                        alt="product"></span>
                <span class="details">
                    <span class="name">Ditsy Floral Dress</span>
                    <span class="price">$99</span>
                </span>
            </a>
            <!--End Product Nav-->

            <!--Product Tabs-->
            <div class="tabs-listing mt-2 mt-md-5" >
                <ul class="product-tabs list-unstyled d-flex-wrap border-bottom m-0 d-none d-md-flex" >
                    <li rel="description" class="active"><a class="tablink">Description</a></li>
                    <li rel="size-chart" class=""><a class="tablink">Size Chart</a></li>
                    <li rel="shipping-return" class=""><a class="tablink">Shipping &amp; Return</a></li>
                    <li rel="reviews" class=""><a class="tablink">Reviews</a></li>
                    <li rel="addtional-tabs" class=""><a class="tablink">Addtional Tabs</a></li>
                </ul>
                <div class="tab-container" style="margin-top: 30px">
                    <h3 class="tabs-ac-style d-md-none active" rel="description">Description</h3>
                    <div id="description" class="tab-content" style="display: block;">
                        <div class="product-description">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4 mb-md-0">
                                    {!! $product->description !!}

                                </div>
                                <div class="col-12 col-sm-12 col-md-4 col-lg-4">

                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="tabs-ac-style d-md-none" rel="size-chart">Size Chart</h3>
                    <div id="size-chart" class="tab-content" style="display: none;">
                        <h4 class="fw-bold text-center">Size Guide</h4>
                        <p class="text-center">This is a standardised guide to give you an idea of what size you will need,
                            however some brands may vary from these conversions.</p>
                        <p class="text-center"><strong>Ready to Wear Clothing</strong></p>
                        <div class="table-responsive px-1">
                            <table class="table table-bordered align-middle">
                                <tbody>
                                    <tr>
                                        <th>Size</th>
                                        <th>XXS - XS</th>
                                        <th>XS - S</th>
                                        <th>S - M</th>
                                        <th>M - L</th>
                                        <th>L - XL</th>
                                        <th>XL - XXL</th>
                                    </tr>
                                    <tr>
                                        <td>UK</td>
                                        <td>6</td>
                                        <td>8</td>
                                        <td>10</td>
                                        <td>12</td>
                                        <td>14</td>
                                        <td>16</td>
                                    </tr>
                                    <tr>
                                        <td>US</td>
                                        <td>2</td>
                                        <td>4</td>
                                        <td>6</td>
                                        <td>8</td>
                                        <td>10</td>
                                        <td>12</td>
                                    </tr>
                                    <tr>
                                        <td>Italy (IT)</td>
                                        <td>38</td>
                                        <td>40</td>
                                        <td>42</td>
                                        <td>44</td>
                                        <td>46</td>
                                        <td>48</td>
                                    </tr>
                                    <tr>
                                        <td>France (FR/EU)</td>
                                        <td>34</td>
                                        <td>36</td>
                                        <td>38</td>
                                        <td>40</td>
                                        <td>42</td>
                                        <td>44</td>
                                    </tr>
                                    <tr>
                                        <td>Denmark</td>
                                        <td>32</td>
                                        <td>34</td>
                                        <td>36</td>
                                        <td>38</td>
                                        <td>40</td>
                                        <td>42</td>
                                    </tr>
                                    <tr>
                                        <td>Russia</td>
                                        <td>40</td>
                                        <td>42</td>
                                        <td>44</td>
                                        <td>46</td>
                                        <td>48</td>
                                        <td>50</td>
                                    </tr>
                                    <tr>
                                        <td>Germany</td>
                                        <td>32</td>
                                        <td>34</td>
                                        <td>36</td>
                                        <td>38</td>
                                        <td>40</td>
                                        <td>42</td>
                                    </tr>
                                    <tr>
                                        <td>Japan</td>
                                        <td>5</td>
                                        <td>7</td>
                                        <td>9</td>
                                        <td>11</td>
                                        <td>13</td>
                                        <td>15</td>
                                    </tr>
                                    <tr>
                                        <td>Australia</td>
                                        <td>6</td>
                                        <td>8</td>
                                        <td>10</td>
                                        <td>12</td>
                                        <td>14</td>
                                        <td>16</td>
                                    </tr>
                                    <tr>
                                        <td>Korea</td>
                                        <td>33</td>
                                        <td>44</td>
                                        <td>55</td>
                                        <td>66</td>
                                        <td>77</td>
                                        <td>88</td>
                                    </tr>
                                    <tr>
                                        <td>China</td>
                                        <td>160/84</td>
                                        <td>165/86</td>
                                        <td>170/88</td>
                                        <td>175/90</td>
                                        <td>180/92</td>
                                        <td>185/94</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Jeans</strong></td>
                                        <td>24-25</td>
                                        <td>26-27</td>
                                        <td>27-28</td>
                                        <td>29-30</td>
                                        <td>31-32</td>
                                        <td>32-33</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <h3 class="tabs-ac-style d-md-none" rel="shipping-return">Shipping &amp; Return</h3>
                    <div id="shipping-return" class="tab-content" style="display: none;">
                        <h4 class="pt-2 text-uppercase">Delivery</h4>
                        <ul>
                            <li>Dispatch: Within 24 Hours</li>
                            <li>Free shipping across all products on a minimum purchase of $50.</li>
                            <li>International delivery time - 7-10 business days</li>
                            <li>Cash on delivery might be available</li>
                            <li>Easy 30 days returns and exchanges</li>
                        </ul>
                        <h4 class="pt-2 text-uppercase">Returns</h4>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                            but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                        <h4 class="pt-2 text-uppercase">Shipping</h4>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                            alteration in some form, by injected humour, or randomised words which don't look even slightly
                            believable. If you are going to use a passage.</p>
                    </div>

                    <h3 class="tabs-ac-style d-md-none" rel="reviews">Review</h3>
                    <div id="reviews" class="tab-content" style="display: none;">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="spr-header clearfix d-flex-center justify-content-between">
                                    <div class="product-review d-flex-center me-auto">
                                        <a class="reviewLink" href="#"><i class="icon an an-star"></i><i
                                                class="icon an an-star mx-1"></i><i class="icon an an-star"></i><i
                                                class="icon an an-star mx-1"></i><i class="icon an an-star-o"></i></a>
                                        <span class="spr-summary-actions-togglereviews ms-2">Based on 6 reviews 234</span>
                                    </div>
                                    <div class="spr-summary-actions mt-3 mt-sm-0">
                                        <a href="#"
                                            class="spr-summary-actions-newreview write-review-btn btn rounded"><i
                                                class="icon an-1x an an-pencil-alt me-2"></i>Write a review</a>
                                    </div>
                                </div>

                                <form method="post" action="#" class="product-review-form new-review-form mb-4">
                                    <h4 class="spr-form-title text-uppercase">Write A Review</h4>
                                    <fieldset class="spr-form-contact">
                                        <div class="spr-form-contact-name form-group">
                                            <label class="spr-form-label" for="nickname">Name <span
                                                    class="required">*</span></label>
                                            <input class="spr-form-input spr-form-input-text" id="nickname"
                                                type="text" name="name" placeholder="John smith" required="">
                                        </div>
                                        <div class="spr-form-contact-email form-group">
                                            <label class="spr-form-label" for="email">Email <span
                                                    class="required">*</span></label>
                                            <input class="spr-form-input spr-form-input-email " id="email"
                                                type="email" name="email" placeholder="info@example.com"
                                                required="">
                                        </div>
                                        <div class="spr-form-review-rating form-group">
                                            <label class="spr-form-label">Rating</label>
                                            <div class="product-review pt-1">
                                                <div class="review-rating">
                                                    <input  type="radio" name="rating" id="rating-5"><label
                                                        for="rating-5"></label>
                                                    <input type="radio" name="rating" id="rating-4"><label
                                                        for="rating-4"></label>
                                                    <input type="radio" name="rating" id="rating-3"><label
                                                        for="rating-3"></label>
                                                    <input type="radio" name="rating" id="rating-2"><label
                                                        for="rating-2"></label>
                                                    <input type="radio" name="rating" id="rating-1"><label
                                                        for="rating-1"></label>
                                                </div>
                                                <a class="reviewLink d-none" href="#"><i
                                                        class="icon an an-star-o"></i><i
                                                        class="icon an an-star-o mx-1"></i><i
                                                        class="icon an an-star-o"></i><i
                                                        class="icon an an-star-o mx-1"></i><i
                                                        class="icon an an-star-o"></i></a>
                                            </div>
                                        </div>
                                        <div class="spr-form-review-title form-group">
                                            <label class="spr-form-label" for="review">Review Title </label>
                                            <input class="spr-form-input spr-form-input-text " id="review"
                                                type="text" name="review" placeholder="Give your review a title">
                                        </div>
                                        <div class="spr-form-review-body form-group">
                                            <label class="spr-form-label" for="message">Body of Review <span
                                                    class="spr-form-review-body-charactersremaining">(1500) characters
                                                    remaining</span></label>
                                            <div class="spr-form-input">
                                                <textarea class="spr-form-input spr-form-input-textarea " id="message" name="message" rows="5"
                                                    placeholder="Write your comments here"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="spr-form-actions clearfix">
                                        <input type="submit"
                                            class="btn btn-primary rounded spr-button spr-button-primary"
                                            value="Submit Review">
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="spr-reviews">
                                    <h4 class="spr-form-title text-uppercase mb-3">Customer Reviews</h4>
                                    <div class="review-inner">
                                        <div class="spr-review">
                                            <div class="spr-review-header">
                                                <span class="product-review spr-starratings"><span class="reviewLink"><i
                                                            class="icon an an-star"></i><i
                                                            class="icon an an-star mx-1"></i><i
                                                            class="icon an an-star"></i><i
                                                            class="icon an an-star mx-1"></i><i
                                                            class="icon an an-star-o"></i></span></span>
                                                <h5 class="spr-review-header-title mt-1">Lorem ipsum dolor sit amet</h5>
                                                <span class="spr-review-header-byline"><strong>Avone</strong> on
                                                    <strong>Apr 09, 2021</strong></span>
                                            </div>
                                            <div class="spr-review-content">
                                                <p class="spr-review-content-body">Lorem ipsum dolor sit amet, consectetur
                                                    adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                                    magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                                    laboris nisi ut aliquip ex ea commodo consequat.</p>
                                            </div>
                                        </div>
                                        <div class="spr-review">
                                            <div class="spr-review-header">
                                                <span class="product-review spr-starratings"><span class="reviewLink"><i
                                                            class="icon an an-star"></i><i
                                                            class="icon an an-star mx-1"></i><i
                                                            class="icon an an-star"></i><i
                                                            class="icon an an-star-o mx-1"></i><i
                                                            class="icon an an-star-o"></i></span></span>
                                                <h5 class="spr-review-header-title mt-1">Simply text of the printing</h5>
                                                <span class="spr-review-header-byline"><strong>Diva</strong> on <strong>May
                                                        30, 2021</strong></span>
                                            </div>

                                            <div class="spr-review-content">
                                                <p class="spr-review-content-body">Sed ut perspiciatis unde omnis iste
                                                    natus error sit voluptatem accusantium doloremque laudantium, totam rem
                                                    aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                                                    beatae vitae dicta sunt explicabo.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="spr-review">
                                            <div class="spr-review-header">
                                                <span class="product-review spr-starratings"><span class="reviewLink"><i
                                                            class="icon an an-star"></i><i
                                                            class="icon an an-star mx-1"></i><i
                                                            class="icon an an-star-o"></i><i
                                                            class="icon an an-star-o mx-1"></i><i
                                                            class="icon an an-star-o"></i></span></span>
                                                <h5 class="spr-review-header-title mt-1">Neque porro quisquam est qui
                                                    dolorem ipsum</h5>
                                                <span class="spr-review-header-byline"><strong>Belle</strong> on
                                                    <strong>Dec 30, 2021</strong></span>
                                            </div>

                                            <div class="spr-review-content">
                                                <p class="spr-review-content-body">Lorem Ipsum is simply dummy text of the
                                                    printing and typesetting industry. Lorem Ipsum has been the industry's
                                                    standard dummy text ever since the 1500s, when an unknown printer took a
                                                    galley of type and scrambled.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="tabs-ac-style d-md-none" rel="addtional-tabs">Addtional Tabs</h3>
                    <div id="addtional-tabs" class="tab-content" style="display: none;">
                        <p>You can set different tabs for each products.</p>
                        <ul>
                            <li>Comodous in tempor ullamcorper miaculis.</li>
                            <li>Pellentesque vitae neque mollis urna mattis laoreet.</li>
                            <li>Divamus sit amet purus justo.</li>
                            <li>Proin molestie egestas orci ac suscipit risus posuere loremous.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!--End Product Tabs-->


        </div>
        <!--End Container-->

        <!--You May Also Like Products-->
        <section class="section product-slider pb-0">
            <div class="container">
                <div class="row">
                    <div class="section-header col-12">
                        <h2 class="text-transform-none">You May Also Like</h2>
                    </div>
                </div>
                <div class="productSlider grid-products">
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-8.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-8.jpg"
                                    alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-8-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-8-1.jpg"
                                    alt="" title="">
                                <!-- End hover image -->
                                <!-- product label -->
                                <div class="product-labels"><span class="lbl on-sale">50% Off</span></div>
                                <!-- End product label -->
                            </a>
                            <!--End Product Image-->

                            <!--Product Button-->
                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name text-uppercase">
                                <a href="product-layout1.html">Martha Knit Top</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="old-price">$199.00</span>
                                <span class="price">$219.00</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center"><i
                                    class="an an-star"></i> <i class="an an-star"></i> <i class="an an-star"></i> <i
                                    class="an an-star"></i> <i class="an an-star-o"></i></div>
                            <!--End Product Review-->
                            <!--Color Variant -->
                            <ul class="image-swatches swatches">
                                <li class="radius blue medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Blue</span></li>
                                <li class="radius pink medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Pink</span></li>
                                <li class="radius red medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Red</span></li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!--End Product Details-->
                    </div>
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-9-2.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-9-2.jpg"
                                    alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-9-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-9-1.jpg"
                                    alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!--End Product Image-->

                            <!--Countdown Timer-->
                            <div class="saleTime desktop" data-countdown="2024/10/01"></div>
                            <!--End Countdown Timer-->

                            <!--Product Button-->
                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name text-uppercase">
                                <a href="product-layout1.html">Long Sleeve T-shirts</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="price">$199.00</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center"><i
                                    class="an an-star"></i> <i class="an an-star"></i> <i class="an an-star"></i><i
                                    class="an an-star"></i> <i class="an an-star"></i></div>
                            <!--End Product Review-->
                            <!-- Color Variant -->
                            <ul class="swatches">
                                <li class="swatch medium radius black"><span class="tooltip-label">Black</span></li>
                                <li class="swatch medium radius navy"><span class="tooltip-label">Navy</span></li>
                                <li class="swatch medium radius purple"><span class="tooltip-label">Purple</span></li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!--End Product Details-->
                    </div>
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-7.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-7.jpg"
                                    alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-7-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-7-1.jpg"
                                    alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!--End Product Image-->
                            <!--Product label-->
                            <div class="product-labels"><span class="lbl pr-label1">New</span></div>
                            <!--Product label-->

                            <!--Product Button-->
                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name text-uppercase">
                                <a href="product-layout1.html">Button Up Top Black</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="price">$99.00</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center"><i
                                    class="an an-star"></i> <i class="an an-star"></i> <i class="an an-star-o"></i> <i
                                    class="an an-star-o"></i> <i class="an an-star-o"></i></div>
                            <!--End Product Review-->
                            <!--Color Variant -->
                            <ul class="swatches">
                                <li class="swatch medium radius red"><span class="tooltip-label">red</span></li>
                                <li class="swatch medium radius orange"><span class="tooltip-label">orange</span></li>
                                <li class="swatch medium radius yellow"><span class="tooltip-label">yellow</span></li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!--End Product Details-->
                    </div>
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-6.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-6.jpg"
                                    alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-6-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-6-1.jpg"
                                    alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!--End Product Image-->

                            <!--Product Button-->
                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name text-uppercase">
                                <a href="product-layout1.html">Sunset Sleep Scarf Top</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="price">$88.00</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center"><i
                                    class="an an-star"></i> <i class="an an-star-o"></i> <i class="an an-star-o"></i> <i
                                    class="an an-star-o"></i> <i class="an an-star-o"></i></div>
                            <!--End Product Review-->
                            <!-- Color Variant -->
                            <ul class="image-swatches swatches">
                                <li class="radius yellow medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Yellow</span></li>
                                <li class="radius blue medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Blue</span></li>
                                <li class="radius pink medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Pink</span></li>
                                <li class="radius red medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Red</span></li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!--End Product Details-->
                    </div>
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-10.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-10.jpg"
                                    alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-10-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-10-1.jpg"
                                    alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!--End Product Image-->

                            <!--Product Button-->
                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name text-uppercase">
                                <a href="product-layout1.html">Backpack With Contrast Bow</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="price">$39.20</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center"><i
                                    class="an an-star"></i> <i class="an an-star"></i> <i class="an an-star"></i> <i
                                    class="an an-star"></i> <i class="an an-star-o"></i></div>
                            <!--End Product Review-->
                            <!-- Color Variant -->
                            <ul class="swatches">
                                <li class="swatch medium radius black"><span class="tooltip-label">black</span></li>
                                <li class="swatch medium radius navy"><span class="tooltip-label">navy</span></li>
                                <li class="swatch medium radius darkgreen"><span class="tooltip-label">darkgreen</span>
                                </li>
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!--End Product Details-->
                    </div>
                </div>
            </div>
        </section>
        <!--End You May Also Like Products-->

        <!--Recently Viewed Products-->
        <section class="section product-slider pb-0">
            <div class="container">
                <div class="row">
                    <div class="section-header col-12">
                        <h2 class="text-transform-none">Recently Viewed Products</h2>
                    </div>
                </div>
                <div class="productSlider grid-products">
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-11.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-11.jpg"
                                    alt="image" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-11-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-11-1.jpg"
                                    alt="image" title="">
                                <!-- End hover image -->
                            </a>
                            <!--End Product Image-->

                            <!--Product Button-->
                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name">
                                <a href="product-layout1.html">Puffer Jacket</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="price">$89.00</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center">
                                <i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i><i
                                    class="an an-star"></i><i class="an an-star-o"></i>
                                <span class="caption hidden ms-2">6 reviews</span>
                            </div>
                            <!--End Product Review-->
                            <!--Color Variant -->
                            <ul class="image-swatches swatches">
                                <li class="radius blue medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Blue</span></li>
                                <li class="radius pink medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Pink</span></li>
                                <li class="radius red medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Red</span></li>
                            </ul>
                            <!--End Color Variant-->
                        </div>
                        <!--End Product Details-->
                    </div>
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-12.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-12.jpg"
                                    alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-12-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-12-1.jpg"
                                    alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!--End Product Image-->

                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name">
                                <a href="product-layout1.html">Long Sleeve T-shirts</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="price">$199.00</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center">
                                <i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i><i
                                    class="an an-star"></i><i class="an an-star"></i>
                                <span class="caption hidden ms-2">20 reviews</span>
                            </div>
                            <!--End Product Review-->
                            <!--Color Variant-->
                            <ul class="swatches">
                                <li class="swatch medium radius black"><span class="tooltip-label">Black</span></li>
                                <li class="swatch medium radius purple"><span class="tooltip-label">Purple</span></li>
                            </ul>
                            <!--End Color Variant-->
                        </div>
                        <!--End Product Details-->
                    </div>
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-13.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-13.jpg"
                                    alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-13-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-13-1.jpg"
                                    alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!--End Product Image-->
                            <!--Product label-->
                            <div class="product-labels"><span class="lbl pr-label1">HOT</span></div>
                            <!--Product label-->

                            <!--Product Button-->
                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name">
                                <a href="product-layout1.html">Stand Collar Slim Shirt</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="price">$399.00</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center">
                                <i class="an an-star"></i><i class="an an-star"></i><i class="an an-star-o"></i><i
                                    class="an an-star-o"></i><i class="an an-star-o"></i>
                                <span class="caption hidden ms-2">19 reviews</span>
                            </div>
                            <!--End Product Review-->
                            <!--Color Variant-->
                            <ul class="image-swatches swatches">
                                <li class="radius yellow medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Yellow</span></li>
                                <li class="radius blue medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Blue</span></li>
                                <li class="radius pink medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Pink</span></li>
                                <li class="radius red medium"><span class="swacth-btn"></span><span
                                        class="tooltip-label">Red</span></li>
                            </ul>
                            <!--End Color Variant-->
                        </div>
                        <!--End Product Details-->
                    </div>
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-14.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-14.jpg"
                                    alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-14-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-14-1.jpg"
                                    alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!--End Product Image-->

                            <!--Product Button-->
                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name">
                                <a href="product-layout1.html">Martha Knit Top</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="old-price">$199.00</span>
                                <span class="price">$219.00</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center">
                                <i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i><i
                                    class="an an-star"></i><i class="an an-star-o"></i>
                                <span class="caption hidden ms-2">24 reviews</span>
                            </div>
                            <!--End Product Review-->
                            <!--Color Variant -->
                            <ul class="swatches">
                                <li class="swatch medium radius green"><span class="tooltip-label">Green</span></li>
                                <li class="swatch medium radius orange"><span class="tooltip-label">Orange</span></li>
                            </ul>
                            <!--End Color Variant-->
                        </div>
                        <!--End Product Details-->
                    </div>
                    <div class="item">
                        <!--Start Product Image-->
                        <div class="product-image">
                            <!--Start Product Image-->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-15.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-15.jpg"
                                    alt="" title="">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload"
                                    data-src="{{ asset('assets/frontend/assets') }}/images/products/product-15-1.jpg"
                                    src="{{ asset('assets/frontend/assets') }}/images/products/product-15-1.jpg"
                                    alt="" title="">
                                <!-- End hover image -->
                            </a>
                            <!--End Product Image-->
                            <!--Product Button-->
                            <div class="button-set style0 d-none d-md-block">
                                <ul>
                                    <!--Cart Button-->
                                    <li><a class="btn-icon btn cartIcon pro-addtocart-popup"
                                            href="#pro-addtocart-popup"><i class="icon an an-cart-l"></i> <span
                                                class="tooltip-label top">Add to Cart</span></a></li>
                                    <!--End Cart Button-->
                                    <!--Quick View Button-->
                                    <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)"
                                            data-toggle="modal" data-target="#content_quickview"><i
                                                class="icon an an-search-l"></i> <span class="tooltip-label top">Quick
                                                View</span></a></li>
                                    <!--End Quick View Button-->
                                    <!--Wishlist Button-->
                                    <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i
                                                class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To
                                                Wishlist</span></a></li>
                                    <!--End Wishlist Button-->
                                    <!--Compare Button-->
                                    <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i
                                                class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to
                                                Compare</span></a></li>
                                    <!--End Compare Button-->
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!--End Product Image-->
                        <!--Start Product Details-->
                        <div class="product-details text-center">
                            <!--Product Name-->
                            <div class="product-name">
                                <a href="product-layout1.html">Weave Hoodie Sweatshirt</a>
                            </div>
                            <!--End Product Name-->
                            <!--Product Price-->
                            <div class="product-price">
                                <span class="price">$199.00</span>
                            </div>
                            <!--End Product Price-->
                            <!--Product Review-->
                            <div class="product-review d-flex align-items-center justify-content-center">
                                <i class="an an-star"></i><i class="an an-star-o"></i><i class="an an-star-o"></i><i
                                    class="an an-star-o"></i><i class="an an-star-o"></i>
                                <span class="caption hidden ms-2">2 reviews</span>
                            </div>
                            <!--End Product Review-->
                            <!--Color Variant-->
                            <ul class="swatches">
                                <li class="swatch medium radius darkgreen"><span class="tooltip-label">darkgreen</span>
                                </li>
                            </ul>
                            <!--End Color Variant-->
                        </div>
                        <!--End Product Details-->
                    </div>
                </div>
            </div>
        </section>
        <!--End Recently Viewed Products-->

        <!--Customize Services-->
        <div class="section about-service product-service pb-0">
            <div class="container">
                <div class="section-header col-12">
                    <h2 class="text-transform-none">Why Optimal?</h2>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 text-center mb-4 mb-md-0">
                        <div class="service-info">
                            <i class="icon an an-desktop mb-3"></i>
                            <div class="text">
                                <h4>Design Quality</h4>
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for
                                    interested.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 text-center mb-4 mb-md-0">
                        <div class="service-info">
                            <i class="icon an an-mobile-alt mb-3"></i>
                            <div class="text">
                                <h4>Mobile First Design</h4>
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for
                                    interested.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 text-center mb-0 mb-md-0">
                        <div class="service-info">
                            <i class="icon an an-sort-amount-up mb-3"></i>
                            <div class="text">
                                <h4>High Speed & Performance</h4>
                                <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for
                                    interested.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Customize Services-->
    </div>
    <!--End Body Container-->
@endsection






@section('scripts')
    <script>
        $(document).ready(function(){
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
        // set color size
        $('.color').click(function() {
            var colro_name = $(this).attr('id');
            $('#color_name_set').text(colro_name);
        });

        $('.size').click(function() {
            var size_name = $(this).attr('id');
            $('#size_name_set').text(size_name);
        });

        //add to cart
        $('#add_to_cart').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: "{{ route('auth.check') }}",
                success: function(response) {
                    if (response.logdIn) {
                        add_to_cart();
                    }
                    if (response.not_log_in) {
                        $('#login_modal').modal('show');
                    }
                }
            });
        });

        //product add to cart function
        function add_to_cart(){
           var color_name = $('#color_name_set').text();
           var size_name = $('#size_name_set').text();
           var product_id = $('#product_id').val();
           var quentity = $('#quentity').val();

           $.ajax({
             type:'post',
             url:"{{route('frontend.cart.store')}}",
             data : {
                 'color_name': color_name,
                 'size_name':size_name,
                 'product_id':product_id,
                 'quentity':quentity,
             },
             success:function(resoponse){
                //  window.location.href = "{{route('frontend.cart.index')}}";
                location.reload();
             }
           });
           }

           //partial login
           $('#login_form').submit(function(e){
            e.preventDefault();
            let login_info = new FormData($('#login_form')[0]);

            $.ajax({
                type:'post',
                url:"{{route('partial.login')}}",
                data:login_info,
                  contentType: false,
                    processData: false,
                success:function(response){
                    if(response.success){
                        $('#login_modal').modal('hide');
                        window.location.href = "{{route('frontend.cart.index')}}";

                    }
                    if(response.not_match){
                  $('#not_matched').html('<h3 class="text-danger">'+response.not_match+'</h3>');
                    }
                    if(response.fails){
                          $.each(response.fails, function(key, value) {
                                    $('.' + key + '_error').text(value);
                                });
                    }
                }

            });
           });

        //product add to wishlist
        $('#wish_list').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'get',
                url: "{{ route('auth.check') }}",
                success: function(response) {
                    if (response.logdIn) {
                        add_to_wish_list();
                    }
                    if (response.not_log_in) {
                        $('#login_modal').modal('show');
                    }
                }
            });
        });
        //product add to cart function
        function add_to_wish_list(){
           var color_name = $('#color_name_set').text();
           var size_name = $('#size_name_set').text();
           var product_id = $('#product_id').val();

           $.ajax({
             type:'post',
             url:"{{route('frontend.wishlist.store')}}",
             data : {
                 'color_name': color_name,
                 'size_name':size_name,
                 'product_id':product_id,
             },
             success:function(resoponse){
                //  window.location.href = "{{route('frontend.wishlist.index')}}";
                location.reload();
             }
           });
           }


        });//document.ready
    </script>
@endsection

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>
