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
        <link rel="stylesheet" href="{{ asset("/assets/css/hystmodal/hystmodal.min.css") }}">
		<link rel="stylesheet" href="{{ asset("/assets/css/responsive.css") }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/24.3.4/css/intlTelInput.css" integrity="sha512-E/UQ6jODkpdvwzsowrc5LkTuBkC9oqDx96cUj9v9T5qke/JLFb3RA/PAvhzAA9w4rbMEHf8iR9SHPbYswqdG2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<title>EGSPEC Event Conference & Community</title>

        <link rel="icon" type="image/png" href="{{ asset("/assets/images/favicon.png") }}">

        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}




    </head>
    <body>




        {{-- <x-google-sign-in /> --}}


        <x-header />

        @yield('content')

        <x-footer />

        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>



        <script src="{{ asset("/assets/css/hystmodal/hystmodal.min.js") }}"></script>
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



