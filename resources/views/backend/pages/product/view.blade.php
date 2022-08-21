@extends('backend.layouts.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/backend/assets') }}/jquery_select/css/mobiscroll.jquery.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .white_card .white_card_header {
            padding: 5px 30px;
        }

        .mbsc-windows.mbsc-textfield-wrapper {
            margin: 0;
        }

        .white_card_body p {
            margin-bottom: 15px;
            /* margin-left: 17px; */
        }


        .select2-container--default .select2-selection--multiple {
            background-color: white;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: text;
            padding-bottom: 5px;
            padding-right: 5px;
            position: relative;
            width: 260px;
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 28px;
            user-select: none;
            -webkit-user-select: none;
            width: 260px;
        }
    </style>
@endsection
@section('content')
    <section class="main_content dashboard_part large_header_bg">
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                <div class="row justify-content-center">


                    <div id='success_msg'
                        class="d-none alert text-white bg-success d-flex align-items-center justify-content-between"
                        role="alert">
                        <div class="alert-text" id="success_msg_text"></div>
                        <button type="button" class="btn-close" aria-label="Close" id="alert_close"> </button>

                    </div>

                    <form id="edit_form">
                        @csrf
                        <div class="row">
                            <input type="hidden" value="{{ $product->id }}" name="id" id="eidt_id">
                            <div class="col-lg-12">
                                <div class="white_card card_height_100 ">
                                    <div class="white_card_header">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h2 class="m-0 text-primary">Porduct Edit And Update</h2>
                                                <a href="{{ route('admin.product.index') }}"
                                                    class="btn btn-outline-danger mb-3 mt-3">Back To Product Page</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">

                                    </div>
                                </div>
                            </div>
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
                                                placeholder="Product Name" value="{{ $product->name }}">
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
                                                placeholder="Product Price" value="{{ $product->buy_price }}">
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
                                                placeholder="Product selling Price" value="{{ $product->price }}">
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
                                                placeholder="Enter Discount" value="{{ $product->discount }}">
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
                                                placeholder="Product Quentity" value="{{ $product->quentity }}">
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

                                                <select class="js-example-basic-single" name="category" id="category">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
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

                                            <select class="js-example-basic-multiple" name="tags[]" multiple="multiple">
                                                @foreach ($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                        @foreach ($product->tags as $newTag) {{ $newTag->id == $tag->id ? 'selected' : '' }} @endforeach>
                                                        {{ $tag->name }}</option>
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

                                            <select class="js-example-basic-multiple" name="brands[]" id="brands"
                                                multiple="multiple">
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}"
                                                        @foreach ($product->brands as $newBrands) {{ $newBrands->id == $brand->id ? 'selected' : '' }} @endforeach>
                                                        {{ $brand->name }}</option>
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

                                            <select class="js-example-basic-multiple" name="colors[]" id="colors"
                                                multiple="multiple">
                                                @foreach ($colors as $color)
                                                    <option value="{{ $color->id }}"
                                                        @foreach ($product->colors as $newBrands) {{ $newBrands->id == $color->id ? 'selected' : '' }} @endforeach>
                                                        {{ $color->name }}</option>
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
                                            <select class="js-example-basic-multiple" name="sizes[]" id="sizes"
                                                multiple="multiple">
                                                @foreach ($sizes as $size)
                                                    <option value="{{ $size->id }}"
                                                        @foreach ($product->sizes as $newSize) {{ $newSize->id == $size->id ? 'selected' : '' }} @endforeach>
                                                        {{ $size->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <p><cite>select size for this product.</cite></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="white_card card_height_100 mb_30">
                                    <div class="white_card_header ">
                                        <div class="box_header m-0">
                                            <div class="main-title">
                                                <h3 class="m-0">Product Image</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="white_card_body">
                                        <span class="text-danger image_error"></span>
                                        <div class=" mb-0">
                                            <div>
                                                {{-- <span><i class="fa fa-times"
                                                        style="position: absolute;left: 119px; font-size: 15px;z-index:1"></i></span> --}}
                                                <img id="product_image_change" width="100" class="mb-2"
                                                    src="{{ asset('storage/product_image/' . $product->image) }}"
                                                    alt="">
                                            </div>
                                            {{-- <input type="file" class="form-control" name="image" id="image"> --}}
                                            <a data-bs-toggle="modal" data-bs-target="#product_image_modal"
                                                class="btn btn-outline-primary  mt-3" id="product_image">Change Product
                                                Image</a>

                                        </div>
                                        {{-- <p><cite>Upload Your product Imgae.</cite></p> --}}
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
                                    <div class="white_card_body" id="feature_image">
                                        <span class="text-danger featured_image_error"></span>
                                        <div class=" mb-0">
                                            @foreach ($product->product_featured_images as $product_featured_image)
                                                @if ($product_featured_image->product_featured_image)
                                                    <div style="display: inline;margin-right:3px"
                                                        class="product_feature_product_image_id"
                                                        id="{{ $product_featured_image->id }}">
                                                        <span><i class="fa fa-times image_close"
                                                                style="position: absolute;font-size: 15px;z-index:1"
                                                                id="{{ $product_featured_image->id }}"></i></span>
                                                        <img id="feature_product_image_change" width="100"
                                                            class="mb-2"
                                                            src="{{ asset('storage/product_featured_image/' . $product_featured_image->product_featured_image) }}"
                                                            alt="">
                                                    </div>
                                                @endif
                                            @endforeach

                                            <div>

                                                {{-- <input type="file" class="form-control" name="image" id="image"> --}}
                                                <a data-bs-toggle="modal" data-bs-target="#product_featured_image_modal"
                                                    class="btn btn-outline-primary  mt-3" id="product_image">Upload
                                                    Feature Product
                                                    Image</a>
                                            </div>

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
                                    <textarea id="summernote" name="description">{{ $product->description }}</textarea>
                                    <p><cite>write your product description</cite></p>
                                </div>
                            </div>


                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="submit" class=" btn btn-primary">Update</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
<div class="modal fade" id="product_image_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Category Edit And Update
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="product_image_form">
                    @csrf
                    <input type="hidden" name="id" id="edit_id" value="{{ $product->id }}">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header" style="padding:22px 30px;">
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
                                <p><cite>Change Product Imgae.</cite></p>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-5">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="product_featured_image_modal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Category Edit And Update
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="product_featured_image_form">
                    @csrf
                    <input type="hidden" name="id" id="edit_id" value="{{ $product->id }}">
                    <div class="col-lg-12">
                        <div class="white_card card_height_100 mb_30">
                            <div class="white_card_header" style="padding:22px 30px;">
                                <div class="box_header m-0">
                                    <div class="main-title">
                                        <h3 class="m-0">Product Image</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="white_card_body">
                                <span class="text-danger product_featured_images_error"></span>
                                <div class=" mb-0">
                                    <input type="file" class="form-control" name="product_featured_images[]"
                                        id="featured_image" multiple>
                                </div>
                                <p><cite>Change Product Imgae.</cite></p>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-5">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>


@section('scripts')
    <script src="{{ asset('assets/backend/assets') }}/jquery_select/js/mobiscroll.jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote1').summernote();
        });
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });


            // edit data
            $('#edit_form').submit(function(e) {
                e.preventDefault();

                let formdata = new FormData($('#edit_form')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.product.edit') }}",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            window.location.replace(response.route);
                            $('#success_msg').removeClass('d-none');
                            $('#success_msg_text').text(response.success);
                        } else {
                            console.log(response.fails.name);
                            if (response.fails) {
                                $.each(response.fails, function(key, value) {
                                    $('.' + key + '_error').text(value[0]);
                                });
                            }
                        }
                    }

                });

            });
            // Change Product Image
            $('#product_image_form').submit(function(e) {
                e.preventDefault();

                let formdata = new FormData($('#product_image_form')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.product.image.change') }}",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            // window.location.replace(response.route);
                            $('#product_image_modal').modal('hide');
                            $('#product_image_modal').find('input').val();
                            $('#product_image_change').attr('src', response.src);
                            $('#success_msg').removeClass('d-none');
                            $('#success_msg_text').text(response.success);
                        } else {
                            console.log(response.fails.name);
                            if (response.fails) {
                                $.each(response.fails, function(key, value) {
                                    $('.' + key + '_error').text(value[0]);
                                });
                            }
                        }
                    }

                });

            });


            //product_featured_image delete
            $(document).on('click', '.image_close', function() {
                f_i_id = $(this).attr('id');
                id = $('#feature_image_product_id').val();
                // f_i_id = $('.product_feature_product_image_id').attr('id');
                console.log(f_i_id);
                $.ajax({
                    type: 'get',
                    url: "{{ route('admin.product.feature.image.delete') }}",
                    data: {
                        'id': id,
                        'f_i_id': f_i_id,
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('#feature_image').load(location.href + ' #feature_image');
                        $('#success_msg').removeClass('d-none');
                        $('#success_msg_text').text(response.success);
                    }

                });


            });

            // product_featured_image_upload
            $('#product_featured_image_form').submit(function(e) {
                e.preventDefault();

                let formdata = new FormData($('#product_featured_image_form')[0]);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.product.feature.image.upload') }}",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            // window.location.replace(response.route);
                            $('#product_featured_image_modal').modal('hide');
                            $('#product_featured_image_modal').find('input').val();
                            $('#feature_image').load(location.href + ' #feature_image');

                            $('#success_msg').removeClass('d-none');
                            $('#success_msg_text').text(response.success);
                        } else {
                            console.log(response.fails.name);
                            if (response.fails) {
                                $.each(response.fails, function(key, value) {
                                    $('.' + key + '_error').text(value[0]);
                                });
                            }
                        }
                    }

                });

            });

            //success message control;
            $(document).on('click', '#alert_close', function() {
                $('#success_msg').addClass('d-none');
            });

        });
    </script>


    {{-- //edit --}}
    <script>
        $('#single-select1').mobiscroll().select({
            inputElement: document.getElementById('my-input10'),
            touchUi: false
        });
    </script>
    {{-- select2 --}}
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endsection
