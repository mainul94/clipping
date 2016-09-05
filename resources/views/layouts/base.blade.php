<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/23/16
 * Time: 3:34 PM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('_partial.meta')
    <title>UHSSP | @yield('title') </title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{!! asset('vendors/nprogress/nprogress.css') !!}" rel="stylesheet">

    @yield('head')
    <!-- Custom Theme Style -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('head_script')
</head>
<body class="@yield('body_class')">
@yield('body')
<!-- jQuery -->
<script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
<!-- NProgress -->
<script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>
<!-- Smart Resize -->
<script src="{{ asset('js/smartresize.js') }}"></script>

<!-- Custom Theme Scripts -->
<script src="{{ asset('js/custom.js') }}"></script>

@yield('footer_script')
@yield('script_call')

</body>
</html>
