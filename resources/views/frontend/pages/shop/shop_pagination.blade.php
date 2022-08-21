

                                   @foreach ($products as $product )
                                   <div class="col-6 col-sm-6 col-md-4 col-lg-4 item">
                                       <!--Start Product Image-->
                                       <div class="product-image">
                                           <!--Start Product Image-->
                                           <a href="{{route('product.details', $product->id)}}" class="product-img">
                                               <!-- image -->
                                               <img class="primary blur-up lazyload" data-src="{{asset('storage/product_image/'.$product->image)}}" src="assets/images/products/product-2.jpg" alt="image" title="">
                                               <!-- End image -->
                                               <!-- Hover image -->
                                               <img class="hover blur-up lazyload" data-src="{{asset('storage/product_image/'.$product->image)}}" src="assets/images/products/product-2-1.jpg" alt="image" title="">
                                               <!-- End hover image -->
                                               <!-- product label -->
                                               <div class="product-labels"><span class="lbl on-sale rounded">Sale</span></div>
                                               <!-- End product label -->
                                           </a>
                                           <!--End Product Image-->

                                           {{-- <!--Product Button-->
                                           <div class="button-set style0 d-none d-md-block">
                                               <ul>
                                                   <!--Cart Button-->
                                                   <li><a class="btn-icon btn cartIcon pro-quickshop-popup" href="#pro-quickshop1" data-bs-toggle="offcanvas" data-bs-target="#pro-quickshop1" aria-controls="pro-quickshop1"><i class="icon an an-cart-l"></i> <span class="tooltip-label top">Quick Shop</span></a></li>
                                                   <!--End Cart Button-->
                                                   <!--Quick View Button-->
                                                   <li><a class="btn-icon quick-view-popup quick-view" href="javascript:void(0)" data-toggle="modal" data-target="#content_quickview"><i class="icon an an-search-l"></i> <span class="tooltip-label top">Quick View</span></a></li>
                                                   <!--End Quick View Button-->
                                                   <!--Wishlist Button-->
                                                   <li><a class="btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To Wishlist</span></a></li>
                                                   <!--End Wishlist Button-->
                                                   <!--Compare Button-->
                                                   <li><a class="btn-icon compare add-to-compare" href="compare-style2.html"><i class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to Compare</span></a></li>
                                                   <!--End Compare Button-->
                                               </ul>
                                           </div>
                                           <!--End Product Button--> --}}

                                           <!-- Product Quickshop Form -->
                                           {{-- <div class="quickshop-content d-flex-center" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="pro-quickshop1">
                                               <button type="button" class="btn-close text-reset ms-auto position-absolute top-0 end-0 m-1" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                               <div class="offcanvas-body quickshop-variant h-100 d-flex align-items-start align-items-sm-center">
                                                   <form method="post" action="#" id="product_form_1052" class="product-form align-items-center text-center hidedropdown" accept-charset="UTF-8" enctype="multipart/form-data">
                                                       <!-- Product Price -->
                                                       <div class="product-single__price lh-1 mb-3 mt-0 mx-auto">
                                                           <span class="visually-hidden">Regular price</span>
                                                           <span class="product-price__sale--single">
                                                               <span class="product-price-old-price d-none">$200.00</span><span class="product-price__price product-price__sale0">${{$product->price}}</span>
                                                           </span>
                                                       </div>
                                                       <!-- End Product Price -->
                                                       <!-- Swatches Color -->
                                                       <div class="swatches-image swatch clearfix mb-3 swatch-0 option1" data-option-index="0">
                                                           <div class="product-form__item">
                                                               <label class="label d-flex justify-content-center">Color:<span class="required d-none">*</span><span class="slVariant ms-1 fw-bold">Black</span></label>
                                                               <ul class="swatches d-flex-justify-center list-unstyled m-0 clearfix">
                                                                   <li class="swatch-element rounded-0 color gray available active">
                                                                       <label class="swatchLbl rounded-0 color small gray" title="Gray"></label>
                                                                       <span class="tooltip-label top">Gray</span>
                                                                   </li>
                                                                   <li data-value="Peach" class="swatch-element rounded-0 color orange available">
                                                                       <label class="swatchLbl rounded-0 color small orange" title="Orange"></label>
                                                                       <span class="tooltip-label top">Orange</span>
                                                                   </li>
                                                                   <li data-value="White" class="swatch-element rounded-0 color brown available">
                                                                       <label class="swatchLbl rounded-0 color small brown" title="Brown"></label>
                                                                       <span class="tooltip-label top">Brown</span>
                                                                   </li>
                                                               </ul>
                                                           </div>
                                                       </div>
                                                       <!-- End Swatches Color -->
                                                       <!-- Swatches Size -->
                                                       <div class="swatch clearfix mb-3 swatch-1 option2" data-option-index="1">
                                                           <div class="product-form__item">
                                                               <label class="label d-flex justify-content-center">Size:<span class="required d-none">*</span><span class="slVariant ms-1 fw-bold">S</span></label>
                                                               <ul class="swatches-size d-flex-justify-center list-unstyled m-0 clearfix">
                                                                   <li data-value="S" class="swatch-element s available active">
                                                                       <label class="swatchLbl rounded-0 medium" title="S">S</label><span class="tooltip-label">S</span>
                                                                   </li>
                                                                   <li data-value="M" class="swatch-element m available">
                                                                       <label class="swatchLbl rounded-0 medium" title="M">M</label><span class="tooltip-label">M</span>
                                                                   </li>
                                                                   <li data-value="L" class="swatch-element l available">
                                                                       <label class="swatchLbl rounded-0 medium" title="L">L</label><span class="tooltip-label">L</span>
                                                                   </li>
                                                                   <li data-value="XL" class="swatch-element xl available">
                                                                       <label class="swatchLbl rounded-0 medium" title="XL">XL</label><span class="tooltip-label">XL</span>
                                                                   </li>
                                                                   <li data-value="XS" class="swatch-element xs soldout">
                                                                       <label class="swatchLbl rounded-0 medium" title="XS">XS</label><span class="tooltip-label">XS</span>
                                                                   </li>
                                                               </ul>
                                                           </div>
                                                       </div>
                                                       <!-- End Swatches Size -->
                                                       <!-- Product Action -->
                                                       <div class="product-form-submit mx-auto">
                                                           <button  type="submit" name="add" class="btn rounded product-form__cart-submit btn-small px-3"><span>Add to cart</span></button>
                                                           <button type="submit" name="add" class="btn rounded product-form__sold-out btn-small px-3 d-none" disabled="disabled">Sold out</button>
                                                           <button type="button" name="buy" class="btn rounded btn-outline-primary proceed-to-checkout btn-small px-3 d-none">Buy it now</button>
                                                       </div>
                                                       <!-- End Product Action -->
                                                   </form>
                                               </div>
                                           </div> --}}
                                           <!-- End Product Quickshop Form -->
                                       </div>
                                       <!--End Product Image-->
                                       <!--Start Product Details-->
                                       <div class="product-details text-center">
                                           <!--Product Name-->
                                           <div class="product-name text-uppercase">
                                               <a href="{{route('product.details', $product->id)}}">{{$product->name}}</a>
                                           </div>
                                           <!--End Product Name-->
                                           <!--Product Price-->
                                           <div class="product-price">
                                            @if ($product->discount)

                                            <span class="price" style=" text-decoration: line-through;" >${{$product->price}}</span>
                                            <span class="price text-danger" style="font-weight:bold;">${{round($product->price - ($product->price * $product->discount / 100))}}</span>
                                            @else
                                            <span class="price">${{$product->price}}</span>
                                            @endif
                                            </div>
                                           <!--End Product Price-->
                                           <!--Product Review-->
                                           <div class="product-review d-flex align-items-center justify-content-center">
                                               <i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i><i class="an an-star"></i>
                                               <span class="caption hidden ms-2">8 reviews</span>
                                           </div>
                                           <!--End Product Review-->
                                           <!--Sort Description-->
                                           <p class="hidden sort-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s specimen book...</p>
                                           <!--End Sort Description-->
                                           <!--Color Variant-->
                                           <ul class="swatches">
                                            @foreach ($product->colors as $color )

                                            <li class="swatch medium radius " style="background-color:{{$color->color_code}}"><span class="tooltip-label">{{$color->name}}</span></li>
                                            @endforeach

                                           </ul>
                                           <!--End Color Variant-->
                                           <!-- Product Button -->
                                           {{-- <div class="button-action d-flex">
                                               <div class="addtocart-btn">
                                                   <form class="addtocart" action="#" method="post">
                                                       <a class="btn pro-addtocart-popup" href="#pro-addtocart-popup"><i class="icon hidden an an-cart-l"></i>Select Options</a>
                                                   </form>
                                               </div>
                                               <div class="quickview-btn">
                                                   <a class="btn btn-icon quick-view quick-view-popup" href="javascript:void(0)" data-toggle="modal" data-target="#content_quickview"><i class="icon an an-search-l"></i> <span class="tooltip-label top">Quick View</span></a>
                                               </div>
                                               <div class="wishlist-btn">
                                                   <a class="btn btn-icon wishlist add-to-wishlist" href="my-wishlist.html"><i class="icon an an-heart-l"></i> <span class="tooltip-label top">Add To Wishlist</span></a>
                                               </div>
                                               <div class="compare-btn">
                                                   <a class="btn btn-icon compare add-to-compare" href="compare.html"><i class="icon an an-sync-ar"></i> <span class="tooltip-label top">Add to Compare</span></a>
                                               </div>
                                           </div> --}}
                                           <!-- End Product Button -->
                                       </div>
                                       <!--End Product Details-->
                                   </div>
                                   @endforeach
                                    {{$products->links('pagination::bootstrap-5')}}




