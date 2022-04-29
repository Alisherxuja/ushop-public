<!doctype html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="">
    <title>USHOP - интернет магазин</title>
    <link rel="icon" href="{{asset('img/img/icons/favicon.png', env('APP_SSL'))}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.min.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('css/main-style.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('css/root.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('css/media.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('plugins/my-slider/chiefslider.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.carousel.min.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('plugins/owl-carousel/owl.theme.default.min.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('plugins/cats/zeynep.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('plugins/basketright/basrightstyle.css', env('APP_SSL')) }}">
    <link rel="stylesheet" href="{{ asset('css/totop.css', env('APP_SSL')) }}">

    <script src="https://cdn.paycom.uz/integration/js/checkout.min.js"></script>
    @yield('customCss')

</head>

<body>

@include('partials.site.header')

@yield('content')

@include('partials.site.footer')

<script src="{{ asset('js/popper.min.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/bootstrap5.min.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/jquery-3.3.1.min.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/app.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/cat-app.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/preload.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/minicart.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/jssor.slider-28.1.0.min.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('plugins/my-slider/chiefslider.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('plugins/owl-carousel/owl.carousel.min.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('plugins/cats/zeynep.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('plugins/cats/zeynepapp.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('plugins/basketright/basright.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('plugins/basketright/activebas.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/totop.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/jquery.maskedinput.min.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/login.js', env('APP_SSL')) }}"></script>
<script src="{{ asset('js/jssor.slider-28.1.0.min.js', env('APP_SSL')) }}"></script>
{{--
<script src="{{ asset('js/filter.js', env('APP_SSL')) }}"></script>
--}}


<script>
    $("#owl-brat").owlCarousel({
        items: 1,
        loop: true,
        rewind: true,
        margin: 15,
        autoplay: true,
        nav: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,

    });

    $(".owl-carouselMain").owlCarousel({
        items: 4,
        loop: true,
        rewind: true,
        margin: 5,
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            450: {
                items: 2
            },
            700: {
                items: 3
            },
            1000: {
                items: 4
            },
            1200:{
                items: 3
            },
            1400: {
                items: 4
            },
        }
    });
</script>

@yield('customScript')

</body>

</html>
