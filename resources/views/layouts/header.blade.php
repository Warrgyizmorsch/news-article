<header>
    <style>
        .header-auth-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
    
        .header-auth-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: var(--rs-title-primary);
            transition: all 0.3s ease;
        }
    
        .header-auth-link:hover {
            color: var(--rs-theme-primary);
        }
    
        .header-subscribe-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 999px;
            background: #10171e;
            color: #fff !important;
            font-size: 14px;
            font-weight: 700;
            line-height: 1;
            transition: all 0.3s ease;
            border: 1px solid #10171e;
        }
    
        .header-subscribe-btn:hover {
            background: transparent;
            color: #10171e !important;
        }
    
        .header-user-dropdown {
            position: relative;
        }
    
        .header-user-toggle {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 999px;
            background: #fff;
            color: #10171e;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
    
        .header-user-toggle:hover {
            border-color: #10171e;
        }
    
        .header-user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #10171e;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
        }
    
        .header-user-menu {
            position: absolute;
            top: calc(100% + 12px);
            right: 0;
            min-width: 220px;
            background: #fff;
            border: 1px solid #ececec;
            border-radius: 16px;
            box-shadow: 0 16px 40px rgba(16, 23, 30, 0.12);
            padding: 10px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(8px);
            transition: all 0.25s ease;
            z-index: 999;
        }
    
        .header-user-dropdown:hover .header-user-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
    
        .header-user-menu a,
        .header-user-menu button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 11px 12px;
            border-radius: 10px;
            background: transparent;
            border: 0;
            text-align: left;
            color: #10171e;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.25s ease;
        }
    
        .header-user-menu a:hover,
        .header-user-menu button:hover {
            background: #f6f7f9;
            color: var(--rs-theme-primary);
        }
    
        .header-user-divider {
            height: 1px;
            background: #ececec;
            margin: 8px 0;
        }
    
        .header-user-name {
            max-width: 110px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    
        @media (max-width: 991px) {
            .header-bottom-wrapper {
                justify-content: center !important;
                text-align: center;
            }
    
            .header-auth-actions {
                justify-content: center;
                width: 100%;
            }
    
            .header-user-menu {
                right: 50%;
                transform: translate(50%, 8px);
            }
    
            .header-user-dropdown:hover .header-user-menu {
                transform: translate(50%, 0);
            }
        }
    </style>

    <div class="rs-header-area rs-header-three">
        <div class="container-fluid g-0">
            <!-- top start -->
            <div class="rs-header-top rs-header-top-one">
                <div class="header-top-left">
                    <div class="header-top-item">
                        <span class="popup-circle">
                        </span>
                        <p class="header-top-title">Live News</p>
                    </div>
                    <div class="header-top-content">
                        @forelse($headerBreakingNews as $index => $news)
                            <p class="header-top-description {{ $index === 0 ? 'is-active' : '' }}">
                                <a href="{{ route('news.show', $news->slug) }}">
                                    {{ $news->title }}
                                </a>
                            </p>
                        @empty
                            <p class="header-top-description is-active">
                                Stay updated with the latest headlines.
                            </p>
                        @endforelse
                    </div>
                </div>
                <div class="header-top-right">
                    <div class="header-top-meta">
                        <span class="header-top-meta-icon">
                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4.33447 3.8335C4.06114 3.8335 3.83447 3.60683 3.83447 3.3335V1.3335C3.83447 1.06016 4.06114 0.833496 4.33447 0.833496C4.60781 0.833496 4.83447 1.06016 4.83447 1.3335V3.3335C4.83447 3.60683 4.60781 3.8335 4.33447 3.8335ZM9.66781 3.8335C9.39447 3.8335 9.16781 3.60683 9.16781 3.3335V1.3335C9.16781 1.06016 9.39447 0.833496 9.66781 0.833496C9.94114 0.833496 10.1678 1.06016 10.1678 1.3335V3.3335C10.1678 3.60683 9.94114 3.8335 9.66781 3.8335ZM4.66781 9.66683C4.58114 9.66683 4.49447 9.64683 4.41447 9.6135C4.32781 9.58016 4.26114 9.5335 4.19447 9.4735C4.07447 9.34683 4.00114 9.18016 4.00114 9.00016C4.00114 8.9135 4.02114 8.82683 4.05447 8.74683C4.08781 8.66683 4.13447 8.5935 4.19447 8.52683C4.26114 8.46683 4.32781 8.42016 4.41447 8.38683C4.65447 8.28683 4.95447 8.34016 5.14114 8.52683C5.26114 8.6535 5.33447 8.82683 5.33447 9.00016C5.33447 9.04016 5.32781 9.08683 5.32114 9.1335C5.31447 9.1735 5.30114 9.2135 5.28114 9.2535C5.26781 9.2935 5.24781 9.3335 5.22114 9.3735C5.20114 9.40683 5.16781 9.44016 5.14114 9.4735C5.01447 9.5935 4.84114 9.66683 4.66781 9.66683ZM7.00114 9.66683C6.91447 9.66683 6.82781 9.64683 6.74781 9.6135C6.66114 9.58016 6.59447 9.5335 6.52781 9.4735C6.40781 9.34683 6.33447 9.18016 6.33447 9.00016C6.33447 8.9135 6.35447 8.82683 6.38781 8.74683C6.42114 8.66683 6.46781 8.5935 6.52781 8.52683C6.59447 8.46683 6.66114 8.42016 6.74781 8.38683C6.98781 8.28016 7.28781 8.34016 7.47447 8.52683C7.59447 8.6535 7.66781 8.82683 7.66781 9.00016C7.66781 9.04016 7.66114 9.08683 7.65447 9.1335C7.64781 9.1735 7.63447 9.2135 7.61447 9.2535C7.60114 9.2935 7.58114 9.3335 7.55447 9.3735C7.53447 9.40683 7.50114 9.44016 7.47447 9.4735C7.34781 9.5935 7.17447 9.66683 7.00114 9.66683ZM9.33447 9.66683C9.24781 9.66683 9.16114 9.64683 9.08114 9.6135C8.99447 9.58016 8.92781 9.5335 8.86114 9.4735L8.78114 9.3735C8.75589 9.33635 8.73571 9.29599 8.72114 9.2535C8.70188 9.21572 8.6884 9.17527 8.68114 9.1335C8.67447 9.08683 8.66781 9.04016 8.66781 9.00016C8.66781 8.82683 8.74114 8.6535 8.86114 8.52683C8.92781 8.46683 8.99447 8.42016 9.08114 8.38683C9.32781 8.28016 9.62114 8.34016 9.80781 8.52683C9.92781 8.6535 10.0011 8.82683 10.0011 9.00016C10.0011 9.04016 9.99447 9.08683 9.98781 9.1335C9.98114 9.1735 9.96781 9.2135 9.94781 9.2535C9.93447 9.2935 9.91447 9.3335 9.88781 9.3735C9.86781 9.40683 9.83447 9.44016 9.80781 9.4735C9.68114 9.5935 9.50781 9.66683 9.33447 9.66683ZM4.66781 12.0002C4.58114 12.0002 4.49447 11.9802 4.41447 11.9468C4.33447 11.9135 4.26114 11.8668 4.19447 11.8068C4.07447 11.6802 4.00114 11.5068 4.00114 11.3335C4.00114 11.2468 4.02114 11.1602 4.05447 11.0802C4.08781 10.9935 4.13447 10.9202 4.19447 10.8602C4.44114 10.6135 4.89447 10.6135 5.14114 10.8602C5.26114 10.9868 5.33447 11.1602 5.33447 11.3335C5.33447 11.5068 5.26114 11.6802 5.14114 11.8068C5.01447 11.9268 4.84114 12.0002 4.66781 12.0002ZM7.00114 12.0002C6.82781 12.0002 6.65447 11.9268 6.52781 11.8068C6.40781 11.6802 6.33447 11.5068 6.33447 11.3335C6.33447 11.2468 6.35447 11.1602 6.38781 11.0802C6.42114 10.9935 6.46781 10.9202 6.52781 10.8602C6.77447 10.6135 7.22781 10.6135 7.47447 10.8602C7.53447 10.9202 7.58114 10.9935 7.61447 11.0802C7.64781 11.1602 7.66781 11.2468 7.66781 11.3335C7.66781 11.5068 7.59447 11.6802 7.47447 11.8068C7.34781 11.9268 7.17447 12.0002 7.00114 12.0002ZM9.33447 12.0002C9.16114 12.0002 8.98781 11.9268 8.86114 11.8068C8.79945 11.7442 8.75174 11.6692 8.72114 11.5868C8.68781 11.5068 8.66781 11.4202 8.66781 11.3335C8.66781 11.2468 8.68781 11.1602 8.72114 11.0802C8.75447 10.9935 8.80114 10.9202 8.86114 10.8602C9.01447 10.7068 9.24781 10.6335 9.46114 10.6802C9.50781 10.6868 9.54781 10.7002 9.58781 10.7202C9.62781 10.7335 9.66781 10.7535 9.70781 10.7802C9.74114 10.8002 9.77447 10.8335 9.80781 10.8602C9.92781 10.9868 10.0011 11.1602 10.0011 11.3335C10.0011 11.5068 9.92781 11.6802 9.80781 11.8068C9.68114 11.9268 9.50781 12.0002 9.33447 12.0002ZM12.6678 6.56016H1.33447C1.06114 6.56016 0.834473 6.3335 0.834473 6.06016C0.834473 5.78683 1.06114 5.56016 1.33447 5.56016H12.6678C12.9411 5.56016 13.1678 5.78683 13.1678 6.06016C13.1678 6.3335 12.9411 6.56016 12.6678 6.56016Z"
                                    fill="white" />
                                <path
                                    d="M9.66667 15.1668H4.33333C1.9 15.1668 0.5 13.7668 0.5 11.3335V5.66683C0.5 3.2335 1.9 1.8335 4.33333 1.8335H9.66667C12.1 1.8335 13.5 3.2335 13.5 5.66683V11.3335C13.5 13.7668 12.1 15.1668 9.66667 15.1668ZM4.33333 2.8335C2.42667 2.8335 1.5 3.76016 1.5 5.66683V11.3335C1.5 13.2402 2.42667 14.1668 4.33333 14.1668H9.66667C11.5733 14.1668 12.5 13.2402 12.5 11.3335V5.66683C12.5 3.76016 11.5733 2.8335 9.66667 2.8335H4.33333Z"
                                    fill="white" />
                            </svg>
                        </span>
                        <p class="header-top-meta-title">{{ strtoupper(now()->format('F d, Y')) }}</p>
                    </div>
                    <div class="header-top-social-wrapper">
                        <h6 class="header-top-social-title"> Follow Us:</h6>
                        <div class="header-top-social theme-social has-transparent">
                            <a href="#"><i class="ri-facebook-fill"></i></a>
                            <a href="#"> <i class="ri-instagram-line"></i></a>
                            <a href="#"><i class="ri-linkedin-fill"></i></a>
                            <a href="#"><i class="ri-twitter-x-line"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- top end -->
            <!-- header bottom start -->
            <div class="header-bottom-wrapper"
                style="display:flex; align-items:center; justify-content:space-between; gap:20px; flex-wrap:wrap;">
            
                <div class="header-logo">
                    <a class="logo-black" href="{{ route('home') }}">
                        <img src="{{ asset('assets/images/logo/democracy-asia-logo.webp') }}" alt="logo">
                    </a>
                </div>
            
                <div class="header-auth-actions">
                    @guest
                        <a href="{{ route('login') }}" class="header-auth-link">
                            <i class="ri-login-circle-line"></i>
                            <span>Login</span>
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="header-auth-link">
                                <i class="ri-user-add-line"></i>
                                <span>Register</span>
                            </a>
                        @endif

                        <a href="{{ route('frontend.plans.index') }}" class="header-subscribe-btn">
                            <i class="ri-vip-crown-2-line"></i>
                            <span>Subscribe</span>
                        </a>
                    @endguest
            
                    @auth
                        @if(auth()->user()->role !== 'admin')
                            <a href="{{ route('frontend.plans.index') }}" class="header-subscribe-btn">
                                <i class="ri-vip-crown-2-line"></i>
                                <span>Subscribe</span>
                            </a>
                        @endif

                        <div class="header-user-dropdown">
                            <button type="button" class="header-user-toggle">
                                <span class="header-user-avatar">
                                    {{ \Illuminate\Support\Str::substr(auth()->user()->name, 0, 1) }}
                                </span>
                                <span class="header-user-name">{{ auth()->user()->name }}</span>
                                <i class="ri-arrow-down-s-line"></i>
                            </button>

                            <div class="header-user-menu">
                                <a href="{{ route('profile.edit') }}">
                                    <i class="ri-user-3-line"></i>
                                    <span>My Profile</span>
                                </a>

                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('dashboard') }}">
                                        <i class="ri-layout-grid-line"></i>
                                        <span>Dashboard</span>
                                    </a>
                                @endif

                                @if(auth()->user()->role !== 'admin')
                                    <a href="{{ route('frontend.plans.index') }}">
                                        <i class="ri-vip-crown-line"></i>
                                        <span>Manage Subscription</span>
                                    </a>
                                @endif

                                <div class="header-user-divider"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit">
                                        <i class="ri-logout-box-r-line"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
            <!-- header bottom end -->
            <div id="rs-sticky-header" class="header-wrapper rs-sticky-header">
                <div class="row align-items-center">
                    <div class="col-xl-5">
                        <div class="header-menu">
                            <nav id="mobile-menu" class="main-menu">
                                <ul class="multipage-menu">
                                    <!-- home -->
                                    <li>
                                        <a href="/">Home</a>
                                    </li>
                                    <!-- news menu -->
                                    <li class="rs-mega-menu menu-item-has-children is-text-white">
                                        <a href="javascript:void(0)">News</a>
                                        <ul class="mega-menu mega-grid">
                                            <li class="rs-mega-menu-left">
                                                <h6 class="mega-menu-title">
                                                    <a
                                                        href="{{ $headerMegaFeaturedNews ? route('news.show', $headerMegaFeaturedNews->slug) : 'javascript:void(0)' }}">
                                                        News
                                                    </a>
                                                </h6>

                                                @if($headerMegaFeaturedNews)
                                                    <div class="rs-post-medium rs-post-medium-two">
                                                        <div class="rs-post-medium-item">
                                                            <div class="rs-post-medium-thumb">
                                                                <a href="{{ route('news.show', $headerMegaFeaturedNews->slug) }}"
                                                                    class="image-link" style="height: 120px;">
                                                                    <img src="{{ $headerMegaFeaturedNews->featured_image ? asset('storage/' . $headerMegaFeaturedNews->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                                        alt="{{ $headerMegaFeaturedNews->title }}" style="height: 100%; width: 100%; object-fit: cover;">
                                                                </a>
                                                            </div>
                                                            <div class="rs-post-medium-content">
                                                                <p class="rs-description">
                                                                    {{ \Illuminate\Support\Str::limit($headerMegaFeaturedNews->excerpt ?: $headerMegaFeaturedNews->title, 100) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="rs-post-medium rs-post-medium-two">
                                                        <div class="rs-post-medium-item">
                                                            <div class="rs-post-medium-content">
                                                                <p class="rs-description">No featured news available right
                                                                    now.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </li>
                                            <li class="rs-mega-menu-right">
                                                <div class="rs-mega-menu-list">
                                                    <div class="rs-mega-menu-list-item">
                                                        <h6 class="mega-menu-title">Latest News</h6>
                                                        <div class="rs-menu-post-small">
                                                            @forelse($headerMegaLatestNews as $post)
                                                                <div class="rs-post-small rs-post-small-eight">
                                                                    <div class="rs-post-small-thumb">
                                                                        <a href="{{ route('news.show', $post->slug) }}"
                                                                            class="image-link">
                                                                            <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                                                alt="{{ $post->title }}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="rs-post-small-content">
                                                                        <div class="rs-post-tag">
                                                                            <a href="{{ $post->category ? route('category.show', $post->category->slug) : 'javascript:void(0)' }}"
                                                                                class="post-tag">
                                                                                {{ $post->category->name ?? 'News' }}
                                                                            </a>
                                                                        </div>
                                                                        <h6 class="rs-post-small-title underline">
                                                                            <a href="{{ route('news.show', $post->slug) }}">
                                                                                {{ \Illuminate\Support\Str::limit($post->title, 35) }}
                                                                            </a>
                                                                        </h6>
                                                                        <div class="rs-post-meta">
                                                                            <ul>
                                                                                <li>
                                                                                    <span class="rs-meta">
                                                                                        By
                                                                                        <a href="javascript:void(0)"
                                                                                            class="meta-author">
                                                                                            {{ $post->author->name ?? 'Admin' }}
                                                                                        </a>
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="rs-meta">
                                                                                        <svg width="10" height="8"
                                                                                            viewBox="0 0 10 8" fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M6.165 8.00011H6.06C5.84838 7.97911 5.64896 7.8912 5.49071 7.74913C5.33246 7.60707 5.22362 7.41825 5.18 7.21011L3.84 1.00011L2.46 4.20011C2.42097 4.28955 2.35661 4.36561 2.27487 4.41892C2.19314 4.47223 2.09758 4.50045 2 4.50011H0.5C0.367392 4.50011 0.240215 4.44743 0.146447 4.35367C0.0526784 4.2599 0 4.13272 0 4.00011C0 3.8675 0.0526784 3.74033 0.146447 3.64656C0.240215 3.55279 0.367392 3.50011 0.5 3.50011H1.67L2.925 0.605113C3.00948 0.410844 3.15348 0.248423 3.33622 0.141268C3.51896 0.0341136 3.73102 -0.0122382 3.9418 0.0088961C4.15259 0.0300304 4.35122 0.117559 4.50905 0.258861C4.66689 0.400163 4.77577 0.587939 4.82 0.795113L6.16 7.00011L7.54 3.81011C7.57751 3.7188 7.64121 3.64064 7.72307 3.58547C7.80493 3.53031 7.90129 3.50061 8 3.50011H9.5C9.63261 3.50011 9.75979 3.55279 9.85355 3.64656C9.94732 3.74033 10 3.8675 10 4.00011C10 4.13272 9.94732 4.2599 9.85355 4.35367C9.75979 4.44743 9.63261 4.50011 9.5 4.50011H8.33L7.075 7.39511C6.99836 7.57337 6.87153 7.72548 6.70995 7.8329C6.54837 7.94033 6.35902 7.99843 6.165 8.00011Z"
                                                                                                fill="white" />
                                                                                        </svg>
                                                                                        <span>{{ number_format($post->views ?? 0) }}
                                                                                            Views</span>
                                                                                    </span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <p>No latest news found.</p>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                    <div class="rs-mega-menu-list-item">
                                                        <h6 class="mega-menu-title">Breaking News</h6>
                                                        <div class="rs-menu-post-small">
                                                            @forelse($headerMegaBreakingNews as $post)
                                                                <div class="rs-post-small rs-post-small-eight">
                                                                    <div class="rs-post-small-thumb">
                                                                        <a href="{{ route('news.show', $post->slug) }}" class="image-link">
                                                                            <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                                                alt="{{ $post->title }}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="rs-post-small-content">
                                                                        <div class="rs-post-tag">
                                                                            <a href="{{ $post->category ? route('category.show', $post->category->slug) : 'javascript:void(0)' }}"
                                                                                class="post-tag is-pink">
                                                                                {{ $post->category->name ?? 'Breaking' }}
                                                                            </a>
                                                                        </div>
                                                                        <h6 class="rs-post-small-title underline">
                                                                            <a href="{{ route('news.show', $post->slug) }}">
                                                                                {{ \Illuminate\Support\Str::limit($post->title, 35) }}
                                                                            </a>
                                                                        </h6>
                                                                        <div class="rs-post-meta">
                                                                            <ul>
                                                                                <li>
                                                                                    <span class="rs-meta">
                                                                                        By
                                                                                        <a href="javascript:void(0)" class="meta-author">
                                                                                            {{ $post->author->name ?? 'Admin' }}
                                                                                        </a>
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="rs-meta">
                                                                                        <svg width="10" height="8" viewBox="0 0 10 8" fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M6.165 8.00011H6.06C5.84838 7.97911 5.64896 7.8912 5.49071 7.74913C5.33246 7.60707 5.22362 7.41825 5.18 7.21011L3.84 1.00011L2.46 4.20011C2.42097 4.28955 2.35661 4.36561 2.27487 4.41892C2.19314 4.47223 2.09758 4.50045 2 4.50011H0.5C0.367392 4.50011 0.240215 4.44743 0.146447 4.35367C0.0526784 4.2599 0 4.13272 0 4.00011C0 3.8675 0.0526784 3.74033 0.146447 3.64656C0.240215 3.55279 0.367392 3.50011 0.5 3.50011H1.67L2.925 0.605113C3.00948 0.410844 3.15348 0.248423 3.33622 0.141268C3.51896 0.0341136 3.73102 -0.0122382 3.9418 0.0088961C4.15259 0.0300304 4.35122 0.117559 4.50905 0.258861C4.66689 0.400163 4.77577 0.587939 4.82 0.795113L6.16 7.00011L7.54 3.81011C7.57751 3.7188 7.64121 3.64064 7.72307 3.58547C7.80493 3.53031 7.90129 3.50061 8 3.50011H9.5C9.63261 3.50011 9.75979 3.55279 9.85355 3.64656C9.94732 3.74033 10 3.8675 10 4.00011C10 4.13272 9.94732 4.2599 9.85355 4.35367C9.75979 4.44743 9.63261 4.50011 9.5 4.50011H8.33L7.075 7.39511C6.99836 7.57337 6.87153 7.72548 6.70995 7.8329C6.54837 7.94033 6.35902 7.99843 6.165 8.00011Z"
                                                                                                fill="white" />
                                                                                        </svg>
                                                                                        <span>{{ number_format($post->views ?? 0) }} Views</span>
                                                                                    </span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <p>No breaking news found.</p>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- services menu -->
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0)">Categories</a>
                                        <ul class="submenu last-children">
                                            @forelse($headerCategories as $category)
                                                <li>
                                                    <a href="{{ route('category.show', $category->slug) }}">
                                                        {{ $category->name }}
                                                    </a>
                                                </li>
                                            @empty
                                                <li>
                                                    <a href="javascript:void(0)">No Categories Found</a>
                                                </li>
                                            @endforelse
                                        </ul>
                                    </li>
                                    <!-- contact menu -->
                                    <li>
                                        <a href="/contact-us">Contact</a>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="header-right">
                            <div class="swiper header-menu-slide">
                                <div class="swiper-wrapper">
                                    @forelse($headerTrendingTags as $tag)
                                        <div class="swiper-slide">
                                            <div class="header-top-tag">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('tag.show', $tag->slug) }}">
                                                            #{{ $tag->name }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="swiper-slide">
                                            <div class="header-top-tag">
                                                <ul>
                                                    <li><a href="javascript:void(0)">#News</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="header-navigation">
                                <button class="slider-button-prev"><i class="ri-arrow-left-s-line"></i></button>
                                <button class="slider-button-next"><i class="ri-arrow-right-s-line"></i></button>
                            </div>

                            <!-- hamburger start -->
                            <div class="header-toggle">
                                <div class="header-hamburger">
                                    <div class="sidebar-toggle">
                                        <a class="header-bar-icon" href="javascript:void(0)">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- hamburger end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->

