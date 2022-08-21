<!doctype html>
<html lang="en">

<!-- Mirrored from template.annimexweb.com/optimal/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jun 2022 14:42:58 GMT -->
<head>
        <!--Required Meta Tags-->
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="description">
        <meta name="_token" content="{{csrf_token()}}" />

        <!-- Title Of Site -->
        <title>@yield('title', 'Optimal')</title>
        @include('frontend.layouts.partials.style')
        @yield('setyles')
    </head>

    <body class="login-page">
        <!-- Page Loader -->
        {{-- <div id="pre-loader"><img src="{{asset('assets/frontend/assets')}}/images/loader.gif" alt="Loading..." /></div> --}}
        <!-- End Page Loader -->
            <div class="page-wrapper" id="page_wrapper">
            @include('frontend.layouts.partials.header')

                @yield('content')


            @include('frontend.layouts.partials.footer')
            @include('frontend.layouts.partials.scripts')
            @yield('scripts')



        </div>
        <!--End Page Wrapper-->
    </body>

<!-- Mirrored from template.annimexweb.com/optimal/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Jun 2022 14:42:31 GMT -->
</html>
