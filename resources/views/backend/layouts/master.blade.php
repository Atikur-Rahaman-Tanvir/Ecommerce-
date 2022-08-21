<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from demo.dashboardpack.com/cryptocurrency-html/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 05 Jun 2022 07:06:03 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="_token" content="{{csrf_token()}}" />
    <title>@yield('title', 'Optimal Admin')</title>
    @include('backend.layouts.partials.style')
    @yield('styles')
</head>

<body class="crm_body_bg">


    @include('backend.layouts.partials.sidebar')

    @yield('content')

    @include('backend.layouts.partials.footer')
    @include('backend.layouts.partials.script')
    @yield('scripts')
</body>

</html>
