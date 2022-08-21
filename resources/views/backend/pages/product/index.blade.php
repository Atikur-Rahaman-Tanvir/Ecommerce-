@extends('backend.layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/assets') }}/jquery_select/css/mobiscroll.jquery.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <style>
        .white_card .white_card_header {
            padding: 5px 30px;
        }

        .mbsc-windows.mbsc-textfield-wrapper {
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <div id="insert_data">

        <section class="main_content dashboard_part large_header_bg">
            <div class="main_content_iner ">
                <div class="container-fluid p-0">
                    <div class="row justify-content-center">

                        <div class="col-lg-12">
                            <div class="white_card card_height_100 mb_30">

                                <div class="white_card_body">
                                    <div class="QA_section">
                                        <div class="white_box_tittle list_header">
                                            <h4>All products</h4>
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
                                                    <button type="button" class="btn_1" data-toggle="modal"
                                                        data-target="#insert_modal">
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
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Status</th>
                                                        <th id="th_image" scope="col">Image</th>
                                                        <th scope="col">Action</th>

                                                    </tr>
                                                </thead>

                                                <tbody id="table_body">
                                                    @foreach ($products as $product)
                                                        <tr>
                                                            <td>{{ $loop->index + 1 }}</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->category->name }}</td>
                                                            <td>
                                                                @if ($product->status == 0)
                                                                    <span class="badge badge-danger">Pending</span>
                                                                @else
                                                                    <span class="badge badge-success">Active</span>
                                                                @endif
                                                            </td>

                                                            <td><img width="50"
                                                                    src="{{ asset('storage/product_image/' . $product->image) }}"
                                                                    alt=""></td>
                                                            <td>
                                                                <div class="action_btns d-flex">


                                                                    <a id="{{ $product->id }}"
                                                                        class="action_btn mr_10 status "> <i
                                                                            class="{{ $product->status == 0 ? 'far fa-eye-slash' : 'fa fa-eye' }}"></i>
                                                                    </a>

                                                                    <a href="{{ route('admin.product.view', $product->id) }}"
                                                                        class="action_btn mr_10">
                                                                        <i class="far fa-edit"></i> </a>




                                                                    <a id="{{ $product->id }}" class="action_btn delete"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#delete_modal">
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
    </div>



    <!-- The Modal -->
    <div class="modal fade " id="insert_modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Product Insert</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body ">
                    <form id="insert_form">
                        @csrf
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Product Name</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger name_error"></span>
                                        <div class=" mb-0">
                                            <input type="text" class="form-control" name="name" id="name"
                                                placeholder="Product Name">
                                        </div>
                                        <p><cite>product name must be unique.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Product Buy Price</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger price_error"></span>
                                        <div class=" mb-0">
                                            <input type="number" class="form-control" name="buy_price" id="buy_price"
                                                placeholder="Product Buy Price">
                                        </div>
                                        <p><cite>enter how much are you buying this product.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Product Selling Price</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger price_error"></span>
                                        <div class=" mb-0">
                                            <input type="number" class="form-control" name="price" id="price"
                                                placeholder="Product selling Price">
                                        </div>
                                        <p><cite>enter how much will you sell this product for.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Discount(%)</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger discout_error"></span>
                                        <div class=" mb-0">
                                            <input type="number" class="form-control" name="discount" id="discount"
                                                placeholder="Enter Discount">
                                        </div>
                                        <p><cite>enter discont in parcentage(%).</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Product Quentity</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger quentity_error"></span>
                                        <div class=" mb-0">
                                            <input type="number" class="form-control" name="quentity" id="quentity"
                                                placeholder="Product Quentity">
                                        </div>
                                        <p><cite>how many product are available.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Category Select</s></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger category_error"></span>
                                        <div class=" mb-0">
                                            <label>

                                                <input mbsc-input id="my-input1" data-dropdown="true"
                                                    placeholder="please select category" />
                                            </label>
                                            <select id="single-select" name="category" id="category">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <p><cite>select category for this product.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Tags Select</s></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger tags_error"></span>
                                        <div class=" mb-0">
                                            <label>
                                                <input mbsc-input id="my-input" data-dropdown="true" data-tags="true"
                                                    placeholder="please select" />
                                            </label>
                                            <select id="multiple-select" multiple name="tags[]" id="tags">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <p><cite>select tags for this product.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Brand Select</s></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger brands_error"></span>
                                        <div class=" mb-0">
                                            <label>
                                                <input mbsc-input id="my-input2" data-dropdown="true" data-tags="true"
                                                    placeholder="please select brand" />
                                            </label>
                                            <select id="multiple-select1" multiple name="brands[]" id="brands">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <p><cite>select brands for this product.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Color Select</s></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger colors_error"></span>
                                        <div class=" mb-0">
                                            <label>
                                                <input mbsc-input id="my-input3" data-dropdown="true" data-tags="true"
                                                    placeholder="please select color" />
                                            </label>
                                            <select id="multiple-select2" multiple name="colors[]" id="colors">
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <p><cite>select colors for this product.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Size Select</s></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger sizes_error"></span>
                                        <div class=" mb-0">
                                            <label>
                                                <input mbsc-input id="my-input4" data-dropdown="true" data-tags="true"
                                                    placeholder="please select size" />
                                            </label>
                                            <select id="multiple-select3" multiple name="sizes[]" id="sizes">
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <p><cite>select size for this product.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white_card card_height_100 mb_30">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Product Image</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger image_error"></span>
                                        <div class=" mb-0">
                                            <input type="file" class="form-control" name="image" id="image">
                                        </div>
                                        <p><cite>Upload Your product Imgae.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="white_card card_height_100 mb_30">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Product Featured Images</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger featured_image_error"></span>
                                        <div class=" mb-0">
                                            <input type="file" class="form-control" name="product_featured_images[]"
                                                id="featured_image" multiple>
                                        </div>
                                        <p><cite>Upload Your product featured Imgaes.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="white_box mb_30">
                                    <div class="box_header ">
                                        <div class="main-title">
                                            <h3 class="mb-0">Product Description</h3>
                                        </div>
                                    </div>
                                    <textarea id="summernote0" name="description"></textarea>
                                    <p><cite>write your product description</cite></p>
                                </div>
                            </div>


                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class=" btn btn-primary">Submit</button>
                            </div>
                        </div>
                </div>


            </div>
            </form>
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
    {{-- ajax crud --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //store
            $('#insert_form').submit(function(e) {
                e.preventDefault();

                let insert_data = new FormData($('#insert_form')[0]);
                console.log(insert_data);
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.product.store') }}",
                    data: insert_data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log($('.input_tags').val);
                        if (response.success) {
                            location.reload();
                        } else {
                            if (response.fails) {
                                $.each(response.fails, function(key, value) {
                                    $('.' + key + '_error').text(value);
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
                    url: "{{ route('admin.product.delete') }}",
                    data: {
                        'id': id
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response.images);
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
                    url: "{{ route('admin.product.status') }}",
                    data: {
                        'id': id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#success_msg').removeClass('d-none');
                        $('#success_msg_text').text(response.success);
                        $('#data_table').load(location.href + ' #data_table');
                        // $('#search_box').val('');

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
                    url: "{{ route('admin.product.search') }}",
                    data: {
                        'search': value
                    },
                    success: function(response) {
                        $('#data_table').html(response);
                        if (response.not_found) {
                            $('#data_table').html("<span class='text-danger'>" + response
                                .not_found + "</span>");

                        }
                        if (response.null) {
                            location.reload();
                        }
                    }
                })
            });


        });
    </script>



    <script src="{{ asset('assets/backend/assets') }}/jquery_select/js/mobiscroll.jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summernote0').summernote();
        });
    </script>



    {{-- insert --}}
    <script>
        $('#single-select').mobiscroll().select({
            inputElement: document.getElementById('my-input1'),
            touchUi: false
        });
    </script>
    <script>
        $('#multiple-select').mobiscroll().select({
            inputElement: document.getElementById('my-input'),
            touchUi: false
        });
    </script>
    <script>
        $('#multiple-select1').mobiscroll().select({
            inputElement: document.getElementById('my-input2'),
            touchUi: false
        });
    </script>
    <script>
        $('#multiple-select2').mobiscroll().select({
            inputElement: document.getElementById('my-input3'),
            touchUi: false
        });
    </script>
    <script>
        $('#multiple-select3').mobiscroll().select({
            inputElement: document.getElementById('my-input4'),
            touchUi: false
        });
    </script>
@endsection
