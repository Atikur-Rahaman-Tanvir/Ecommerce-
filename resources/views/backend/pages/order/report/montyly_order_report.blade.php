@extends('backend.layouts.master')
@section('title')
    All Orders
@endsection
@section('content')
    <section class="main_content dashboard_part large_header_bg">
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30 pt-4">
                            <div class="white_card_body">
                                <div class="QA_section">
                                    <div class="white_box_tittle list_header">
                                        <h4>Monthly Order Report</h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">
                                                <div class="search_inner">
                                                    <div class=" mb-0">
                                                        <input type="date" class="form-control" name="inputDate"
                                                            id="inputDate">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="" style="font-weight:400" id="order_table">
                                        <div class="white_box_tittle list_header">
                                            {{-- <h4 class="bg-danger p-2" style="width: 130px"> {{ $this_month }}</h4> --}}
                                            <div class="box_right d-flex lms_block">
                                            </div>
                                        </div>
                                        <table class="table text-center">
                                            <thead class="">
                                                <tr>
                                                    <th scope="col">ORDER DATE</th>
                                                    <th scope="col">ONLINE ORDER</th>
                                                    <th scope="col">ONLINE ORDER SEll</th>
                                                    <th scope="col">COD ORDER</th>
                                                    <th scope="col">COD ORDER SELL</th>
                                                    <th scope="col">TOTAL ORDER</th>
                                                    <th scope="col">SUB TOTAL</th>
                                                    <th scope="col">TOTAL SHIPPING</th>
                                                    <th scope="col">GRAND TOTAL</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($daily_order as $order)
                                                    <tr>
                                                        <td>{{ $order->created_at->format('d M y') }}</td>
                                                        <td>{{ $order->online_payment }}</td>
                                                        <td>${{ $order->online_total }}</td>
                                                        <td>{{ $order->cod_payment }}</td>
                                                        <td>${{ $order->cod_total }}</td>
                                                        <td>{{ $order->order_total}}</td>
                                                        <td>${{ $order->cart_total }}</td>
                                                        <td>${{ $order->shipping_total }}</td>
                                                        <td>${{ $order->grand_total }}</td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                                  <tfoot class="">
                                                <tr>
                                                    <td >Total</td>
                                                    <td scope="col"><mark>{{$total->online_payment}}</mark></td>
                                                    <td scope="col"><mark>${{$total->online_total}}</mark></td>
                                                    <td scope="col"><mark>{{$total->cod_payment}}</mark></td>
                                                    <td scope="col"><mark>${{$total->cod_total}}</mark></td>
                                                    <td scope="col"><mark>{{$total->order_total}}</mark></td>
                                                    <td scope="col"><mark>${{$total->cart_total}}</mark></td>
                                                    <td scope="col"><mark>${{$total->shipping_total}}</mark></td>
                                                    <td scope="col"><mark>${{$total->grand_total}}</mark></td>

                                                </tr>
                                            </tfoot>
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
            //order search by date
            $('#inputDate').change(function() {
                var date = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.monthly.sell.order.date.search') }}",
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
