@extends('frontend.layouts.master')
@section('title')
    tags products
@endsection
@section('content')
    <!--Body Container-->
    <div id="page-content">
        <!--Collection Banner-->
        <div class="collection-header">
            <div class="collection-hero">
                <div class="collection-hero__image"></div>
                <div class="collection-hero__title-wrapper container">
                    <h2 class="collection-hero__title">Shop Left Sidebar</h2>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index-2.html"
                            title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Shop Left Sidebar</span>
                    </div>
                </div>
            </div>
        </div>
        <!--End Collection Banner-->

        <div class="container">
            <div class="row">
                @include('frontend.pages.shop.sidebar')

                <!--Main Content-->
                <div class="col-12 col-sm-12 col-md-12 col-lg-9 main-col ">
                    <div class="page-title">
                        <h1>{{$tag->name}}</h1>
                    </div>
                    <!--Active Filters-->
                    <ul class="active-filters d-flex flex-wrap align-items-center m-0 list-unstyled d-none">
                        <li><a href="#">Clear all</a></li>
                        <li><a href="#">Men <i class="an an-times-l"></i></a></li>
                        <li><a href="#">Neckalses <i class="an an-times-l"></i></a></li>
                        <li><a href="#">Accessories <i class="an an-times-l"></i></a></li>
                    </ul>
                    <!--End Active Filters-->
                    <!--Toolbar-->
                    <div class="toolbar">
                        <div class="filters-toolbar-wrapper">
                            <ul class="list-unstyled d-flex align-items-center">
                                <li class="product-count d-flex align-items-center">
                                    <button type="button"
                                        class="btn btn-filter an an-slider-3 d-inline-flex d-lg-none me-2 me-sm-3"><span
                                            class="hidden">Filter</span></button>
                                    <div class="filters-toolbar__item">
                                        <span class="filters-toolbar__product-count d-none d-sm-block">Showing: 21
                                            products</span>
                                    </div>
                                </li>
                                <li class="collection-view ms-sm-auto">
                                    <div class="filters-toolbar__item collection-view-as d-flex align-items-center me-3">
                                        <a href="javascript:void(0)" class="change-view prd-grid change-view--active"><i
                                                class="icon an an-th" aria-hidden="true"></i><span
                                                class="tooltip-label">Grid View</span></a>
                                        <a href="javascript:void(0)" class="change-view prd-list"><i
                                                class="icon an an-th-list" aria-hidden="true"></i><span
                                                class="tooltip-label">List View</span></a>
                                    </div>
                                </li>
                                {{-- <li class="filters-sort ms-auto ms-sm-0">
                                            <div class="filters-toolbar__item">
                                                <label for="SortBy" class="hidden">Sort by:</label>
                                                <select name="SortBy" id="SortBy" class="filters-toolbar__input filters-toolbar__input--sort">
                                                    <option value="featured" selected="selected">Featured</option>
                                                    <option value="best-selling">Best selling</option>
                                                    <option value="title-ascending">Alphabetically, A-Z</option>
                                                    <option value="title-descending">Alphabetically, Z-A</option>
                                                    <option value="price-ascending">Price, low to high</option>
                                                    <option value="price-descending">Price, high to low</option>
                                                    <option value="created-ascending">Date, old to new</option>
                                                    <option value="created-descending">Date, new to old</option>
                                                </select>
                                            </div>
                                        </li> --}}
                            </ul>
                        </div>
                    </div>
                    <!--End Toolbar-->

                    <!--Product Grid-->

                                  @include('frontend.pages.shop.product_grid')

                    <!--End Product Grid-->

                    {{-- <!--Pagination Classic-->
                            <hr class="clear">
                            <div class="pagination">

                                <ul>
                                    <li class="prev"><a href="#"><i class="icon align-middle an an-caret-left" aria-hidden="true"></i></a></li>
                                    @for ($i = 1; $i <= $paginate_product; $i++)

                                    <li class="active"><a>{{$i}}</a></li>
                                    @endfor
                                    <li class="next"><a href="#"><i class="icon align-middle an an-caret-right" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <!--End Pagination Classic--> --}}

                    <!--Collection Description-->
                    {{-- <div class="collection-description mt-4 pt-2">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard reader dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen the book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </div> --}}
                    <!--End Collection Description-->



                </div>
                <!--End Main Content-->
            </div>
        </div>
    </div>
    <!--End Body Container-->
@endsection

@section('scripts')
    <script>
    @endsection