<!-- header area two start -->
<header>
    <div class="rs-header-area rs-header-three">
        <div class="container-fluid g-0">
            <div class="header-wrapper">
                <div class="row align-items-center">
                    <div class="col-xl-5">
                        <div class="header-menu">
                            <nav id="mobile-menu-two" class="main-menu">
                                <ul class="multipage-menu">
                                    <!-- home -->
                                    <li>
                                        <a href="/">Home</a>
                                    </li>
                                    <!-- news menu -->
                                    <li class="rs-mega-menu menu-item-has-children is-text-white">
                                        <a href="javascript:void(0)">News</a>
                                        <ul class="mega-menu mega-grid">
                                            <li class="rs-mega-menu-left">
                                                <h6 class="mega-menu-title">
                                                    <a
                                                        href="{{ $headerMegaFeaturedNews ? route('news.show', $headerMegaFeaturedNews->slug) : 'javascript:void(0)' }}">
                                                        News
                                                    </a>
                                                </h6>

                                                @if($headerMegaFeaturedNews)
                                                    <div class="rs-post-medium rs-post-medium-two">
                                                        <div class="rs-post-medium-item">
                                                            <div class="rs-post-medium-thumb">
                                                                <a href="{{ route('news.show', $headerMegaFeaturedNews->slug) }}"
                                                                    class="image-link" style="height: 120px;">
                                                                    <img src="{{ $headerMegaFeaturedNews->featured_image ? asset('storage/' . $headerMegaFeaturedNews->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                                        alt="{{ $headerMegaFeaturedNews->title }}" style="height: 100%; width: 100%; object-fit: cover">
                                                                </a>
                                                            </div>
                                                            <div class="rs-post-medium-content">
                                                                <p class="rs-description">
                                                                    {{ \Illuminate\Support\Str::limit($headerMegaFeaturedNews->excerpt ?: $headerMegaFeaturedNews->title, 100) }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="rs-post-medium rs-post-medium-two">
                                                        <div class="rs-post-medium-item">
                                                            <div class="rs-post-medium-content">
                                                                <p class="rs-description">No featured news available right
                                                                    now.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </li>
                                            <li class="rs-mega-menu-right">
                                                <div class="rs-mega-menu-list">
                                                    <div class="rs-mega-menu-list-item">
                                                        <h6 class="mega-menu-title">Latest News</h6>
                                                        <div class="rs-menu-post-small">
                                                            @forelse($headerMegaLatestNews as $post)
                                                                <div class="rs-post-small rs-post-small-eight">
                                                                    <div class="rs-post-small-thumb">
                                                                        <a href="{{ route('news.show', $post->slug) }}"
                                                                            class="image-link">
                                                                            <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                                                alt="{{ $post->title }}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="rs-post-small-content">
                                                                        <div class="rs-post-tag">
                                                                            <a href="{{ $post->category ? route('category.show', $post->category->slug) : 'javascript:void(0)' }}"
                                                                                class="post-tag">
                                                                                {{ $post->category->name ?? 'News' }}
                                                                            </a>
                                                                        </div>
                                                                        <h6 class="rs-post-small-title underline">
                                                                            <a href="{{ route('news.show', $post->slug) }}">
                                                                                {{ \Illuminate\Support\Str::limit($post->title, 35) }}
                                                                            </a>
                                                                        </h6>
                                                                        <div class="rs-post-meta">
                                                                            <ul>
                                                                                <li>
                                                                                    <span class="rs-meta">
                                                                                        By
                                                                                        <a href="javascript:void(0)"
                                                                                            class="meta-author">
                                                                                            {{ $post->author->name ?? 'Admin' }}
                                                                                        </a>
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="rs-meta">
                                                                                        <svg width="10" height="8"
                                                                                            viewBox="0 0 10 8" fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M6.165 8.00011H6.06C5.84838 7.97911 5.64896 7.8912 5.49071 7.74913C5.33246 7.60707 5.22362 7.41825 5.18 7.21011L3.84 1.00011L2.46 4.20011C2.42097 4.28955 2.35661 4.36561 2.27487 4.41892C2.19314 4.47223 2.09758 4.50045 2 4.50011H0.5C0.367392 4.50011 0.240215 4.44743 0.146447 4.35367C0.0526784 4.2599 0 4.13272 0 4.00011C0 3.8675 0.0526784 3.74033 0.146447 3.64656C0.240215 3.55279 0.367392 3.50011 0.5 3.50011H1.67L2.925 0.605113C3.00948 0.410844 3.15348 0.248423 3.33622 0.141268C3.51896 0.0341136 3.73102 -0.0122382 3.9418 0.0088961C4.15259 0.0300304 4.35122 0.117559 4.50905 0.258861C4.66689 0.400163 4.77577 0.587939 4.82 0.795113L6.16 7.00011L7.54 3.81011C7.57751 3.7188 7.64121 3.64064 7.72307 3.58547C7.80493 3.53031 7.90129 3.50061 8 3.50011H9.5C9.63261 3.50011 9.75979 3.55279 9.85355 3.64656C9.94732 3.74033 10 3.8675 10 4.00011C10 4.13272 9.94732 4.2599 9.85355 4.35367C9.75979 4.44743 9.63261 4.50011 9.5 4.50011H8.33L7.075 7.39511C6.99836 7.57337 6.87153 7.72548 6.70995 7.8329C6.54837 7.94033 6.35902 7.99843 6.165 8.00011Z"
                                                                                                fill="white" />
                                                                                        </svg>
                                                                                        <span>{{ number_format($post->views ?? 0) }}
                                                                                            Views</span>
                                                                                    </span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <p>No latest news found.</p>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                    <div class="rs-mega-menu-list-item">
                                                        <h6 class="mega-menu-title">Breaking News</h6>
                                                        <div class="rs-menu-post-small">
                                                            @forelse($headerMegaBreakingNews as $post)
                                                                <div class="rs-post-small rs-post-small-eight">
                                                                    <div class="rs-post-small-thumb">
                                                                        <a href="{{ route('news.show', $post->slug) }}" class="image-link">
                                                                            <img src="{{ $post->featured_image ? asset('storage/' . $post->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                                                alt="{{ $post->title }}">
                                                                        </a>
                                                                    </div>
                                                                    <div class="rs-post-small-content">
                                                                        <div class="rs-post-tag">
                                                                            <a href="{{ $post->category ? route('category.show', $post->category->slug) : 'javascript:void(0)' }}"
                                                                                class="post-tag is-pink">
                                                                                {{ $post->category->name ?? 'Breaking' }}
                                                                            </a>
                                                                        </div>
                                                                        <h6 class="rs-post-small-title underline">
                                                                            <a href="{{ route('news.show', $post->slug) }}">
                                                                                {{ \Illuminate\Support\Str::limit($post->title, 35) }}
                                                                            </a>
                                                                        </h6>
                                                                        <div class="rs-post-meta">
                                                                            <ul>
                                                                                <li>
                                                                                    <span class="rs-meta">
                                                                                        By
                                                                                        <a href="javascript:void(0)" class="meta-author">
                                                                                            {{ $post->author->name ?? 'Admin' }}
                                                                                        </a>
                                                                                    </span>
                                                                                </li>
                                                                                <li>
                                                                                    <span class="rs-meta">
                                                                                        <svg width="10" height="8" viewBox="0 0 10 8" fill="none"
                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                            <path
                                                                                                d="M6.165 8.00011H6.06C5.84838 7.97911 5.64896 7.8912 5.49071 7.74913C5.33246 7.60707 5.22362 7.41825 5.18 7.21011L3.84 1.00011L2.46 4.20011C2.42097 4.28955 2.35661 4.36561 2.27487 4.41892C2.19314 4.47223 2.09758 4.50045 2 4.50011H0.5C0.367392 4.50011 0.240215 4.44743 0.146447 4.35367C0.0526784 4.2599 0 4.13272 0 4.00011C0 3.8675 0.0526784 3.74033 0.146447 3.64656C0.240215 3.55279 0.367392 3.50011 0.5 3.50011H1.67L2.925 0.605113C3.00948 0.410844 3.15348 0.248423 3.33622 0.141268C3.51896 0.0341136 3.73102 -0.0122382 3.9418 0.0088961C4.15259 0.0300304 4.35122 0.117559 4.50905 0.258861C4.66689 0.400163 4.77577 0.587939 4.82 0.795113L6.16 7.00011L7.54 3.81011C7.57751 3.7188 7.64121 3.64064 7.72307 3.58547C7.80493 3.53031 7.90129 3.50061 8 3.50011H9.5C9.63261 3.50011 9.75979 3.55279 9.85355 3.64656C9.94732 3.74033 10 3.8675 10 4.00011C10 4.13272 9.94732 4.2599 9.85355 4.35367C9.75979 4.44743 9.63261 4.50011 9.5 4.50011H8.33L7.075 7.39511C6.99836 7.57337 6.87153 7.72548 6.70995 7.8329C6.54837 7.94033 6.35902 7.99843 6.165 8.00011Z"
                                                                                                fill="white" />
                                                                                        </svg>
                                                                                        <span>{{ number_format($post->views ?? 0) }} Views</span>
                                                                                    </span>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @empty
                                                                <p>No breaking news found.</p>
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- services menu -->
                                    <li class="menu-item-has-children">
                                        <a href="javascript:void(0)">Categories</a>
                                        <ul class="submenu last-children">
                                            @forelse($headerCategories as $category)
                                                <li>
                                                    <a href="{{ route('category.show', $category->slug) }}">
                                                        {{ $category->name }}
                                                    </a>
                                                </li>
                                            @empty
                                                <li>
                                                    <a href="javascript:void(0)">No Categories Found</a>
                                                </li>
                                            @endforelse
                                        </ul>
                                    </li>
                                    <!-- contact menu -->
                                    <li>
                                        <a href="/contact-us">Contact</a>
                                    </li>

                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-xl-7">
                        <div class="header-right">
                            <div class="swiper header-menu-slide">
                                <div class="swiper-wrapper">
                                    @forelse($headerTrendingTags as $tag)
                                        <div class="swiper-slide">
                                            <div class="header-top-tag">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('tag.show', $tag->slug) }}">
                                                            #{{ $tag->name }}
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="swiper-slide">
                                            <div class="header-top-tag">
                                                <ul>
                                                    <li><a href="javascript:void(0)">#News</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="header-navigation">
                                <button class="slider-button-prev"><i class="ri-arrow-left-s-line"></i></button>
                                <button class="slider-button-next"><i class="ri-arrow-right-s-line"></i></button>
                            </div>

                            <!-- hamburger start -->
                            <div class="header-toggle">
                                <div class="header-hamburger">
                                    <div class="sidebar-toggle">
                                        <a class="header-bar-icon" href="javascript:void(0)">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- hamburger end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area two end -->

