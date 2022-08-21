<nav class="sidebar dark_sidebar">
    <div class="logo d-flex justify-content-between">
        <a class="large_logo" href="index-2.html"><img src="{{ asset('assets/backend/assets') }}/img/logo_white.png"
                alt=""></a>
        <a class="small_logo" href="index-2.html"><img src="{{ asset('assets/backend/assets') }}/img/mini_logo.png"
                alt=""></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="">
            <a href="{{ route('home') }}" target="_blank" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/2.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Optimal</span>
                </div>
            </a>
        </li>
        <li class="">
            <a href="{{ route('admin.home') }}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/2.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Dashboard</span>
                </div>
            </a>
        </li>
        <li class="">
            <a href="{{ route('admin.product.index') }}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/2.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Product</span>
                </div>
            </a>
        </li>

        <li class="">
            <a href="{{ route('admin.all.order') }}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/2.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Order</span>
                </div>
            </a>
        </li>

        {{-- <li class="">
            <a href="{{ route('admin.monthly.sell.order.report') }}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/2.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Order Report</span>
                </div>
            </a>
        </li> --}}

        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/6.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Order Report</span>
                </div>
            </a>
            <ul>
                <li><a href="{{route('admin.monthly.sell.order.report')}}">Monthly</a></li>
                <li><a href="{{route('admin.yearly.sell.order.report')}}">Yearly</a></li>

            </ul>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/6.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Payment Stuts</span>
                </div>
            </a>
            <ul>
                <li><a href="{{ route('admin.payment.complete.order') }}">Complete</a></li>
                <li><a href="{{ route('admin.payment.cod.order') }}">Cash On Delivery</a></li>
                <li><a href="{{ route('admin.payment.cancled.order') }}">Cancled</a></li>
                <li><a href="{{ route('admin.brand.index') }}">Faield</a></li>
            </ul>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/6.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Order Status</span>
                </div>
            </a>
            <ul>
                <li><a href="{{ route('admin.order.status.pending') }}">Pending</a></li>
                <li><a href="{{ route('admin.order.status.packaging') }}">Packaging</a></li>
                <li><a href="{{ route('admin.order.status.shipped') }}">Shipped</a></li>
                <li><a href="{{ route('admin.order.status.delivered') }}">Delivery</a></li>
                <li><a href="{{ route('admin.size.index') }}">Cancle</a></li>
            </ul>
        </li>
         <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/6.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Inventory</span>
                </div>
            </a>
            <ul>
                <li><a href="{{ route('admin.inventory.management') }}">All Products</a></li>
                <li><a href="{{ route('admin.cash.sell') }}">Cash Sell</a></li>
                <li><a href="{{ route('admin.product.cod.sell') }}">Cod Sell</a></li>

            </ul>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/6.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Widgets</span>
                </div>
            </a>
            <ul>
                <li><a href="{{ route('admin.category.index') }}">Category</a></li>
                <li><a href="{{ route('admin.tag.index') }}">Tag</a></li>
                <li><a href="{{ route('admin.brand.index') }}">Brand</a></li>
                <li><a href="{{ route('admin.color.index') }}">Color</a></li>
                <li><a href="{{ route('admin.size.index') }}">Size</a></li>
                <li><a href="Payment_details.html">Color</a></li>
                <li><a href="Payment_details.html">Size</a></li>
            </ul>
        </li>
        <li class="">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="img/menu-icon/7.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Shipping</span>
                </div>
            </a>
            <ul class="mm-collapse" style="height: 5px;">
                <li><a href="{{route('admin.shipping.index')}}" class="active">Shipping Location</a></li>
                <li><a href="{{route('admin.divission.index')}}">Divission</a></li>
                <li><a href="{{route('admin.zilla.index')}}">Zila</a></li>
                <li><a href="{{route('admin.upozilla.index')}}">Upozila</a></li>
                <li><a href="{{route('admin.shipping.method.index')}}">Shipping Method</a></li>
            </ul>
        </li>
        <li class="">
            <a href="{{ route('admin.cupon.index') }}" aria-expanded="false">
                <div class="nav_icon_small">
                    <img src="{{ asset('assets/backend/assets') }}/img/menu-icon/2.svg" alt="">
                </div>
                <div class="nav_title">
                    <span>Cupon</span>
                </div>
            </a>
        </li>

    </ul>
</nav>
