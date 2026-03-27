<div class="rs-sidebar-wrapper rs-sidebar-sticky">
    <div class="rs-sidebar mb-30">
        <div class="rs-categories rs-categories-one">
            <h5 class="section-title is-small">Explore Categories</h5>
            <ul>
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('category.show', $category->slug) }}" class="rs-categories-bg-thumb"
                            data-background="{{ asset('assets/images/categories/categories-thumb-01.webp') }}">
                            <span class="rs-categories-name">
                                {{ $category->name }} ({{ $category->articles_count }})
                            </span>
                            <span class="rs-categories-btn">
                                <svg width="14" height="10" viewBox="0 0 14 10" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M12.7628 4.24925C10.9324 4.24925 9.26427 2.58258 9.26427 0.750751V0H7.76276V0.750751C7.76276 2.08258 8.34685 3.33183 9.26351 4.24925H0V5.75075H9.26351C8.34685 6.66817 7.76276 7.91742 7.76276 9.24925V10H9.26427V9.24925C9.26427 7.41817 10.9324 5.75075 12.7628 5.75075H13.5135V4.24925H12.7628Z"
                                        fill="white" />
                                </svg>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="rs-sidebar mb-30">
        <div class="rs-post-small rs-post-small-five">
            <h5 class="section-title is-small" style="font-size: 18px; font-weight: 700; margin-bottom: 20px; position: relative; padding-bottom: 10px;">
                Popular News
                <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 2px; background: #0d6efd;"></span>
            </h5>

            @foreach($popularArticles as $popular)
                <div class="rs-post-small-item d-flex align-items-center mb-20 pb-20" style="border-bottom: 1px solid #f1f1f1;">
                    <div class="rs-post-small-thumb" style="flex: 0 0 80px; height: 80px; border-radius: 8px; overflow: hidden; margin-right: 15px;">
                        <a href="{{ route('news.show', $popular->slug) }}" class="image-link h-100">
                            <img src="{{ $popular->featured_image ? asset('storage/' . $popular->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                alt="{{ $popular->title }}" class="w-100 h-100 object-fit-cover">
                        </a>
                    </div>
                    <div class="rs-post-small-content">
                        <h6 class="rs-post-small-title" style="font-size: 15px; font-weight: 700; line-height: 1.4; margin-bottom: 8px;">
                            <a href="{{ route('news.show', $popular->slug) }}" class="text-dark text-decoration-none transition-all" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;" onmouseover="this.style.color='#0d6efd';" onmouseout="this.style.color='#000';">
                                {{ $popular->title }}
                            </a>
                        </h6>

                        <div class="rs-post-meta d-flex align-items-center gap-3" style="font-size: 12px; color: #888;">
                            <span class="rs-meta">By admin</span>
                            <span class="rs-meta d-flex align-items-center">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                {{ number_format($popular->views) }} Views
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="rs-sidebar mb-30">
        <div class="rs-social rs-social-one">
            <h5 class="section-title is-small" style="font-size: 18px; font-weight: 700; margin-bottom: 20px; position: relative; padding-bottom: 10px;">
                Follow Us
                <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 2px; background: #0d6efd;"></span>
            </h5>
            <ul class="rs-social-wrapper" style="list-style: none; padding: 0;">
                <li class="rs-social-item mb-2">
                    <a href="#" class="d-flex align-items-center justify-content-between p-3 text-white text-decoration-none transition-all" style="background: #3b5998; border-radius: 8px;" onmouseover="this.style.opacity='0.9';" onmouseout="this.style.opacity='1';">
                        <span class="d-flex align-items-center">
                            <i class="ri-facebook-fill" style="font-size: 18px; margin-right: 12px;"></i>
                            <span class="fw-bold">Facebook</span>
                        </span>
                        <span style="font-size: 12px; opacity: 0.8;">88.2k Followers</span>
                    </a>
                </li>
                <li class="rs-social-item mb-2">
                    <a href="#" class="d-flex align-items-center justify-content-between p-3 text-white text-decoration-none transition-all" style="background: #000000; border-radius: 8px;" onmouseover="this.style.opacity='0.9';" onmouseout="this.style.opacity='1';">
                        <span class="d-flex align-items-center">
                            <i class="ri-twitter-x-fill" style="font-size: 18px; margin-right: 12px;"></i>
                            <span class="fw-bold">Twitter</span>
                        </span>
                        <span style="font-size: 12px; opacity: 0.8;">48.6k Followers</span>
                    </a>
                </li>
                <li class="rs-social-item mb-2">
                    <a href="#" class="d-flex align-items-center justify-content-between p-3 text-white text-decoration-none transition-all" style="background: #0077b5; border-radius: 8px;" onmouseover="this.style.opacity='0.9';" onmouseout="this.style.opacity='1';">
                        <span class="d-flex align-items-center">
                            <i class="ri-linkedin-fill" style="font-size: 18px; margin-right: 12px;"></i>
                            <span class="fw-bold">LinkedIn</span>
                        </span>
                        <span style="font-size: 12px; opacity: 0.8;">30.3k Followers</span>
                    </a>
                </li>
                <li class="rs-social-item mb-2">
                    <a href="#" class="d-flex align-items-center justify-content-between p-3 text-white text-decoration-none transition-all" style="background: #e1306c; border-radius: 8px;" onmouseover="this.style.opacity='0.9';" onmouseout="this.style.opacity='1';">
                        <span class="d-flex align-items-center">
                            <i class="ri-instagram-line" style="font-size: 18px; margin-right: 12px;"></i>
                            <span class="fw-bold">Instagram</span>
                        </span>
                        <span style="font-size: 12px; opacity: 0.8;">24.5k Followers</span>
                    </a>
                </li>
                <li class="rs-social-item">
                    <a href="#" class="d-flex align-items-center justify-content-between p-3 text-white text-decoration-none transition-all" style="background: #bd081c; border-radius: 8px;" onmouseover="this.style.opacity='0.9';" onmouseout="this.style.opacity='1';">
                        <span class="d-flex align-items-center">
                            <i class="ri-pinterest-fill" style="font-size: 18px; margin-right: 12px;"></i>
                            <span class="fw-bold">Pinterest</span>
                        </span>
                        <span style="font-size: 12px; opacity: 0.8;">28.2k Followers</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="rs-sidebar mb-30">
        <div class="sidebar-widget">
            <h5 class="sidebar-widget-title" style="font-size: 18px; font-weight: 700; margin-bottom: 20px; position: relative; padding-bottom: 10px;">
                Tags
                <span style="position: absolute; bottom: 0; left: 0; width: 40px; height: 2px; background: #0d6efd;"></span>
            </h5>
            <div class="sidebar-widget-content tagcloud has-bg-white d-flex flex-wrap gap-2">
                @forelse($sidebarTags as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}" style="background: #f8f9fa; color: #444; border: 1px solid #eee; padding: 6px 15px; border-radius: 30px; font-size: 13px; text-decoration: none; transition: all 0.3s;" onmouseover="this.style.background='#0d6efd'; this.style.color='#fff'; this.style.border='1px solid #0d6efd';" onmouseout="this.style.background='#f8f9fa'; this.style.color='#444'; this.style.border='1px solid #eee';">{{ $tag->name }}</a>
                @empty
                    <a href="javascript:void(0)" style="background: #f8f9fa; color: #444; border: 1px solid #eee; padding: 6px 15px; border-radius: 30px; font-size: 13px;">News</a>
                @endforelse
            </div>
        </div>
    </div>
    <div class="rs-sidebar rs-ad-banner-one">
        <div class="rs-ad-banner-thumb">
            <a href="contact.html"><img src="{{ asset('assets/images/ad/ad-banner-thumb-03.webp') }}" alt="image"></a>
        </div>
    </div>
</div>