<!-- Offcanvas area start -->
<div class="fix">
    <div class="offcanvas-area" data-lenis-prevent>
        <div class="offcanvas-wrapper">
            <div class="offcanvas-content">
                <div class="offcanvas-top d-flex justify-content-between align-items-center mb-20">
                    <div class="offcanvas-logo">
                        <a class="logo-black" href="index.html"><img
                                src="{{ asset('assets/images/logo/democracy-asia-logo.webp') }}" alt="logo"></a>
                    </div>
                    <div class="offcanvas-close">
                        <button class="offcanvas-close-icon animation--flip">
                            <span class="offcanvas-m-lines">
                                <span class="offcanvas-m-line line--1"></span><span
                                    class="offcanvas-m-line line--2"></span><span
                                    class="offcanvas-m-line line--3"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="offcanvas-about mb-30 d-none d-xl-block">
                    <p> Democracy Asia News Magazine brings you trusted timely and thought-provoking stories from around the
                        globe.
                    </p>
                </div>
                <div class="mobile-menu">
                    <div class="rs-offcanvas-menu mb-30">
                        <nav></nav>
                    </div>
                </div>

                <div class="offcanvas-auth mb-30">
    @guest
        <div style="display:flex; flex-direction:column; gap:12px;">
            <a href="{{ route('login') }}" class="header-auth-link">
                <i class="ri-login-circle-line"></i>
                <span>Login</span>
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="header-auth-link">
                    <i class="ri-user-add-line"></i>
                    <span>Register</span>
                </a>
            @endif

            <a href="{{ route('frontend.plans.index') }}" class="header-subscribe-btn"
                style="width:100%; justify-content:center;">
                <i class="ri-vip-crown-2-line"></i>
                <span>Subscribe</span>
            </a>
        </div>
    @endguest

    @auth
        <div style="display:flex; flex-direction:column; gap:12px;">
            <div class="d-flex align-items-center gap-10">
                <span class="header-user-avatar">
                    {{ \Illuminate\Support\Str::substr(auth()->user()->name, 0, 1) }}
                </span>
                <div>
                    <strong>{{ auth()->user()->name }}</strong>
                    <div style="font-size:13px; color:#6d6d6d;">{{ auth()->user()->email }}</div>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="header-auth-link">
                <i class="ri-user-3-line"></i>
                <span>My Profile</span>
            </a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="header-auth-link">
                    <i class="ri-layout-grid-line"></i>
                    <span>Dashboard</span>
                </a>
            @endif

            @if(auth()->user()->role !== 'admin')
                <a href="{{ route('frontend.plans.index') }}" class="header-subscribe-btn"
                    style="width:100%; justify-content:center;">
                    <i class="ri-vip-crown-2-line"></i>
                    <span>Subscribe</span>
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="header-auth-link" style="border:0; background:none; padding:0;">
                    <i class="ri-logout-box-r-line"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    @endauth
