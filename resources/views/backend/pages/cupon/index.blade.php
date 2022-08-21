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
                                        <h4>All Cupons</h4>
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

                                        <table class="table lms_table_active3 " id="data_table">
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
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Discount</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>

                                                </tr>
                                            </thead>

                                            <tbody id="table_body">
                                                @foreach ($cupons as $cupon)
                                                    <tr>
                                                        <td>{{ $loop->index + 1 }}</td>
                                                        <td>{{ $cupon->name }}</td>
                                                        <td>{{ $cupon->discount }}</td>
                                                        <td>
                                                            @if ($cupon->status == 0)
                                                                <span class="badge badge-danger">Pending</span>
                                                            @else
                                                                <span class="badge badge-success">Active</span>
                                                            @endif
                                                        </td>

                                                        <td>
                                                            <div class="action_btns d-flex">


                                                                <a id="{{ $cupon->id }}"
                                                                    class="action_btn mr_10 status "> <i
                                                                        class="{{ $cupon->status == 0 ? 'far fa-eye-slash' : 'fa fa-eye' }}"></i>
                                                                </a>

                                                                <a id="{{ $cupon->id }}" class="action_btn mr_10 edit "
                                                                    data-bs-toggle="modal" data-bs-target="#edit_modal"> <i
                                                                        class="far fa-edit"></i> </a>


                                                                <a id="{{ $cupon->id }}" class="action_btn delete"
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

    <div class="modal fade" id="insert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add New Cupon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="insert_form">
                        @csrf
                        <div class="col-lg-12">
                            <div class="white_card card_height_100 ">
                                <div class="white_card_header">
                                    <div class="box_header m-0">
                                        <div class="main-title">
                                            <h3 class="m-0">Cupon Name</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="white_card_body">
                                    <span class="text-danger name_error"></span>
                                    <div class=" mb-0">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="cupon Name">
                                    </div>
                                    <p><cite>cupon name must be unique.</cite></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="white_card card_height_100 ">
                                <div class="white_card_header">
                                    <div class="box_header m-0">
                                        <div class="main-title">
                                            <h3 class="m-0">Cupon Discount</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="white_card_body">
                                    <span class="text-danger discount_error"></span>
                                    <div class=" mb-0">
                                        <input type="number" class="form-control" name="discount" id="discount"
                                            placeholder="coupone discount">
                                    </div>
                                    <p><cite>set how many discount to this coupon.</cite></p>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-5">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Cupon Edit And Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <div class="col-lg-12">
                            <div class="white_card card_height_100 ">
                                <div class="white_card_header">
                                    <div class="box_header m-0">
                                        <div class="main-title">
                                            <h3 class="m-0">Cupon Name</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="white_card_body">
                                    <span class="text-danger name_error"></span>
                                    <div class=" mb-0">
                                        <input type="text" class="form-control" name="name" id="edit_name"
                                            placeholder="cupon name">
                                    </div>
                                    <p><cite>cupon name must be unique.</cite></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="white_card card_height_100 ">
                                <div class="white_card_header">
                                    <div class="box_header m-0">
                                        <div class="main-title">
                                            <h3 class="m-0">Cupon Discount</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="white_card_body">
                                    <span class="text-danger discount_error"></span>
                                    <div class=" mb-0">
                                        <input type="number" class="form-control" name="discount" id="edit_discount"
                                            placeholder="coupone discount">
                                    </div>
                                    <p><cite>set how many discount to this coupon.</cite></p>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary mt-5">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                    url:"{{route('admin.cupon.store')}}",
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

                            if (response.fails) {
                                $.each(response.fails, function(key, value){
                                    $('.'+key+'_error').text(value);
                                });
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
                    url: "{{ route('admin.cupon.show') }}",
                    data: {
                        'id': id
                    },
                    dataType: "json",
                    success: function(response) {
                        $('#edit_id').val(response.cupon.id);
                        $('#edit_name').val(response.cupon.name);
                        $('#edit_discount').val(response.cupon.discount);
                    }
                });
            });

            // edit data
            $('#edit_form').submit(function(e) {
                e.preventDefault();

                let formdata = new FormData($('#edit_form')[0]);

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.cupon.edit') }}",
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

                            if (response.fails) {
                                $.each(response.fails, function(key, value){
                                    $('.'+key+'_error').text(value);
                                });
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
                    url: "{{ route('admin.cupon.delete') }}",
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
                    url: "{{ route('admin.cupon.status') }}",
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
                    url: "{{ route('admin.cupon.search') }}",
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
