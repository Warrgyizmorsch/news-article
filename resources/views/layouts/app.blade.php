<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="template-version" content="1.0.3">
    <title>Democracy Asia</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">
    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/vendor/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper.min.css">
    <link rel="stylesheet" href="assets/css/vendor/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/vendor/spacing.css">
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>

<body class="rs-smoother-yes">
    <!-- Header  -->
    @include('layouts.header')

    <!-- Body main wrapper start -->
    <main>
        @yield('content')
    </main>
    <!-- Body main wrapper end -->

    <!-- Footer  -->
    @include('layouts.footer')

    <!-- back to top -->
    <!-- Backtotop start -->
    <div class="backtotop-wrap cursor-pointer">
        <i class="ri-arrow-up-s-line"></i>
    </div>
    <!-- Backtotop end -->

    <!-- JS here -->
    <script src="assets/js/vendor/jquery-3.7.1.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/plugins/meanmenu.min.js"></script>
    <script src="assets/js/plugins/swiper.min.js"></script>
    <script src="assets/js/plugins/wow.min.js"></script>
    <script src="assets/js/vendor/magnific-popup.min.js"></script>
    <script src="assets/js/vendor/isotope.pkgd.min.js"></script>
    <script src="assets/js/vendor/imagesloaded.pkgd.min.js"></script>
    <script src="assets/js/vendor/ajax-form.js"></script>
    <script src="assets/js/plugins/lenis.min.js"></script>
    <script src="assets/js/plugins/gsap.min.js"></script>
    <script src="assets/js/plugins/rs-anim-int.js"></script>
    <script src="assets/js/plugins/rs-scroll-trigger.min.js"></script>
    <script src="assets/js/plugins/rs-splitText.min.js"></script>
    <script src="assets/js/plugins/jquery.appear.min.js"></script>
    <script src="assets/js/vendor/dark-light.js"></script>
    <script src="assets/js/main.js"></script>
</body>


</html>