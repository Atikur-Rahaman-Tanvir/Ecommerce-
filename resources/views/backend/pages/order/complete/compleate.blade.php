@extends('backend.layouts.master')
@section('title')
    All Payment Complete Order
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
                                        <h4>All Payment Complete Order <span class="badge  bg-primary"></span></h4>
                                        <div class="box_right d-flex lms_block">
                                            <div class="serach_field_2">
                                                <div class="search_inner">
                                                    <form Active="#">
                                                        <div class="search_field">
                                                            <input type="text" placeholder="Search content here..."
                                                                id="search_box">
                                                        </div>
                                                        <button type="submit"> <i class="ti-search"></i> </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="add_button ms-2">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#addcategory"
                                                    class="btn_1">search</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="white_card card_height_100">
                                            <div class="white_card_body" style="padding-left:0">
                                                <div class=" mb-0">
                                                    <input type="date" class="form-control" name="inputDate"
                                                        id="inputDate">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="QA_table " id="order_table">
                                           <div class="col-lg-12">
                                            <div class="white_card card_height_100 ">
                                                <div class="white_card_body">

                                                    <div class=" mb-0 bg-danger p-2" style="width:260px;display:inline-block;" >
                                                        Total Payment Complete Order : {{$orders->where('payment_status', "Complete")->count()}}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <table class="table lms_table_active ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Order Id</th>
                                                    <th scope="col">Order Date</th>
                                                    <th scope="col">Payment Status</th>
                                                    <th scope="col">Order Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <th scope="row"> <a href="#" class="question_content">
                                                                {{ $loop->index + 1 }} </a></th>
                                                        <td>#{{ $order->order_id }}</td>
                                                        <td>{{ $order->created_at->format('M d y') }}</td>
                                                        @if ($order->p_m_input == 2)
                                                            <td>{{ $order->payment_status }}</td>
                                                        @endif
                                                        <td>{{ $order->order_status }}</td>
                                                        <td>
                                                            <div class="action_btns d-flex">
                                                                <a href="{{ route('admin.order.details', $order->id) }}"
                                                                    class="action_btn mr_10"> <i class="far fa-eye"></i>
                                                                </a>

                                                                    <a id="{{ $order->id }}" class="action_btn delete"
                                                                    data-bs-toggle="modal" data-bs-target="#delete_modal">
                                                                    <i class="fas fa-trash"></i> </a>
                                                            </div>
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
    <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input type="hidden" name="id" id="delete_id">
                    <h3 class="text-center text-danger">Are You Sure?<br> You Want To Delete This?</h3>
                    <button class="btn btn-danger mt-5 " style="float: right;" id="delete_confirm">Confirm</button>
                    <button type="button" class="btn btn-primary mt-5" style="float: right; margin-right:5px"
                        id="cancle_delete">Cancle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#search_box').keyup(function() {
                var data = $(this).val();
                //  order search
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.payment.complete.order.search') }}",
                    data: {
                        'data': data
                    },
                    success: function(response) {
                        ;
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

            //order search by date
            $('#inputDate').change(function() {
                var date = $(this).val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.payment.complete.order.date.search') }}",
                    data: {
                        'date': date
                    },
                    success: function(response) {
                        console.log(response);
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

           // delete
            $(document).on('click', '.delete', function() {
                var id = $(this).attr('id');
                $('#delete_id').val(id);
            });
            $(document).on('click', '#delete_confirm', function() {
                var id = $('#delete_id').val();
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.order.delete') }}",
                    data: {
                        'id': id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#delete_modal').modal('hide');
                            $('#delete_modal').find('input').val('');
                            $('#order_table').load(location.href + ' #order_table');
                            toastr.success('Deleted Successfully!');
                        }
                    }
                });
            });
            //delete cancle button
            $(document).on('click', '#cancle_delete', function() {
                $('#delete_modal').modal('hide');
                $('#search_box').val('');
            });

        });
    </script>
@endsection
