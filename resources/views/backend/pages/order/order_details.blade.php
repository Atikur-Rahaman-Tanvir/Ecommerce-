@extends('backend.layouts.master')
@section('title')
    All Orders
@endsection
@section('content')
    <section class="main_content dashboard_part large_header_bg">
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">

                    <div class="col-lg-4">
                        <div class="white_card card_height_100 ">
                            <div class="white_card_header">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Change Order Status</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <span class="text-danger name_error"></span>
                                <div class=" pb-5">
                                    <select class="form-select" name="order_status" id="order_status">
                                        <option {{($order->order_status =='Pending') ? 'selected' : ' '}} value="Pending">Pending</option>
                                        <option {{($order->order_status =='Packaging') ? 'selected' : ' '}} value="Packaging">Packaging</option>
                                        <option {{($order->order_status =='Shipped') ? 'selected' : ' '}} value="Shipped">Shipped</option>
                                        <option {{($order->order_status =='Delivered') ? 'selected' : ' '}} value="Delivered">Delivered</option>
                                    </select>
                                </div>
                                <input type="hidden" value="{{$order->id}}" id="order_summery_id">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30 pt-4">
                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4>Order Items</h4>
                                        <div class="box_right d-flex lms_block">
                                            <a class="btn btn-primary" href='{{route('admin.all.order')}}'>BACK</a>
                                        </div>
                                    </div>
                                    <div class="QA_table mb_30" id="order_table">

                                        <table class="table lms_table_active text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Price</th>
                                                    <th scope="col">Quentity</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->order_details as $order_item)
                                                    <tr>
                                                        <th scope="row"> <a href="#" class="question_content">
                                                                {{ $loop->index + 1 }} </a></th>
                                                        <td><img width="50"
                                                                src="{{ asset('storage/product_image/' . $order_item->product->image) }}"
                                                                alt=""></td>
                                                        <td>{{ $order_item->product->name }}</td>
                                                        <td>${{ $order_item->price }}</td>

                                                        <td>{{ $order_item->quentity }}</td>

                                                        <td>${{ $order_item->total }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="5" style="text-align:right">Shipping</td>
                                                    <td>${{ $order->sipping_price }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="text-align:right">Total</td>
                                                    <td>${{ $order->order_total }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('#order_status').change(function(){
                var data = $(this).val();
                var id = $('#order_summery_id').val();

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

                $.ajax({
                    type:'get',
                    url:"{{route('admin.admin.order.status.update')}}",
                    data:{'data':data, 'id':id},
                    success:function(response){
                        console.log(response);
                       if(response.success){
                       toastr.success(response.success);
                       }
                    }
                })
            });
        });
    </script>
@endsection
