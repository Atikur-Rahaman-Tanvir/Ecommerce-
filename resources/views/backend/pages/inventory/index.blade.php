@extends('backend.layouts.master')
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
                                        <h4>All Products</h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">
                                                <div class="search_inner">

                                                    <div class="search_field">
                                                        <input type="text" placeholder="Search content here..."
                                                            id="search_box" name="search">

                                                    </div>
                                                    <button type="submit"> <i class="ti-search"></i> </button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="QA_table mb_30" id="data_table">

                                        <table class="table lms_table_active3 " >
                                            <thead>
                                                <div id='success_msg'
                                                    class="d-none alert text-white bg-success d-flex align-items-center justify-content-between"
                                                    role="alert">
                                                    <div class="alert-text" id="success_msg_text"></div>
                                                    <button type="button" class="btn-close" aria-label="Close"
                                                        id="alert_close"> </button>
                                                </div>
                                                <tr>
                                                    <th scope="col">Sl No</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Bye Price</th>
                                                    <th scope="col">sell Price</th>
                                                    <th scope="col">Remain Qty</th>
                                                    <th scope="col">Sell Qty</th>
                                                    <th scope="col">Product Report</th>

                                                </tr>
                                            </thead>

                                            <tbody id="table_body">
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->buy_price }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        @if ($product->quentity <=10)
                                                        <td class="badge bg-danger text-white">{{ $product->quentity }}</td>
                                                        @else
                                                        <td>{{ $product->quentity }}</td>
                                                        @endif
                                                        <td>{{ $product->sell_quentity }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.product.report',$product->id) }}" class="action_btn mr_10 edit"> <i
                                                                        class="far fa-edit"></i> </a>
                                                        </td>

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


             //search
            $('#search_box').on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.all.product.search') }}",
                    data: {
                        'search': value
                    },
                    success: function(response) {
                        $('#data_table').html(response);
                        if (response.not_found) {
                            $('#data_table').html("<span class='text-danger'>" + response
                                .not_found + "</span>");

                        }
                        if(response.null){
                                 location.reload();
                        }
                    }
                })
            });


        });
    </script>
@endsection
