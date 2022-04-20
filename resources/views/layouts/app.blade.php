<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('assets/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/dropzone/min/dropzone.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">

        <style>
            .text-middle{
                vertical-align: middle !important;
            }
        </style>
        @stack('styles')
    </head>
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
        <div class="wrapper">
            @include('layouts.partials.navbar')
            @include('layouts.partials.sidebar')

            <div class="content-wrapper">
                @yield('content')
            </div>
            @include('layouts.partials.footer')
        </div>
        <form method="POST" action="{{ route('logout') }}" id="UserLogOutForm">@csrf</form>
        <!-- Scripts -->
        <script src="{{asset('assets/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('assets/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('assets/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{asset('assets/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
        <script src="{{asset('assets/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/jszip/jszip.min.js')}}"></script>
        <script src="{{asset('assets/pdfmake/pdfmake.min.js')}}"></script>
        <script src="{{asset('assets/pdfmake/vfs_fonts.js')}}"></script>
        <script src="{{asset('assets/datatables-buttons/js/buttons.html5.min.js')}}"></script>
        <script src="{{asset('assets/datatables-buttons/js/buttons.print.min.js')}}"></script>
        <script src="{{asset('assets/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
        <script src="{{asset('assets/sweetalert2/sweetalert2.min.js')}}"></script>
        <script src="{{asset('assets/dropzone/min/dropzone.min.js')}}"></script>
        <script src="{{asset('js/adminlte.min.js')}}"></script>
        @stack('scripts')
    </body>
</html>
