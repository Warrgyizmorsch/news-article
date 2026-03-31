<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="template-version" content="1.0.3">
    <title>@yield('title', 'Democracy Asia')</title>
    <meta name="description" content="@yield('meta_description', '')">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon-d.webp') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/spacing.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body class="rs-smoother-yes">
    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <div class="backtotop-wrap cursor-pointer">
        <i class="ri-arrow-up-s-line"></i>
    </div>

    <script src="{{ asset('assets/js/vendor/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/meanmenu.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/lenis.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/rs-anim-int.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/rs-scroll-trigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/rs-splitText.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/dark-light.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Newsletter Modal Start -->
    <div class="da-newsletter-modal" id="daNewsletterModal">
        <div class="da-newsletter-overlay"></div>
    
        <div class="da-newsletter-dialog">
            <button type="button" class="da-newsletter-close" id="daNewsletterClose">
                <i class="ri-close-line"></i>
            </button>
    
            <div class="da-newsletter-left">
                <img src="https://static.vecteezy.com/system/resources/thumbnails/007/615/486/small/text-subscribe-now-appearing-behind-torn-brown-paper-top-view-photo.jpg" alt="Subscribe">
            </div>
    
            <div class="da-newsletter-right">
                <div class="da-newsletter-logo">
                    <img src="{{ asset('assets/images/logo/democracy-asia-logo.webp') }}" alt="Democracy Asia">
                </div>
    
                <h3>Unlock Your Daily Briefing</h3>
    
                <p>
                    Get the latest headlines, exclusive reports, and important updates delivered directly to your inbox.
                </p>
    
                <form method="POST" action="#" class="da-newsletter-form">
                    @csrf
    
                    <div class="da-newsletter-field">
                        <input type="email" name="email" placeholder="Enter your email..." required>
                    </div>
    
                    <label class="da-newsletter-check">
                        <input type="checkbox" required>
                        <span>I agree to the <a href="#">terms & conditions</a></span>
                    </label>
    
                    <button type="submit" class="da-newsletter-btn">Subscribe</button>
                </form>
    
                <div class="da-newsletter-social">
                    <a href="#"><i class="ri-facebook-fill"></i></a>
                    <a href="#"><i class="ri-instagram-line"></i></a>
                    <a href="#"><i class="ri-linkedin-fill"></i></a>
                    <a href="#"><i class="ri-twitter-x-line"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter Modal End -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('daNewsletterModal');
            const closeBtn = document.getElementById('daNewsletterClose');
            const overlay = modal ? modal.querySelector('.da-newsletter-overlay') : null;

            if (!modal) return;

            const now = Date.now();
            const closedUntil = localStorage.getItem('da_newsletter_closed_until');

            if (!closedUntil || now > parseInt(closedUntil)) {
                setTimeout(() => {
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }, 4000);
            }

            function closeModal() {
                modal.classList.remove('active');
                document.body.style.overflow = '';

                // ⏳ show again after 24 hours
                const nextShowTime = Date.now() + (24 * 60 * 60 * 1000);
                localStorage.setItem('da_newsletter_closed_until', nextShowTime);
            }

            closeBtn?.addEventListener('click', closeModal);
            overlay?.addEventListener('click', closeModal);
        });
    </script>
</body>

</html>