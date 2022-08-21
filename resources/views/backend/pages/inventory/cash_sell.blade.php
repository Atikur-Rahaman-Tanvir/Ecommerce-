@extends('backend.layouts.master')
@section('title')
    cash sell on per day
@endsection
@section('content')
    <section class="main_content dashboard_part large_header_bg">
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">

                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">

                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4>Cash Sell In A Day</h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">
                                                <div class="search_inner">


                                                    <div class="white_card_body">
                                                        <h6 class="card-subtitle mb-2">Search Using Date</h6>
                                                        <div class=" mb-0">
                                                            <input type="date" class="form-control" name="inputDate"
                                                                id="inputDate">
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="QA_table mb_30" id="order_table">
                                        <div class="col-lg-12">
                                            <div class="white_card card_height_100 mb_30">
                                                <div class="white_card_body">

                                                    <div class=" mb-0 bg-danger p-2" style="width:130px;display:inline-block" >
                                                        Total Sell : ${{$product_reports->sum('total_price')}}
                                                    </div>
                                                    <div class=" mb-0 bg-success p-2" style="width:130px;display:inline-block" >
                                                        Total Buy : ${{$product_reports->sum('buy_total_price')}}
                                                    </div>
                                                    <div class=" mb-0 bg-primary p-2" style="width:130px;display:inline-block" >
                                                        Profit : ${{$product_reports->sum('total_price')-$product_reports->sum('buy_total_price')}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <table class="table lms_table_active3 ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Sl No</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Product Name</th>

                                                    <th scope="col">Buy Price</th>
                                                    <th scope="col">sell Price</th>
                                                    <th scope="col">Sell Qty</th>
                                                    <th scope="col">Sell Price Total</th>
                                                    <th scope="col">Buy Price Total</th>


                                                </tr>
                                            </thead>

                                            <tbody id="table_body">
                                                @foreach ($product_reports as $product)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $product->created_at->format('Y M d') }}</td>
                                                        <td><mark>{{ $product->product->name }}</mark></td>

                                                        <td>${{ $product->product->buy_price }}</td>



                                                        <td>${{ $product->price }}</td>


                                                        <td>{{ $product->quentity }}</td>
                                                        <td>${{ $product->total_price }}</td>
                                                        <td>${{ $product->buy_total_price }}</td>
                                                    </tr>
                                                @endforeach
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //order search by date
            $('#inputDate').change(function() {
                var date = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.producet.sell.date.search') }}",
                    data: {
                        'date': date
                    },
                    success: function(response) {

                        $('#order_table').html(response);
                        if (response.not_found) {
                            $('#order_table').html('<p class="text-danger">' + response
                                .not_found + '</p>');
                        }
                        if (response.null) {
                            location.reload();
                        }
                    }
                });

            });

        });
    </script>
@endsection
