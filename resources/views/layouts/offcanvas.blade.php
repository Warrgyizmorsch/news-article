<!-- Offcanvas area start -->
<style>
    /* Override default right-side offcanvas to slide from left */
    .offcanvas-area.custom-offcanvas {
        right: auto !important;
        left: -100%;
        transform: none !important;
        transition: left 1.5s cubic-bezier(0.25, 1, 0.5, 1) !important;
    }

    .offcanvas-area.custom-offcanvas.opened {
        right: auto !important;
        left: 0 !important;
        transform: none !important;
    }

    .offcanvas-overlay.custom-overlay {
        background-color: rgba(0, 0, 0, 0.75) !important;
        transform: translateX(-100%) !important;
        opacity: 0 !important;
        transition: transform 1s cubic-bezier(0.25, 1, 0.5, 1), opacity 1.5s ease-in-out, visibility 1.5s !important;
    }

    .offcanvas-overlay.custom-overlay.overlay-open {
        transform: translateX(0) !important;
        opacity: 1 !important;
        visibility: visible !important;
    }

    /* Mobile Menu in Offcanvas */
    .offcanvas-menu {
        margin-bottom: 40px;
    }

    .offcanvas-menu ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .offcanvas-menu ul li {
        border-bottom: 1px solid #1f2937;
    }

    .offcanvas-menu ul li a {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 0;
        color: #fff;
        font-family: 'Source Sans 3', sans-serif;
        font-weight: 600;
        font-size: 16px;
        text-decoration: none;
        transition: color 0.3s;
    }

    .offcanvas-menu ul li a:hover {
        color: #0d6efd;
    }

    .offcanvas-menu ul li .submenu {
        padding-left: 15px;
        background: #18181b;
        display: none;
    }

    .offcanvas-menu ul li.has-dropdown > a::after {
        content: '\ea4e';
        font-family: 'remixicon';
        font-size: 18px;
        transition: transform 0.3s;
    }

    .offcanvas-menu ul li.has-dropdown.open > a::after {
        transform: rotate(180deg);
    }

    .custom-social-btn {
        width: 44px;
        height: 44px;
        border: 1px solid #27272a;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        background: transparent;
        transition: all 0.3s;
        text-decoration: none;
    }

    .custom-social-btn.active,
    .custom-social-btn:hover {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }
</style>
<div class="fix">
    <div class="offcanvas-area custom-offcanvas" data-lenis-prevent
        style="background-color: #111111 !important; color: #e5e7eb; width: 380px; max-width: 100%;">

        <!-- Flush Top Right Close Button -->
        <div class="offcanvas-close" style="position: absolute; top: 0; right: 0; z-index: 10;">
            <button class="offcanvas-close-icon animation--flip"
                onclick="document.querySelector('.offcanvas-area').classList.remove('opened'); document.querySelector('.offcanvas-overlay').classList.remove('overlay-open');"
                style="background: #0d6efd; border: none; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; color: #fff; cursor: pointer; border-radius: 0; padding:0; transition: background 0.3s;"
                onmouseover="this.style.background='#0b5ed7';" onmouseout="this.style.background='#0d6efd';">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <div class="offcanvas-wrapper"
            style="padding: 40px 30px; display: flex; flex-direction: column; height: 100%; overflow-y: auto;">

            <!-- Top Logo -->
            <div class="offcanvas-top mb-4 mt-2">
                <!-- Logo -->
                <div class="offcanvas-logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo/democracy-asia-logo.webp') }}" alt="logo"
                            style="max-height: 60px;">
                    </a>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div class="offcanvas-menu d-block d-xl-none">
                <nav>
                    <ul>
                        <!-- home -->
                        @forelse($headerCategories as $category)
                        <li class="rs-mega-menu  is-text-white" style="white-space:nowrap;">
                            <a href="{{ route('category.show', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                        <li>
                            <a href="/contact-us">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Description -->
            <p style="font-size: 15px; line-height: 1.6; color: #9ca3af; margin-bottom: 30px;">
                Democracy Asia Magazine brings you trusted timely and thought-provoking stories from around the
                globe.
            </p>

            <!-- Image Grid -->
            <!-- <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-bottom: 40px;">
                <img src="{{ asset('assets/images/gallery/gallery-thumb-01.webp') }}"
                    style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/gallery/gallery-thumb-02.webp') }}"
                    style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/gallery/gallery-thumb-03.webp') }}"
                    style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/gallery/gallery-thumb-04.webp') }}"
                    style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/gallery/gallery-thumb-05.webp') }}"
                    style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/gallery/gallery-thumb-06.webp') }}"
                    style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
            </div> -->

            <!-- Quick Contact -->
            <h4 style="color: #fff; font-size: 18px; font-weight: 500; margin-bottom: 20px;">Quick Contact:</h4>

            <ul
                style="list-style: none; padding: 0; margin: 0 0 30px 0; color: #d1d5db; font-size: 15px; display: flex; flex-direction: column; gap: 16px;">
                <li style="display: flex; align-items: center; gap: 12px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0d6efd" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                        <path
                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                        </path>
                    </svg>
                    07974960666
                </li>
                <li style="display: flex; align-items: center; gap: 12px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0d6efd" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    info@democracyasia.com
                </li>
                <li style="display: flex; align-items: center; gap: 12px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0d6efd" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                        <circle cx="12" cy="10" r="3"></circle>
                    </svg>
                   35 Bow Road, London, England, E3 2AD
                </li>
            </ul>

            <!-- Social Links -->
            <div style="display: flex; gap: 10px; margin-bottom: 30px; flex-wrap: wrap;">
                <a href="#" class="custom-social-btn">
                    <i class="ri-facebook-fill" style="font-size: 18px;"></i>
                </a>
                <a href="#" class="custom-social-btn text-white"> 
                    <i class="ri-twitter-x-fill" style="font-size: 18px;"></i>
                </a>
                <a href="#" class="custom-social-btn text-white">
                    <i class="ri-youtube-fill" style="font-size: 18px;"></i>
                </a>
                <a href="#" class="custom-social-btn text-white">
                    <i class="ri-linkedin-box-fill" style="font-size: 18px;"></i>
                </a>
            </div>

            <!-- Get in touch -->
            <a href="/contact-us" style="background: #0d6efd; color: #fff; padding: 12px 24px; border: 1px solid #0d6efd; border-radius: 8px; font-weight: 500; font-size: 16px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; width: max-content; transition: all 0.3s;" onmouseover="this.style.background='transparent'; this.style.borderColor='#27272a';" onmouseout="this.style.background='#0d6efd'; this.style.borderColor='#0d6efd';">
                Get In Touch 
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</div>
<div class="offcanvas-overlay custom-overlay" onclick="document.querySelector('.offcanvas-area').classList.remove('opened'); document.querySelector('.offcanvas-overlay').classList.remove('overlay-open');"></div>
<div class="offcanvas-overlay-white"></div>
<!-- Offcanvas area end -->