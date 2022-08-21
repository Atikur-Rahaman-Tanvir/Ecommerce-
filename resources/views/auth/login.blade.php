@extends('frontend.layouts.master')
@section('title')
    login
@endsection
@section('content')
    <!--Body Container-->
    <div id="page-content">
        <!--Collection Banner-->
        <div class="collection-header">
            <div class="collection-hero">
                <div class="collection-hero__image"></div>
                <div class="collection-hero__title-wrapper container">
                    <h1 class="collection-hero__title">Login</h1>
                    <div class="breadcrumbs text-uppercase mt-1 mt-lg-2"><a href="index-2.html"
                            title="Back to the home page">Home</a><span>|</span><span class="fw-bold">Login</span></div>
                </div>
            </div>
        </div>
        <!--End Collection Banner-->

        <!--Container-->
        <div class="container">
            <!--Main Content-->
            <div class="login-register pt-2 pt-lg-5">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4 mb-md-0">
                        <div class="inner">
                            <form id="login_form" method="post" action="#" class="{{ route('login') }}">
                                @csrf
                                <h3 class="h4 text-uppercase">REGISTERED CUSTOMERS</h3>
                                <p>If you have an account with us, please log in.</p>
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="CustomerEmail" class="d-none">Email <span
                                                    class="required">*</span></label>
                                            <input type="email" name="email" placeholder="Email" id="CustomerEmail"
                                                value="admin@gmail.com" required/>
                                            {{-- <input type="email" name="email" placeholder="Email" id="CustomerEmail"
                                                value="{{old('email')}}" required/> --}}
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="CustomerPassword" class="d-none">Password <span
                                                    class="required">*</span></label>
                                            <input type="password" name="password" placeholder="Password"
                                                id="CustomerPassword" value="12312312"  required/>
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-left col-12 col-sm-12 col-md-12 col-lg-12">
                                        <p class="d-flex-center">
                                            <input type="submit" class="btn rounded me-auto" value="Sign In">
                                            <a href="forgot-password.html">Forgot your password?</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="inner">
                            <h3 class="h4 text-uppercase">NEW CUSTOMER?</h3>
                            <p>Registering for this site allows you to access your order status and history. We’ll get a new
                                account set up for you in no time. For this will only ask you for information necessary to
                                make the purchase process faster and easier</p>
                            <a href="register.html" class="btn rounded">Create an account</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Main Content-->
        </div>
        <!--End Container-->
    </div>
    <!--End Body Container-->
@endsection
@section('scripts')
    {{-- <script>
        $(document).ready(function() {

            $('#login_form').submit(function(e) {
                e.preventDefault();

                var token = $("input[name='_token']").val();
                var email = $("input[name='email']").val();
                var password = $("input[name='password']").val();

            });
        });
    </script> --}}

    {{-- <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#submit').click(function(e) {
                e.preventDefault();
                jQuery.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/form') }}",
                    method: 'post',
                    data: {
                        name: jQuery('#footballername').val(),
                        type: jQuery('#club').val(),
                        price: jQuery('#country').val()
                    },
                    success: function(data) {
                        jQuery.each(data.errors, function(key, value) {
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').append('<p>' + value + '</p>');
                        });
                    }

                });
            });
        });
    </script> --}}
@endsection
