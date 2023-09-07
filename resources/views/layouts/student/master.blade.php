<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{ asset('assets/img/Logo/icon.ico') }}" rel="shortcut icon" type="image/x-icon" />
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/manual.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/icons/icomoon/style.css') }}">
        <title>StrandGuide | @yield('page_title')</title>
    </head>
    <body style="background-color: white !important">

        @yield('page_content');

        <script src="{{ asset('assets/bootstrap/jquery/jquery.js') }}"></script>
        <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
        @yield('page_scripts')

    </body>
</html>