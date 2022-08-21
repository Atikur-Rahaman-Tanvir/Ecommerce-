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
                                        @if (!$product_report->count()==0)
                                        @php
                                            $product = App\Models\Product_report::where('product_id', $product_report[0]->product_id)->first();
                                        @endphp
                                        <h4 class="">{{$product->product->name}}</h4>
                                        @else
                                        <h4 class="text-danger">This product not sell yeat.</h4>
                                        @endif

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
                                            <div class="add_button ms-2">
                                                <button type="button" class="btn_1" data-bs-toggle="modal"
                                                    data-bs-target="#insert_modal">
                                                    Add New
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="QA_table mb_30">
                                        <a href="{{route('admin.inventory.management')}}" class="btn btn-primary">Back</a>
                                        <table class="table lms_table_active3 text-center" id="data_table">
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

                                                    <th scope="col">Date</th>
                                                    <th scope="col">Payment Method</th>
                                                    <th scope="col">Buy Price</th>
                                                    <th scope="col">sell Price</th>
                                                    <th scope="col">Sell Qty</th>
                                                    <th scope="col">Total Price</th>

                                                </tr>
                                            </thead>

                                            <tbody id="table_body">
                                                @if (!$product_report->count()==0)
                                                @foreach ($product_report as $product)

                                                <tr>
                                                    <td>{{$loop->index+1}}</td>

                                                    <td>{{$product->created_at->format('Y M d')}}</td>
                                                    <td>{{($product->payment_method == 2)? 'Online': 'COD'}}</td>
                                                    <td>${{$product->product->buy_price}}</td>
                                                    <td>${{$product->price}}</td>
                                                    <td>{{$product->quentity}}</td>
                                                    <td>${{$product->total_price}}</td>
                                                </tr>
                                                @endforeach
                                                @endif
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

{{-- @section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            // insert
            $('#insert_form').submit(function(e){
                e.preventDefault();

                let insert_data = new FormData($('#insert_form')[0]);
                $.ajax({
                    type:"post",
                    url:"{{route('admin.tag.store')}}",
                    data:insert_data,
                    contentType: false,
                    processData: false,
                    success:function(response){
                      if (response.success) {
                            $('#insert_modal').modal('hide');
                            $('#insert_modal').find('input').val('');
                            $('#success_msg').removeClass('d-none');
                            $('#success_msg_text').text(response.success);
                            $('#data_table').load(location.href + ' #data_table');
                        } else {
                            console.log(response.fails.name);
                            if (response.fails.name) {
                                $('.name_error').text(response.fails.name);
                            }
                            if (response.fails.image) {
                                $('.image_error').text(response.fails.image);
                            }
                        }
                    }

                });
            });


            //show data in edit form
            $(document).on('click', '.edit', function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.tag.show') }}",
                    data: {
                        'id': id
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#edit_id').val(response.tag.id);
                        $('#edit_name').val(response.tag.name);
                    }
                });
            });

            // edit data
            $('#edit_form').submit(function(e) {
                e.preventDefault();

                let formdata = new FormData($('#edit_form')[0]);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.tag.edit') }}",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            $('#edit_modal').modal('hide');
                            $('#edit_modal').find('input').val('');
                            $('#success_msg').removeClass('d-none');
                            $('#success_msg_text').text(response.success);
                            $('#data_table').load(location.href + ' #data_table');
                            $('#search_box').val('');
                        } else {
                            console.log(response.fails.name);
                            if (response.fails.name) {
                                $('.name_error').text(response.fails.name);
                            }
                        }
                    }

                });

            });

            // delete
            $(document).on('click', '.delete', function() {
                var id = $(this).attr('id');
                $('#delete_id').val(id);
            });
            $(document).on('click', '#delete_confirm', function() {
                var id = $('#delete_id').val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.tag.delete') }}",
                    data: {
                        'id': id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#delete_modal').modal('hide');
                            $('#delete_modal').find('input').val('');
                            $('#success_msg').removeClass('d-none');
                            $('#success_msg_text').text(response.success);
                            $('#data_table').load(location.href + ' #data_table');
                        }
                    }
                });
            });

            //delete cancle button
            $(document).on('click', '#cancle_delete', function() {
                $('#delete_modal').modal('hide');
                $('#search_box').val('');
            });

            //status control
            $(document).on('click', '.status', function() {
                var id = $(this).attr('id');
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.tag.status') }}",
                    data: {
                        'id': id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#success_msg').removeClass('d-none');
                        $('#success_msg_text').text(response.success);
                        $('#data_table').load(location.href + ' #data_table');
                        $('#search_box').val('');

                    }

                });
            });

            //success message control;
            $(document).on('click', '#alert_close', function() {
                $('#success_msg').addClass('d-none');
            });

             //search
            $('#search_box').on('keyup', function() {
                var value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.tag.search') }}",
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
@endsection --}}
