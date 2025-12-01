<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{ asset('css/plugins/toastr/toastr.min.css') }}" rel="stylesheet">


    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app_style.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/colorpicker/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

    <!-- Data tables -->
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/dataTables/select.dataTables.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">

    <!-- Fullcalendar -->
    <link href="{{ asset('css/plugins/fullcalendar/fullcalendar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/fullcalendar/fullcalendar.print.css') }}" rel='stylesheet' media='print'>


    <link href="{{ asset('css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">

    <!-- Chosen -->
    <link href="{{ asset('/css/plugins/chosen/bootstrap-chosen.css') }}" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="{{ asset('css/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- jsTree -->
    <link href="{{ asset('css/themes/default/style.css') }}" rel="stylesheet">

    <!-- daterangepicker -->
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/clockpicker/clockpicker.css') }}" rel="stylesheet">


    @include('partials/includesJs')
    @include('partials/jsFunctions')

</head>

<body class="md-skin fixed-sidebar fixed-nav ">
<div id="wrapper">
    <!-- sidebar-->
    @include('partials/sidebar')


    <div id="page-wrapper" class="gray-bg">

        <!-- top navbar-->
        @include('partials/header')

        <div class="wrapper wrapper-content ">
            @yield('content')
        </div>

        <!-- footer -->
        @include('partials/footer')

    </div>
</div>
<script>

</script>
@stack('scripts')

</body>
</html>
