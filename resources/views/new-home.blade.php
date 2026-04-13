@extends('layouts.app')
@section('content')
        <!-- SECTION 1: Hero Area -->
        <section class="rs-banner-area rs-banner-six section-space-top">
            <div class="container">
                <div class="row g-4 align-items-stretch gap-on-mobile">

                <!-- Mobile Top news  -->
                <div class="hide-on-desktop col-xl-5 col-lg-5 d-flex">
                    @if($heroCenter)
                        <div class="custom-hero-card">

                            {{-- IMAGE --}}
                            <div class="hero-card-thumb">
                                <a href="{{ route('news.show', $heroCenter->slug) }}">
                                    <img src="{{ $heroCenter->featured_image ? asset('storage/' . $heroCenter->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                        alt="{{ $heroCenter->title }}">
                                </a>
                            </div>

                            {{-- CONTENT --}}
                            <div class="hero-card-content" style="padding: 15px 0 10px 0; border-bottom: 1px solid var(--rs-border-primary);">

                                {{-- CATEGORY --}}
                                <div class="news-category">
                                    <a href="javascript:void(0)">
                                        {{ $heroCenter->category->name ?? 'News' }}
                                    </a>
                                </div>

                                {{-- TITLE --}}
                                <h3 class="rs-post-small-title underline news-title">
                                    <a href="{{ route('news.show', $heroCenter->slug) }}">
                                        {{ \Illuminate\Support\Str::limit($heroCenter->title, 80) }}
                                    </a>
                                </h3>

                                {{-- META --}}
                                @if(!empty($heroCenter->auther))
                                    <div class="rs-post-meta">
                                        <ul>
                                            <li><span class="rs-meta">By<a href="#" class="meta-author">{{ $heroCenter->auther }}</a></span>
                                            </li>
                                        </ul>
                                    </div>
                                @endif

                            </div>
                        </div>
                    @else
                        <div class="text-center w-100 py-5">
                            <p>No Featured Article</p>
                        </div>
                    @endif
                </div>

                    {{-- LEFT: 2 Political Articles (25% Width) --}}
                    <div class="col-xl-4 col-lg-4 d-flex" style="border-right: 1px solid var(--rs-border-primary);">
                        <div class="rs-banner-small-post">
                            <div class="rs-post-small rs-post-small-seventeen">
                                @forelse($heroLeft as $article)
                                    <div class="rs-post-small-item mb-20">
                                        <div class="rs-post-small-thumb" style="border-radius: 5px;">
                                            <a href="{{ route('news.show', $article->slug) }}" class="image-link">
                                                <img class="hero-side-image"
                                                    src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                    alt="{{ $article->title }}">
                                            </a>
                                        </div>
                                        <div class="rs-post-small-content">
                                            <div class="rs-post-tag-two">
                                                <a href="javascript:void(0)" class="news-category">
                                                    {{ $article->category->name ?? 'News' }}
                                                </a>
                                            </div>
                                            <h6 class="rs-post-small-title underline big-font-size" style="margin:0;">
                                                <a href="{{ route('news.show', $article->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($article->title, 65) }}
                                                </a>
                                            </h6>
                                            @if(!empty($article->auther))
                                                <div class="rs-post-meta">
                                                    <ul>
                                                        <li><span class="rs-meta">By<a href="#"
                                                                    class="meta-author">{{ $article->auther }}</a></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <p>No articles found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- CENTER: 1 Main Political Article (50% Width) --}}
                    <div class="hide-on-mobile col-xl-5 col-lg-5 d-flex">
                        @if($heroCenter)
                            <div class="custom-hero-card">

                                {{-- IMAGE --}}
                                <div class="hero-card-thumb">
                                    <a href="{{ route('news.show', $heroCenter->slug) }}">
                                        <img src="{{ $heroCenter->featured_image ? asset('storage/' . $heroCenter->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                            alt="{{ $heroCenter->title }}">
                                    </a>
                                </div>

                                {{-- CONTENT --}}
                                <div class="hero-card-content">

                                    {{-- CATEGORY --}}
                                    <div class="news-category">
                                        <a href="javascript:void(0)">
                                            {{ $heroCenter->category->name ?? 'News' }}
                                        </a>
                                    </div>

                                    {{-- TITLE --}}
                                    <h3 class="rs-post-small-title underline">
                                        <a href="{{ route('news.show', $heroCenter->slug) }}">
                                            {{ \Illuminate\Support\Str::limit($heroCenter->title, 80) }}
                                        </a>
                                    </h3>

                                    {{-- META --}}
                                    @if(!empty($heroCenter->auther))
                                        <div class="rs-post-meta">
                                            <ul>
                                                <li><span class="rs-meta">By<a href="#"
                                                            class="meta-author">{{ $heroCenter->auther }}</a></span>
                                                </li>
                                            </ul>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @else
                            <div class="text-center w-100 py-5">
                                <p>No Featured Article</p>
                            </div>
                        @endif
                    </div>

                    <div class="hide-on-desktop" style="height: 1px; border: 1px solid var(--rs-border-primary);"></div>

                    {{-- RIGHT: 1 Bookshelf Article + Advertisement (25% Width) --}}
                    <div class="col-xl-3 col-lg-3 d-flex flex-column gap-4">
                        <div class="rs-banner-small-post">
                            <div class="rs-post-small rs-post-small-seventeen">
                                @forelse($heroRightArticle as $article)
                                    <div class="rs-post-small-item mb-20">
                                        <div class="rs-post-small-thumb right-article-image" style="min-width: 110px; border-radius: 5px;">
                                            <a href="{{ route('news.show', $article->slug) }}" class="image-link">
                                                <img class="hero-side-image"
                                                    src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                    alt="{{ $article->title }}">
                                            </a>
                                        </div>
                                        <div class="rs-post-small-content">
                                            <div class="news-category">
                                                <a href="javascript:void(0)" class="post-tag is-green">
                                                    {{ $article->category->name ?? 'News' }}
                                                </a>
                                            </div>
                                            <h6 class="rs-post-small-title underline news-title">
                                                <a href="{{ route('news.show', $article->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($article->title, 45) }}
                                                </a>
                                            </h6>
                                            @if(!empty($article->auther))
                                                <div class="rs-post-meta">
                                                    <ul>
                                                        <li><span class="rs-meta">By <a href="#"
                                                                    class="meta-author">{{ $article->auther }}</a></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <p>No articles found</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        {{-- Advertisement Box --}}
                        <div class="mt-auto">
                            <x-advertisement-box width="100%" height="100%" style="min-height: 200px;" />
                        </div>
                    </div>
                </div>
            </div>

            <style>
                .rs-post-overlay-one {
                    position: relative;
                    height: 100%;
                    min-height: 400px;
                    display: flex;
                    flex-direction: column;
                }

                .rs-post-overlay-one .rs-post-overlay-bg-thumb {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    z-index: 1;
                }

                .rs-post-overlay-content {
                    position: relative;
                    z-index: 2;
                    padding: 30px;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-end;
                    height: 100%;
                    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.8) 100%);
                }

                .rs-post-small-item {
                    display: flex;
                    gap: 15px;
                    align-items: flex-start;
                    flex: 1;
                }

                .rs-post-small-thumb {
                    flex: 0 0 100px;
                }

                .rs-post-small-content {
                    flex: 1;
                }

                .rs-banner-small-post {
                    width: 100%;
                    height: 100%;
                }

                .rs-post-small-seventeen {
                    height: 100%;
                    display: flex;
                    flex-direction: column;
                }

                .hero-side-image {
                    width: 100%;
                    height: 80px;
                    object-fit: cover;
                    border-radius: 6px;
                }

                .custom-hero-card {
                    width: 100%;
                    background: #fff;
                    border-radius: 5px;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    height: 100%;
                }

                .hero-card-thumb {
                    width: 100%;
                    aspect-ratio: 19/9;
                    overflow: hidden;
                }

                .hero-card-thumb img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.4s ease;
                }

                .hero-card-thumb:hover img {
                    transform: scale(1.05);
                }

                .hero-card-content {
                    padding: 15px;
                    display: flex;
                    flex-direction: column;
                    flex-grow: 1;
                }

                .hero-card-title {
                    font-size: 22px;
                    font-weight: 600;
                    margin-bottom: 10px;
                    line-height: 1.2;
                }

                .hero-card-title a {
                    color: #111827;
                    text-decoration: none;
                }

                .hero-card-meta {
                    font-size: 14px;
                    color: #6b7280;
                    margin-bottom: 10px;
                }

                .hero-card-meta span {
                    color: #374151;
                    font-weight: 500;
                }
                .big-font-size {
                    font-size: 23px !important;
                }
                @media (max-width: 768px) {
                    .hero-card-thumb{
                        aspect-ratio: auto;
                    }
                    .big-font-size {
                        font-size: 19px !important;
                    }
                    .right-article-image {
                        flex: 0 0 140px !important;
                        min-height: 130px !important;
                        height: 100% !important;
                    }
                }
            </style>
        </section>

        <!-- SECTION 2: Grid Articles (3 Per Row) -->
        <section class="rs-trending-news-area" style="padding-top:60px; padding-bottom: 10px;">
            <div class="container">
                <div class="row g-5" style="border-top: 1px solid var(--rs-border-primary);">
                    {{-- Left: Articles Grid (3 per row) --}}
                    <div class="col-xl-9 col-lg-9">
                        <div class="row g-0 rs-grid-divider-2">
                            @forelse($gridArticles as $article)
                                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6">
                                    <div class="rs-post-vertical-card">

                                        {{-- IMAGE --}}
                                        <div class="rs-post-v-thumb">
                                            <a href="{{ route('news.show', $article->slug) }}">
                                                <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                    alt="{{ $article->title }}">
                                            </a>
                                        </div>

                                        {{-- CONTENT --}}
                                        <div class="rs-post-v-content">

                                            <div class="news-category">
                                                {{ $article->category->name ?? 'News' }}
                                            </div>

                                            <h6 class="rs-post-small-title underline">
                                                <a href="{{ route('news.show', $article->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($article->title, 70) }}
                                                </a>
                                            </h6>

                                            @if(!empty($article->auther))
                                                <div class="rs-post-meta">
                                                    <ul>
                                                        <li><span class="rs-meta">By<a href="#"
                                                                    class="meta-author">{{ $article->auther }}</a></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-4">
                                        <p>No articles found</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Right: Advertisement --}}
                    <div class="col-xl-3 col-lg-3">
                        <x-advertisement-box width="100%" height="100%" style="min-height: 250px;" />
                    </div>
                </div>
            </div>

            <style>
                .rs-post-overlay-two {
                    position: relative;
                    overflow: hidden;
                    border-radius: 8px;
                    display: flex;
                    flex-direction: column;
                }

                .rs-post-overlay-two .rs-post-overlay-bg-thumb {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    z-index: 1;
                    transition: transform 0.3s ease;
                }

                .rs-post-overlay-two:hover .rs-post-overlay-bg-thumb {
                    transform: scale(1.05);
                }

                .rs-post-overlay-two .rs-post-overlay-content {
                    position: relative;
                    z-index: 2;
                    padding: 20px;
                    display: flex;
                    flex-direction: column;
                    justify-content: flex-end;
                    height: 100%;
                    min-height: 250px;
                    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.9) 100%);
                }

                /* Vertical Card */
                .rs-post-vertical-card {
                    padding: 15px;
                    height: 100%;
                    background: #fff;
                    transition: all 0.3s ease;
                }

                /* GRID BASE */
                .rs-grid-divider-2>div {
                    position: relative;
                }

                /* ✅ Y-axis (Horizontal line) */
                .rs-grid-divider-2>div {
                    border-bottom: 1px solid var(--rs-border-primary);
                }

                /* remove bottom border from last row (4 items per row) */
                .rs-grid-divider-2>div:nth-last-child(-n+4) {
                    border-bottom: none;
                }

                /* ✅ X-axis (Short vertical divider) */
                .rs-grid-divider-2>div:not(:nth-child(4n))::after {
                    content: "";
                    position: absolute;
                    top: 25px;
                    /* spacing from top */
                    bottom: 25px;
                    /* spacing from bottom (important) */
                    right: 0;
                    width: 1px;
                    background: var(--rs-border-primary);
                }

                @media (max-width: 768px) {

                    /* 2 columns → adjust vertical divider */
                    .rs-grid-divider-2>div:not(:nth-child(2n))::after {
                        content: "";
                        position: absolute;
                        top: 15px;
                        bottom: 15px;
                        right: 0;
                        width: 1px;
                        background: var(--rs-border-primary);
                    }

                    /* remove old 4-column divider */
                    .rs-grid-divider-2>div:not(:nth-child(4n))::after {
                        display: none;
                    }

                    /* bottom border fix (last row = 2 items) */
                    .rs-grid-divider-2>div:nth-last-child(-n+2) {
                        border-bottom: none;
                    }
                }

                @media (max-width: 768px) {

                    .rs-post-vertical-card {
                        padding: 10px;
                    }

                    .rs-post-v-thumb {
                        margin-bottom: 6px;
                    }

                    .news-category {
                        font-size: 10px;
                        margin-bottom: 2px;
                    }

                    .rs-post-small-title {
                        font-size: 13px;
                        line-height: 1.3;
                    }
                }

                .rs-post-vertical-card:hover {
                    background: #fafafa;
                }

                /* IMAGE */
                .rs-post-v-thumb {
                    width: 100%;
                    aspect-ratio: 16/10;
                    overflow: hidden;
                    margin-bottom: 10px;
                }

                .rs-post-v-thumb img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    transition: transform 0.4s ease;
                }

                .rs-post-vertical-card:hover img {
                    transform: scale(1.05);
                }

                /* CONTENT */
                .rs-post-v-content {
                    display: flex;
                    flex-direction: column;
                }

                .rs-post-v-title {
                    font-size: 16px;
                    font-weight: 600;
                    line-height: 1.2;
                    margin: 0;
                }

                .rs-post-v-title a {
                    color: #111;
                    text-decoration: none;
                }

                .rs-post-v-title a:hover {
                    text-decoration: underline;
                }

                @media (max-width: 768px) {
                    .rs-post-vertical-card {
                        border-right: none;
                        border-bottom: 1px solid var(--rs-border-primary);
                    }
                }
            </style>
        </section>

        <!-- SECTION 3: Highlight Stories (Videos Section) -->
        @include('components.highlight-video');

        <!-- SECTION 4: Previous Month Articles (3 Per Row) -->
        <section class="rs-trending-news-area" style="padding: 20px 0;">
            <div class="container">
                <div class="row section-title-space align-items-center g-5">
                    <div class="col-xl-6 col-lg-6">
                        <div class="section-title-wrapper">
                            <h2 class="section-title is-black">
                                Featured Stories from Last Month
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="row g-5">
                    {{-- Left: Previous Month Articles (2 per row) --}}
                    <div class="col-xl-9 col-lg-9">
                        <div class="row g-4 rs-grid-divider-4">
                            @php
    $categoryOrder = ['politics', 'business', 'lifestyle', 'bookshelf'];
                            @endphp

                            @forelse($categoryOrder as $category)
                                @if(isset($previousMonthArticles[$category]) && $previousMonthArticles[$category])
                                    @php $article = $previousMonthArticles[$category]; @endphp
                                    <div class="col-xl-6 col-lg-6 col-md-6" style="margin-top: 0;">
                                        <div class="news-clean-item">

                                            <div class="news-clean-content">
                                                <div class="news-category">
                                                    {{ $article->category->name ?? 'News' }}
                                                </div>

                                                <h3 class="news-title rs-post-small-title underline">
                                                    <a href="{{ route('news.show', $article->slug) }}">
                                                        {{$article->title}}
                                                    </a>
                                                </h3>

                                                @if(!empty($article->auther))
                                                    <div class="rs-post-meta">
                                                        <ul>
                                                            <li><span class="rs-meta">By<a href="#"
                                                                        class="meta-author">{{ $article->auther }}</a></span>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="news-thumb">
                                                <a href="{{ route('news.show', $article->slug) }}">
                                                    <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                        alt="{{ $article->title }}">
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                @endif
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-4">
                                        <p>No articles found for previous month</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>


                    {{-- Right: Advertisement --}}
                    <div class="col-xl-3 col-lg-3">
                        <x-advertisement-box width="100%" height="100%" style="min-height: 300px;" />
                    </div>
                </div>
            </div>
        </section>
        <style>
            /* Clean News List Item */

            .news-clean-item {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 25px;
                padding: 25px 0;
            }

            .news-clean-content {
                flex: 1;
            }

            /* Category */
            .news-category {
                font-size: 11px;
                font-weight: 600;
                color: #e3120b;
                margin-bottom: 3px;
            }

            /* Title */
            .news-title {
                font-size: 20px;
            }

            /* Image */
            .news-thumb {
                width: 180px;
                height: 120px;
                flex-shrink: 0;
                overflow: hidden;
            }

            .news-thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .rs-grid-divider-4>div {
                position: relative;
                border-bottom: 1px solid var(--rs-border-primary);
            }

            /* remove bottom border from last row */
            .rs-grid-divider-4>div:nth-last-child(-n+2) {
                border-bottom: none;
            }

            /* SHORT vertical divider (only between left items) */
            .rs-grid-divider-4>div:nth-child(odd)::after {
                content: "";
                position: absolute;
                top: 20px;
                /* space from top */
                bottom: 20px;
                /* space from bottom (important 🔥) */
                right: 0;
                width: 1px;
                background: var(--rs-border-primary);
            }

            @media (max-width: 1200px) {
                .news-clean-item {
                    flex-direction: column-reverse;
                    align-items: flex-start;
                    gap: 8px;
                }

                .news-thumb {
                    width: 100%;
                    height: 100%;
                }
            }

            @media (max-width: 768px) {

                .news-title {
                    font-size: 19px;
                }

            }
        </style>

        <!-- DA Video section  -->
         @if(!empty($featuredVideos) && $featuredVideos->count() > 0)
             @include('components.da-video-section')
        @endif

@endsection