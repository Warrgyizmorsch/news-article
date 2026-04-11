@extends('layouts.app')
@section('content')
                        <!-- SECTION 1: Hero Area -->
                        <section class="rs-banner-area rs-banner-six section-space-top">
                            <div class="container">
                                <div class="row g-4 align-items-stretch">

                                    {{-- LEFT: 2 Political Articles (25% Width) --}}
                                    <div class="col-xl-4 col-lg-4 d-flex">
                                        <div class="rs-banner-small-post">
                                            <div class="rs-post-small rs-post-small-seventeen">
                                                @forelse($heroLeft as $article)
                                                    <div class="rs-post-small-item mb-20">
                                                        <div class="rs-post-small-thumb">
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
                                                            <h6 class="rs-post-small-title underline">
                                                                <a href="{{ route('news.show', $article->slug) }}">
                                                                    {{ \Illuminate\Support\Str::limit($article->title, 65) }}
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
                                    </div>

                                    {{-- CENTER: 1 Main Political Article (50% Width) --}}
                                    <div class="col-xl-5 col-lg-5 d-flex">
                                        @if($heroCenter)
                                            <div class="rs-post-overlay rs-post-overlay-one" style="width: 100%;">
                                                <a href="{{ route('news.show', $heroCenter->slug) }}">
                                                    <div class="rs-post-overlay-bg-thumb"
                                                        style="background-image: url('{{ $heroCenter->featured_image ? asset('storage/' . $heroCenter->featured_image) : asset('assets/images/default/news-placeholder.webp') }}'); background-size: cover; background-position: center; height: 100%; border-radius: 8px;">
                                                    </div>
                                                </a>
                                                <div class="rs-post-overlay-content">
                                                    <div class="rs-post-tag-two" style="margin-bottom: 15px;">
                                                        <a href="javascript:void(0)" class="news-category">
                                                            {{ $heroCenter->category->name ?? 'News' }}
                                                        </a>
                                                    </div>
                                                    <h3 class="rs-post-overlay-title is-white underline">
                                                        <a href="{{ route('news.show', $heroCenter->slug) }}">
                                                            {{ $heroCenter->title }}
                                                        </a>
                                                    </h3>
                                                    @if(!empty($heroCenter->auther))
                                                        <div class="rs-post-meta meta-white">
                                                            <ul>
                                                                <li><span class="rs-meta">By {{ $heroCenter->auther }}</span></li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @else
                                            <div class="rs-post-overlay rs-post-overlay-one">
                                                <div class="rs-post-overlay-bg-thumb"
                                                    style="background-image: url('{{ asset('assets/images/default/news-placeholder.webp') }}'); height: 400px; border-radius: 8px;">
                                                </div>
                                                <div class="rs-post-overlay-content text-center">
                                                    <h3 class="rs-post-overlay-title is-white">No Featured Article</h3>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- RIGHT: 1 Bookshelf Article + Advertisement (25% Width) --}}
                                    <div class="col-xl-3 col-lg-3 d-flex flex-column gap-4">
                                        <div class="rs-banner-small-post">
                                            <div class="rs-post-small rs-post-small-seventeen">
                                                @forelse($heroRightArticle as $article)
                                                    <div class="rs-post-small-item mb-20">
                                                        <div class="rs-post-small-thumb">
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
                                                            <h6 class="rs-post-small-title underline">
                                                                <a href="{{ route('news.show', $article->slug) }}">
                                                                    {{ \Illuminate\Support\Str::limit($article->title, 65) }}
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
                                            <x-advertisement-box width="100%" height="300px" />
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
                            </style>
                        </section>

                        <!-- SECTION 2: Grid Articles (3 Per Row) -->
                        <section class="rs-trending-news-area section-space-bottom rs-ptop">
                            <div class="container">
                                <div class="row g-5">
                                    {{-- Left: Articles Grid (3 per row) --}}
                                    <div class="col-xl-9 col-lg-8">
                                        <div class="row g-3">
                                            @forelse($gridArticles as $article)
                                                <div class="col-xl-4 col-lg-6 col-md-6">
                                                    <div class="rs-post-horizontal-card">
                                                        <div class="rs-post-h-thumb">
                                                            <a href="{{ route('news.show', $article->slug) }}" class="image-link">
                                                                <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                                    alt="{{ $article->title }}">
                                                            </a>
                                                        </div>
                                                        <div class="rs-post-h-content">
                                                            <div class="news-category">
                                                                {{ $article->category->name ?? 'News' }}
                                                            </div>
                                                            <h6 class="rs-post-h-title">
                                                                <a href="{{ route('news.show', $article->slug) }}">
                                                                    {{ $article->title }}
                                                                </a>
                                                            </h6>
                                                            <div class="rs-post-h-meta">
                                                                @if(!empty($article->auther))
                                                                    <span class="rs-meta-author">{{ $article->auther }}</span>
                                                                @endif
                                                                @if($article->published_at)
                                                                    <span class="rs-meta-date">{{ $article->published_at->format('M d, Y') }}</span>
                                                                @endif
                                                            </div>
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
                                    <div class="col-xl-3 col-lg-4">
                                        <div class="rs-sidebar-wrapper">
                                            <div class="rs-sidebar mb-30">
                                                <x-advertisement-box width="100%" height="450px" />
                                            </div>
                                        </div>
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

                                /* Horizontal Card Styles - Image Left, Content Right */
                                .rs-post-horizontal-card {
                                    display: flex;
                                    gap: 5px;
                                    padding: 20px 2px;
                                    background: #fff;
                                    overflow: hidden;
                                    transition: all 0.3s ease;
                                    height: 100%;
                                    align-items: center;
                                }

                                .rs-post-horizontal-card:hover {
                                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
                                }

                                .rs-post-h-thumb {
                                    flex: 0 0 150px;
                                    width: 160px;
                                    height: 130px;
                                    min-height: 120px;
                                    overflow: hidden;
                                }

                                .rs-post-h-thumb .image-link {
                                    display: block;
                                    width: 100%;
                                    height: 130px;
                                    overflow: hidden;
                                }

                                .rs-post-h-thumb img {
                                    width: 100%;
                                    height: 100%;
                                    object-fit: cover;
                                    transition: transform 0.4s ease;
                                }

                                .rs-post-horizontal-card:hover .rs-post-h-thumb img {
                                    transform: scale(1.06);
                                }

                                .rs-post-h-content {
                                    padding: 10px 5px;
                                    display: flex;
                                    flex-direction: column;
                                    flex-grow: 1;
                                    justify-content: space-between;
                                }

                                .rs-post-tag-simple {
                                    font-size: 11px;
                                    color: #666;
                                    font-weight: 600;
                                    text-transform: capitalize;
                                    margin-bottom: 6px;
                                }

                                .rs-post-h-title {
                                    margin: 0 0 8px 0;
                                    font-size: 18px;
                                    font-weight: 700;
                                    line-height: 1.25;
                                }

                                .rs-post-h-title a {
                                    color: #1a1a1a;
                                    text-decoration: none;
                                    transition: color 0.3s ease;
                                    /* display: -webkit-box;
                                                                -webkit-line-clamp: 2;
                                                                -webkit-box-orient: vertical; */
                                    overflow: hidden;
                                }

                                .rs-post-h-title a:hover {
                                    text-decoration: underline;
                                }

                                .rs-post-h-meta {
                                    display: flex;
                                    gap: 10px;
                                    font-size: 11px;
                                    color: #999;
                                    align-items: center;
                                    flex-wrap: wrap;
                                }

                                .rs-meta-author {
                                    color: #1a1a1a;
                                    font-weight: 600;
                                    font-size: 11px;
                                }

                                .rs-meta-date {
                                    color: #999;
                                    font-size: 11px;
                                }
                            </style>
                        </section>

                        <!-- SECTION 3: Highlight Stories (Videos Section) -->
                        @include('components.highlight-video');

                        <!-- SECTION 4: Previous Month Articles (3 Per Row) -->
                        <section class="rs-trending-news-area section-space-bottom rs-ptop">
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
                                    <div class="col-xl-8 col-lg-8">
                                        <div class="row g-4">
                                            @php
    $categoryOrder = ['politics', 'business', 'lifestyle', 'bookshelf'];
                                            @endphp

                                            @forelse($categoryOrder as $category)
                                                @if(isset($previousMonthArticles[$category]) && $previousMonthArticles[$category])
                                                    @php $article = $previousMonthArticles[$category]; @endphp
                                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                                        <div class="news-clean-item">

                                                            <div class="news-clean-content">
                                                                <div class="news-category">
                                                                    {{ $article->category->name ?? 'News' }}
                                                                </div>

                                                                <h3 class="news-title">
                                                                    <a href="{{ route('news.show', $article->slug) }}">
                                                                        {{$article->title}}
                                                                    </a>
                                                                </h3>

                                                                <div class="news-meta">
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
                                    <div class="col-xl-4 col-lg-4">
                                        <div class="rs-sidebar-wrapper">
                                            <div class="rs-sidebar mb-30">
                                                <x-advertisement-box width="100%" height="400px" />
                                            </div>
                                        </div>
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
                                border-bottom: 1px solid #e6e6e6;
                            }

                            .news-clean-content {
                                flex: 1;
                            }

                            /* Category */
                            .news-category {
                                font-size: 14px;
                                font-weight: 600;
                                color: #e3120b;
                                margin-bottom: 6px;
                            }

                            /* Title */
                            .news-title {
                                font-size: 20px;
                                font-weight: 600;
                                line-height: 1.2;
                                margin-bottom: 10px;
                            }

                            .news-title a {
                                color: #111;
                                text-decoration: none;
                            }

                            .news-title a:hover {
                                text-decoration: underline;
                            }

                            /* Meta */
                            .news-meta {
                                font-size: 14px;
                                color: #666;
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

                            @media (max-width: 1200px) {
                                .news-clean-item {
                                    flex-direction: column-reverse;
                                    align-items: flex-start;
                                    gap:8px;
                                }

                                .news-thumb {
                                    width: 100%;
                                    height: 100%;
                                }
                            }

                            @media (max-width: 768px) {

                                .news-title {
                                    font-size: 22px;
                                }

                            }
                        </style>

@endsection