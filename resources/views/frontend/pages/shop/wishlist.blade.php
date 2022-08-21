@extends('frontend.layouts.master')
@section('title')
wishlist
@endsection
@section('content')
            <!--Body Container-->
            <div id="page-content">
                <!--Collection Banner-->
                <div class="collection-header">
                    <div class="collection-hero">
                        <div class="collection-hero__image"></div>
                        <div class="collection-hero__title-wrapper container">
                            <h1 class="collection-hero__title">My Wishlist Style1</h1>
                            <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="{{route('home')}}" title="Back to the home page">Home</a><span>|</span><span class="fw-bold">My Wishlist Style1</span></div>
                        </div>
                    </div>
                </div>
                <!--End Collection Banner-->

                <!--Main Content-->
                <div class="container">
                    <!--Wishlist-->
                    <form action="#" method="post">
                        <div id="wishlist" class="wishlist-table table-content text-nowrap table-responsive py-2">
                            <table class="table table-bordered align-middle">
                                <thead class="bg-light thead-bg">
                                    <tr>
                                        <th class="product-name text-center alt-font">Remove</th>
                                        <th class="product-price text-center alt-font">Images</th>
                                        <th class="product-name alt-font">Product</th>
                                        <th class="product-price text-center alt-font">Unit Price</th>
                                        <th class="stock-status text-center alt-font">Stock Status</th>
                                        <th class="product-subtotal text-center alt-font">Add to Cart</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlists->where('user_id', Auth::id()) as $wishlist )

                                    <tr>
                                        <td class="product-remove text-center"><a id="{{$wishlist->id}}" class="wilshList_porduct_remove" title="Remove"><i class="icon icon an an-times-l"></i></a></td>
                                        <td class="product-thumbnail text-center">
                                            <a href="product-layout1.html"><img src="{{asset('storage/product_image/'.$wishlist->product->image)}}" width="100" alt="" title=""></a>
                                        </td>
                                        <td class="product-name"><h6 class="mb-0"><a href="product-layout1.html">{{$wishlist->product->name}}</a></h6><div class="cart__meta-text">
                                                    Color: {{$wishlist->color}}<br>Size: {{$wishlist->size}}<br>Brand: {{$wishlist->product->brands[0]->name}}
                                                </div></td>
                                        <td class="product-price text-center"><span class="amount fw-500">{{$wishlist->product->price}}</span></td>
                                        @if ($wishlist->product->quentity)
                                        <td class="stock text-center"><span class="text-in-stock">in stock</span></td>
                                          <td class="product-subtotal text-center"><a id="{{$wishlist->id}}" class="btn btn-small rounded-1 text-nowrap wishlist_to_cart">Add To Cart</a></td>
                                        @else
                                        <td class="stock text-center"><span class="text-out-stock">Out Of stock</span></td>
                                         <td class="product-subtotal text-center"><a class="btn btn-small rounded-1 text-nowrap soldOutBtn disabled">Out Of stock</a></td>
                                        @endif


                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </form>
                    <!--End Wishlist-->
                </div>
                <!--End Main Content-->
            </div>
            <!--End Body Container-->
@endsection

@section('scripts')
<script>
        $(document).ready(function(){


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
                        console.log(response);
                       if(response.success){
                            // window.location.href="{{route('frontend.cart.index')}}";
                            // $('#wishlist').load(location.href + ' #wishlist');
                            location.reload();
                       }
                    }
                });


             });
        });
</script>
@endsection