</div>

                <div class="offcanvas-contact mb-30">
                    <h4 class="offcanvas-title-meta">Contact Info</h4>
                    <ul>
                        <li class="d-flex gap-15">
                            <div class="offcanvas-contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="18" viewBox="0 0 14 18"
                                    fill="none">
                                    <path
                                        d="M11.8768 9.68475C11.3059 10.835 10.5331 11.9818 9.74128 13.0109C8.95198 14.0368 8.15999 14.9249 7.5643 15.5572C7.48514 15.6412 7.40956 15.7206 7.33802 15.7951C7.26648 15.7206 7.1909 15.6412 7.11174 15.5572C6.51605 14.9249 5.72406 14.0368 4.93476 13.0109C4.14299 11.9818 3.37019 10.835 2.79925 9.68475C2.22242 8.52266 1.89032 7.43373 1.89032 6.5C1.89032 3.50846 4.32934 1.08333 7.33802 1.08333C10.3467 1.08333 12.7857 3.50846 12.7857 6.5C12.7857 7.43373 12.4536 8.52266 11.8768 9.68475ZM7.33802 17.3333C7.33802 17.3333 13.8753 11.1732 13.8753 6.5C13.8753 2.91015 10.9484 0 7.33802 0C3.7276 0 0.800781 2.91015 0.800781 6.5C0.800781 11.1732 7.33802 17.3333 7.33802 17.3333Z"
                                        fill="#6D6D6D"></path>
                                    <path
                                        d="M7.33802 8.66667C6.13455 8.66667 5.15894 7.69662 5.15894 6.5C5.15894 5.30338 6.13455 4.33333 7.33802 4.33333C8.54149 4.33333 9.5171 5.30338 9.5171 6.5C9.5171 7.69662 8.54149 8.66667 7.33802 8.66667ZM7.33802 9.75C9.14323 9.75 10.6066 8.29492 10.6066 6.5C10.6066 4.70507 9.14323 3.25 7.33802 3.25C5.53281 3.25 4.0694 4.70507 4.0694 6.5C4.0694 8.29492 5.53281 9.75 7.33802 9.75Z"
                                        fill="#6D6D6D"></path>
                                </svg>
                            </div>
                            <div class="offcanvas-contact-text">
                                <a href="#"> 374 William S Canning Blvd, Fall River MA Road 2721, USA</a>
                            </div>
                        </li>
                        <li class="d-flex gap-15">
                            <div class="offcanvas-contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="none">
                                    <path
                                        d="M3.65387 1.32849C3.40343 1.00649 2.92745 0.976861 2.639 1.26531L1.60508 2.29923C1.1216 2.78271 0.94387 3.46766 1.1551 4.06847C2.00338 6.48124 3.39215 8.74671 5.32272 10.6773C7.25329 12.6078 9.51876 13.9966 11.9315 14.8449C12.5323 15.0561 13.2173 14.8784 13.7008 14.3949L14.7347 13.361C15.0231 13.0726 14.9935 12.5966 14.6715 12.3461L12.3653 10.5524C12.2008 10.4245 11.9866 10.3793 11.7845 10.4298L9.59541 10.9771C9.00082 11.1257 8.37183 10.9515 7.93845 10.5181L5.48187 8.06155C5.04849 7.62817 4.87427 6.99919 5.02292 6.40459L5.57019 4.21553C5.62073 4.01336 5.57552 3.79918 5.44758 3.63468L3.65387 1.32849ZM1.88477 0.511076C2.62689 -0.231039 3.8515 -0.154797 4.49583 0.673634L6.28954 2.97983C6.6187 3.40304 6.73502 3.95409 6.60498 4.47423L6.05772 6.66329C5.99994 6.8944 6.06766 7.13888 6.2361 7.30732L8.69268 9.7639C8.86113 9.93235 9.1056 10.0001 9.33671 9.94229L11.5258 9.39502C12.0459 9.26499 12.597 9.3813 13.0202 9.71047L15.3264 11.5042C16.1548 12.1485 16.231 13.3731 15.4889 14.1152L14.455 15.1492C13.7153 15.8889 12.6089 16.2137 11.5778 15.8512C9.01754 14.9511 6.61438 13.4774 4.56849 11.4315C2.5226 9.38562 1.04895 6.98246 0.148838 4.42225C-0.213682 3.39112 0.11113 2.28472 0.85085 1.545L1.88477 0.511076Z"
                                        fill="#6D6D6D"></path>
                                    <path
                                        d="M11 0.5C11 0.223858 11.2239 0 11.5 0H15.5C15.7761 0 16 0.223858 16 0.5V4.5C16 4.77614 15.7761 5 15.5 5C15.2239 5 15 4.77614 15 4.5V1.70711L10.8536 5.85355C10.6583 6.04882 10.3417 6.04882 10.1464 5.85355C9.95118 5.65829 9.95118 5.34171 10.1464 5.14645L14.2929 1H11.5C11.2239 1 11 0.776142 11 0.5Z"
                                        fill="#6D6D6D"></path>
                                </svg>
                            </div>
                            <div class="offcanvas-contact-text">
                                <a href="tel:+12346691234"> +123-4669-1234 </a>
                            </div>
                        </li>
                        <li class="d-flex gap-15">
                            <div class="offcanvas-contact-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"
                                    fill="none">
                                    <path
                                        d="M2 2C0.895431 2 0 2.89543 0 4V12L2.58386e-05 12.0103C0.00555998 13.1101 0.898859 14 2 14H7.5C7.77614 14 8 13.7761 8 13.5C8 13.2239 7.77614 13 7.5 13H2C1.53715 13 1.14774 12.6855 1.03376 12.2586L6.67417 8.7876L8 9.5831L15 5.3831V8.5C15 8.77614 15.2239 9 15.5 9C15.7761 9 16 8.77614 16 8.5V4C16 2.89543 15.1046 2 14 2H2ZM5.70808 8.20794L1 11.1052V5.3831L5.70808 8.20794ZM1 4.2169V4C1 3.44772 1.44772 3 2 3H14C14.5523 3 15 3.44772 15 4V4.2169L8 8.4169L1 4.2169Z"
                                        fill="#6D6D6D"></path>
                                    <path
                                        d="M14.2467 14.2686C15.2567 14.2686 15.8339 13.4116 15.8339 12.2442V12.0344C15.8339 10.4297 14.6402 9 12.5197 9H12.4847C10.421 9 9 10.3598 9 12.4322V12.6465C9 14.8195 10.4385 16 12.3579 16H12.4016C12.9963 16 13.4204 15.9257 13.639 15.8251V15.0949C13.3941 15.2042 12.9656 15.2742 12.4585 15.2742H12.4147C11.0812 15.2742 9.84385 14.4872 9.84385 12.6202V12.4628C9.84385 10.8057 10.9019 9.73891 12.4847 9.73891H12.524C14.0587 9.73891 15.0075 10.7883 15.0075 12.065V12.183C15.0075 13.158 14.6839 13.5734 14.3691 13.5734C14.1374 13.5734 13.9582 13.4247 13.9582 13.1537V10.9631H13.0531V11.5315H13.0225C12.9394 11.2342 12.6552 10.9019 12.0693 10.9019C11.2911 10.9019 10.8101 11.4572 10.8101 12.3011V12.8301C10.8101 13.722 11.2998 14.2642 12.0693 14.2642C12.5415 14.2642 12.9656 14.0369 13.0837 13.6215H13.1274C13.2455 14.0412 13.7439 14.2686 14.2467 14.2686ZM11.7939 12.6814V12.4541C11.7939 11.9076 12.0212 11.6627 12.3666 11.6627C12.664 11.6627 12.9394 11.8551 12.9394 12.371V12.7383C12.9394 13.3111 12.6858 13.4816 12.3754 13.4816C12.0212 13.4816 11.7939 13.2673 11.7939 12.6814Z"
                                        fill="#6D6D6D"></path>
                                </svg>
                            </div>
                            <div class="offcanvas-contact-text">
                                <a href="mailto:support@company.com">support@company.com</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="offcanvas-social">
                    <h4 class="offcanvas-title-meta">Follow Us</h4>
                    <ul>
                        <li><a href="#"><i class="ri-facebook-fill"></i></a></li>
                        <li><a href="#"><i class="ri-twitter-x-fill"></i></a></li>
                        <li><a href="#"><i class="ri-youtube-fill"></i></a></li>
                        <li><a href="#"><i class="ri-linkedin-box-fill"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas-overlay"></div>
<div class="offcanvas-overlay-white"></div>
<!-- Offcanvas area start -->