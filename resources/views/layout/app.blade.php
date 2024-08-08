<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="{{ asset("/assets/css/bootstrap.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/animate.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/meanmenu.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/boxicons.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/flaticon.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/odometer.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/owl.carousel.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/owl.theme.default.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/magnific-popup.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/style.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/css/dark.css") }}">
		<link rel="stylesheet" href="{{ asset("/assets/css/responsive.css") }}">

		<title>EGSPEC Event Conference & Community</title>

        <link rel="icon" type="image/png" href="{{ asset("/assets/images/favicon.png") }}">


    </head>
    <body>


        <x-header />

        @yield('content')

        <x-footer />



        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

        <script src="{{ asset("/assets/js/jquery.min.js") }}"></script>
        <script src="{{ asset("/assets/js/bootstrap.bundle.min.js") }}"></script>
        <script src="{{ asset("/assets/js/jquery.meanmenu.js") }}"></script>
        <script src="{{ asset("/assets/js/owl.carousel.min.js") }}"></script>
        <script src="{{ asset("/assets/js/jquery.appear.js") }}"></script>
        <script src="{{ asset("/assets/js/odometer.min.js") }}"></script>
        <script src="{{ asset("/assets/js/jquery.magnific-popup.min.js") }}"></script>
		<script src="{{ asset("/assets/js/jquery.ajaxchimp.min.js") }}"></script>
		<script src="{{ asset("/assets/js/form-validator.min.js") }}"></script>
        <script src="{{ asset("/assets/js/contact-form-script.js") }}"></script>
        <script src="{{ asset("/assets/js/wow.min.js") }}"></script>
        <script src="{{ asset("/assets/js/main.js") }}"></script>
        {{-- Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }}) --}}
    </body>
</html>



