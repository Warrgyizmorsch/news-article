<!-- footer area start -->
<footer class="rs-footer-area rs-footer-one">
    <div class="" style="padding: 40px 0; position: relative; z-index: 1;">
        <div class="container">
            <div class="row g-5">
                {{-- Column 1 --}}
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6">
                    <div class="rs-footer-widget footer-1-col-1">
                        <div class="rs-footer-widget-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('assets/images/logo/democracy-asia-logo.webp') }}" alt="logo">
                            </a>
                        </div>

                        <div class="rs-footer-widget-content">
                            <p class="rs-footer-widget-description">
                                Stay updated with the latest breaking stories, political developments, world affairs,
                                and in-depth reporting from across Asia and beyond.
                            </p>

                            <div class="rs-footer-widget-social">
                                <div class="rs-theme-social theme-social">
                                    <a href="#"><svg width="14" height="22" viewBox="0 0 14 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.624 11.9541L12.193 8.54137L8.63572 8.54137V6.32676C8.63572 5.39311 9.13264 4.48303 10.7258 4.48303H12.343V1.57748C12.343 1.57748 10.8755 1.34692 9.47233 1.34692C6.54282 1.34692 4.62796 2.98146 4.62796 5.94041L4.62796 8.54137H1.37158L1.37158 11.9541H4.62796L4.62796 20.2041H8.63572L8.63572 11.9541H11.624Z"
                                                fill="white"></path>
                                        </svg></a>
                                    <a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.6045 5.45036C17.5641 4.53485 17.4161 3.9055 17.204 3.3601C16.9852 2.78121 16.6486 2.26294 16.2077 1.83208C15.7768 1.39452 15.2551 1.0545 14.6829 0.839154C14.1344 0.627106 13.5083 0.479009 12.5928 0.438686C11.6705 0.394863 11.3777 0.384766 9.03843 0.384766C6.69917 0.384766 6.40637 0.394863 5.48747 0.435253C4.57199 0.475643 3.94261 0.623808 3.39738 0.835721C2.81832 1.0545 2.30005 1.39108 1.86919 1.83208C1.43163 2.26291 1.09178 2.78461 0.876264 3.3568C0.664216 3.9055 0.516152 4.53148 0.475796 5.44692C0.432006 6.36927 0.421875 6.66206 0.421875 9.00132C0.421875 11.3406 0.432006 11.6334 0.472363 12.5523C0.512753 13.4678 0.660917 14.0971 0.872999 14.6425C1.09178 15.2214 1.43163 15.7397 1.86919 16.1706C2.30005 16.6081 2.82175 16.9481 3.39395 17.1635C3.94258 17.3755 4.56856 17.5236 5.4842 17.564C6.40294 17.6045 6.6959 17.6144 9.03516 17.6144C11.3744 17.6144 11.6672 17.6045 12.5861 17.564C13.5016 17.5236 14.131 17.3756 14.6762 17.1635C15.2489 16.9421 15.7689 16.6035 16.2031 16.1693C16.6372 15.7352 16.9759 15.2152 17.1973 14.6425C17.4092 14.0939 17.5574 13.4678 17.5978 12.5523C17.6382 11.6334 17.6483 11.3406 17.6483 9.00132C17.6483 6.66206 17.6449 6.36923 17.6045 5.45036ZM16.0529 12.485C16.0159 13.3264 15.8745 13.7808 15.7567 14.0837C15.4672 14.8343 14.8715 15.4301 14.1208 15.7196C13.8179 15.8374 13.3603 15.9787 12.5221 16.0157C11.6133 16.0562 11.3408 16.0662 9.04186 16.0662C6.74296 16.0662 6.46699 16.0562 5.56148 16.0157C4.72002 15.9787 4.26563 15.8374 3.96271 15.7196C3.5892 15.5815 3.24922 15.3628 2.97322 15.0767C2.68712 14.7973 2.46834 14.4607 2.33027 14.0872C2.21247 13.7842 2.07114 13.3264 2.03421 12.4884C1.99369 11.5796 1.98373 11.3069 1.98373 9.00802C1.98373 6.70911 1.99369 6.43315 2.03421 5.5278C2.07114 4.68634 2.21247 4.23196 2.33027 3.92903C2.46834 3.55535 2.68712 3.21544 2.97665 2.93937C3.25588 2.65328 3.59246 2.4345 3.96614 2.2966C4.26907 2.17879 4.72689 2.03743 5.56491 2.00037C6.47369 1.95998 6.74639 1.94988 9.04513 1.94988C11.3475 1.94988 11.62 1.95998 12.5255 2.00037C13.367 2.03746 13.8214 2.17876 14.1243 2.29656C14.4978 2.4345 14.8378 2.65328 15.1138 2.93937C15.3999 3.21877 15.6186 3.55535 15.7567 3.92903C15.8745 4.23196 16.0159 4.68961 16.0529 5.5278C16.0933 6.43658 16.1034 6.70911 16.1034 9.00802C16.1034 11.3069 16.0933 11.5762 16.0529 12.485Z"
                                                fill="white"></path>
                                            <path
                                                d="M9.0335 4.57741C6.58997 4.57741 4.60742 6.55982 4.60742 9.00349C4.60742 11.4472 6.58997 13.4296 9.0335 13.4296C11.4771 13.4296 13.4596 11.4472 13.4596 9.00349C13.4596 6.55982 11.4771 4.57741 9.0335 4.57741ZM9.0335 11.8746C7.44826 11.8746 6.16237 10.5889 6.16237 9.00349C6.16237 7.41811 7.44826 6.13243 9.03347 6.13243C10.6188 6.13243 11.9046 7.41811 11.9046 9.00349C11.9046 10.5889 10.6188 11.8746 9.0335 11.8746ZM14.668 4.40239C14.668 4.97303 14.2053 5.4357 13.6345 5.4357C13.0639 5.4357 12.6013 4.97303 12.6013 4.40239C12.6013 3.83167 13.0639 3.36914 13.6346 3.36914C14.2053 3.36914 14.668 3.83164 14.668 4.40239Z"
                                                fill="white"></path>
                                        </svg></a>
                                    <a href="#"><svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.35332 6.88729L14.6472 0.733521H13.3928L8.79603 6.07675L5.12465 0.733521H0.890137L6.44199 8.81343L0.890137 15.2666H2.1447L6.99896 9.62397L10.8762 15.2666H15.1107L9.35332 6.88729ZM7.63502 8.88462L7.0725 8.08004L2.59674 1.67793H4.52367L8.13567 6.84464L8.69818 7.64922L13.3933 14.3651H11.4664L7.63502 8.88462Z"
                                                fill="white"></path>
                                        </svg></a>
                                    <a href="#"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.7973 17.7992V11.3532C17.7973 8.18522 17.1153 5.76522 13.4193 5.76522C11.6373 5.76522 10.4493 6.73322 9.96527 7.65722H9.92126V6.05122H6.42326V17.7992H10.0753V11.9692C10.0753 10.4292 10.3613 8.95522 12.2533 8.95522C14.1233 8.95522 14.1453 10.6932 14.1453 12.0572V17.7772H17.7973V17.7992ZM0.483266 6.05122H4.13527V17.7992H0.483266V6.05122ZM2.30927 0.199219C1.14327 0.199219 0.197266 1.14522 0.197266 2.31122C0.197266 3.47722 1.14327 4.44522 2.30927 4.44522C3.47527 4.44522 4.42127 3.47722 4.42127 2.31122C4.42127 1.14522 3.47527 0.199219 2.30927 0.199219Z"
                                                fill="white"></path>
                                        </svg></a>
                                </div>
                            </div>
                            <!-- 
                            <div class="rs-footer-widget-app">
                                <div class="rs-footer-widget-app-thumb">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/icon/google-play-icon.webp') }}" alt="app">
                                    </a>
                                </div>
                                <div class="rs-footer-widget-app-thumb">
                                    <a href="#">
                                        <img src="{{ asset('assets/images/icon/apple-store-icon.webp') }}" alt="app">
                                    </a>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>

                {{-- Column 2: Top Categories --}}
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-6">
                    <div class="footer-widget footer-1-col-2">
                        <h6 class="footer-widget-title">Top Categories</h6>
                        <div class="footer-widget-link">
                            <ul>
                                @forelse($footerCategories as $category)
                                    <li>
                                        <a href="{{ route('category.show', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @empty
                                    <li><a href="javascript:void(0)">No categories found</a></li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Column 3: Recent Posts --}}
                <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6">
                    <div class="footer-widget footer-1-col-3">
                        <h5 class="footer-widget-title">Recent Post</h5>
                        <div class="footer-widget-content">
                            <div class="rs-post-small rs-post-small-seven">

                                @forelse($footerRecentPosts as $post)
                                    <div class="rs-post-small-item">
                                        <div class="rs-post-small-thumb" style="min-width: 80px; max-width: 65px;">
                                            <a href="{{ route('news.show', $post->slug) }}" class="image-link">
                                                <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                     alt="{{ $post->title }}">
                                            </a>
                                        </div>

                                        <div class="rs-post-small-content">
                                            <h6 class="rs-post-small-title underline is-white">
                                                <a href="{{ route('news.show', $post->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($post->title, 45) }}
                                                </a>
                                            </h6>

                                            <div class="rs-post-meta meta-white">
                                                <ul>
                                                    @if(!empty($post->auther))
                                                    <li>
                                                        <span class="rs-meta">
                                                            By
                                                            <a href="javascript:void(0)" class="meta-author">
                                                                {{ $post->auther }}
                                                            </a>
                                                        </span>
                                                    </li>
                                                    @endif
                                                    <li>
                                                        <span class="rs-meta">
                                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M4.33447 3.8335C4.06114 3.8335 3.83447 3.60683 3.83447 3.3335V1.3335C3.83447 1.06016 4.06114 0.833496 4.33447 0.833496C4.60781 0.833496 4.83447 1.06016 4.83447 1.3335V3.3335C4.83447 3.60683 4.60781 3.8335 4.33447 3.8335ZM9.66781 3.8335C9.39447 3.8335 9.16781 3.60683 9.16781 3.3335V1.3335C9.16781 1.06016 9.39447 0.833496 9.66781 0.833496C9.94114 0.833496 10.1678 1.06016 10.1678 1.3335V3.3335C10.1678 3.60683 9.94114 3.8335 9.66781 3.8335ZM12.6678 6.56016H1.33447C1.06114 6.56016 0.834473 6.3335 0.834473 6.06016C0.834473 5.78683 1.06114 5.56016 1.33447 5.56016H12.6678C12.9411 5.56016 13.1678 5.78683 13.1678 6.06016C13.1678 6.3335 12.9411 6.56016 12.6678 6.56016Z"
                                                                    fill="white"></path>
                                                                <path
                                                                    d="M9.66667 15.1668H4.33333C1.9 15.1668 0.5 13.7668 0.5 11.3335V5.66683C0.5 3.2335 1.9 1.8335 4.33333 1.8335H9.66667C12.1 1.8335 13.5 3.2335 13.5 5.66683V11.3335C13.5 13.7668 12.1 15.1668 9.66667 15.1668ZM4.33333 2.8335C2.42667 2.8335 1.5 3.76016 1.5 5.66683V11.3335C1.5 13.2402 2.42667 14.1668 4.33333 14.1668H9.66667C11.5733 14.1668 12.5 13.2402 12.5 11.3335V5.66683C12.5 3.76016 11.5733 2.8335 9.66667 2.8335H4.33333Z"
                                                                    fill="white"></path>
                                                            </svg>
                                                            <span>{{ optional($post->published_at)->format('F Y') }}</span>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-white">No recent posts found.</p>
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>

                {{-- Column 4: Contact Details --}}
                <div class="col-xxl-4 col-xl-3 col-lg-3 col-md-6">
                    <div class="footer-widget footer-1-col-4">
                        <h5 class="footer-widget-title">Contact Us</h5>
                        <div class="rs-footer-widget-content">
                            <ul class="rs-footer-contact-list" style="list-style: none; padding: 0; margin: 0;">
                                <li
                                    style="display: flex; align-items: flex-start; gap: 12px; margin-bottom: 15px; color: rgba(255,255,255,0.8);">
                                    <i class="ri-map-pin-2-line" style="color: #0d6efd; font-size: 20px; line-height: 1;"></i>
                                    <span style="font-size: 15px; line-height: 1.5;">
                                        35 Bow Road, London, England, E3 2AD

                                    </span>
                                </li>
                
                                <li
                                    style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px; color: rgba(255,255,255,0.8);">
                                    <i class="ri-phone-line" style="color: #0d6efd; font-size: 20px; line-height: 1;"></i>
                                    <a href="tel:+85212345678" style="color: inherit; font-size: 15px; text-decoration: none;">
                                        07974960666
                                    </a>
                                </li>
                
                                <li
                                    style="display: flex; align-items: center; gap: 12px; margin-bottom: 15px; color: rgba(255,255,255,0.8);">
                                    <i class="ri-mail-send-line" style="color: #0d6efd; font-size: 20px; line-height: 1;"></i>
                                    <a href="mailto:info@democracyasia.com"
                                        style="color: inherit; font-size: 15px; text-decoration: none;">
                                        info@democracyasia.com
                                    </a>
                                </li>
                
                                <!-- <li style="display: flex; align-items: center; gap: 12px; color: rgba(255,255,255,0.8);">
                                    <i class="ri-time-line" style="color: #0d6efd; font-size: 20px; line-height: 1;"></i>
                                    <span style="font-size: 15px;">Mon - Fri: 9:00 AM - 6:00 PM</span>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="rs-footer-copyright-area rs-copyright-one">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="rs-footer-copyright-wrapper">
                        <div class="rs-footer-copyright-item">
                            <div class="rs-footer-copyright-link">
                                <a href="{{ url('/terms-conditons') }}">Terms & Agreements</a>
                            </div>
                        </div>

                        <div class="rs-footer-copyright-item">
                            <div class="rs-footer-copyright">
                                <p class="underline">
                                    Copyright © <span id="year">{{ now()->year }}</span> Democracy Asia.
                                    Created by
                                    <a target="_blank" href="https://warrgyizmorsch.com/">Warrgyizmorsch</a>
                                </p>
                            </div>
                        </div>

                        <div class="rs-footer-copyright-item">
                            <div class="rs-footer-copyright-link">
                                <a href="{{ url('/privacy-policy') }}">Privacy policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer area end -->