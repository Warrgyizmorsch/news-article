<!-- Offcanvas area start -->
<div class="fix">
    <div class="offcanvas-area custom-offcanvas" data-lenis-prevent style="background-color: #111111 !important; color: #e5e7eb;">
        <div class="offcanvas-wrapper" style="padding: 40px 30px; display: flex; flex-direction: column; height: 100%; overflow-y: auto;">
            <!-- Top Logo & Close -->
            <div class="offcanvas-top d-flex justify-content-between align-items-center mb-4" style="position: relative;">
                <div class="offcanvas-logo" style="margin-top: 10px;">
                    <a href="{{ route('home') }}"><img src="{{ asset('assets/images/logo/da-logo-white.png') }}" alt="logo" style="max-height: 48px;"></a>
                </div>
                <!-- Close Button -->
                <div class="offcanvas-close" style="position: absolute; top: -30px; right: -30px;">
                    <button class="offcanvas-close-icon" onclick="document.querySelector('.offcanvas-area').classList.remove('opened'); document.querySelector('.offcanvas-overlay').classList.remove('opened'); document.querySelector('.offcanvas-overlay-white').classList.remove('opened');" style="background: #006aff; border: none; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; color: #fff; cursor: pointer; border-radius: 0; transition: background 0.3s; padding:0;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </div>

            <!-- Description -->
            <p style="font-size: 15px; line-height: 1.6; color: #9ca3af; margin-bottom: 30px;">
                We love to bring to life as a developer and I aim the today do this using whatever front end tools of the necessary.
            </p>

            <!-- Image Grid -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px; margin-bottom: 40px;">
                <img src="{{ asset('assets/images/default/news-placeholder.webp') }}" style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/default/news-placeholder.webp') }}" style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/default/news-placeholder.webp') }}" style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/default/news-placeholder.webp') }}" style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/default/news-placeholder.webp') }}" style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
                <img src="{{ asset('assets/images/default/news-placeholder.webp') }}" style="width: 100%; aspect-ratio: 1; object-fit: cover; border-radius: 8px;" alt="gallery">
            </div>

            <!-- Quick Contact -->
            <h4 style="color: #fff; font-size: 20px; font-weight: 500; margin-bottom: 24px;">Quick Contact:</h4>
            
            <ul style="list-style: none; padding: 0; margin: 0 0 40px 0; color: #d1d5db; font-size: 15px; display: flex; flex-direction: column; gap: 16px;">
                <li style="display: flex; align-items: flex-start; gap: 12px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#006aff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top:2px; flex-shrink:0;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    +81112522552
                </li>
                <li style="display: flex; align-items: flex-start; gap: 12px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#006aff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top:2px; flex-shrink:0;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    info@nerio.com
                </li>
                <li style="display: flex; align-items: flex-start; gap: 12px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#006aff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top:2px; flex-shrink:0;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    Ta-134/A, NY 11110, USA
                </li>
            </ul>

            <!-- Social Links -->
            <div style="display: flex; gap: 12px; margin-bottom: 40px; flex-wrap: wrap;">
                <a href="#" style="width: 44px; height: 44px; border: 1px solid #374151; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#006aff'; this.style.borderColor='#006aff';" onmouseout="this.style.background='transparent'; this.style.borderColor='#374151';">
                    <i class="ri-facebook-fill" style="font-size: 18px;"></i>
                </a>
                <a href="#" style="width: 44px; height: 44px; border: 1px solid #374151; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#006aff'; this.style.borderColor='#006aff';" onmouseout="this.style.background='transparent'; this.style.borderColor='#374151';">
                    <i class="ri-instagram-line" style="font-size: 18px;"></i>
                </a>
                <a href="#" style="width: 44px; height: 44px; border: 1px solid #374151; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#006aff'; this.style.borderColor='#006aff';" onmouseout="this.style.background='transparent'; this.style.borderColor='#374151';">
                    <i class="ri-pinterest-fill" style="font-size: 18px;"></i>
                </a>
                <a href="#" style="width: 44px; height: 44px; border: 1px solid #374151; border-radius: 8px; display: flex; align-items: center; justify-content: center; color: #fff; transition: all 0.3s; text-decoration: none;" onmouseover="this.style.background='#006aff'; this.style.borderColor='#006aff';" onmouseout="this.style.background='transparent'; this.style.borderColor='#374151';">
                    <i class="ri-twitter-x-fill" style="font-size: 18px;"></i>
                </a>
            </div>

            <!-- Get in touch -->
            <a href="/contact-us" style="background: #006aff; color: #fff; padding: 14px 28px; border-radius: 8px; font-weight: 600; font-size: 16px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; width: max-content; transition: background 0.3s;" onmouseover="this.style.background='#0056cc';" onmouseout="this.style.background='#006aff';">
                Get In Touch 
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 4px;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </a>
        </div>
    </div>
</div>
<div class="offcanvas-overlay"></div>
<div class="offcanvas-overlay-white"></div>
<!-- Offcanvas area end -->
