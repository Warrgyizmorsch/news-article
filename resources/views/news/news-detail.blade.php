@extends('layouts.app')

@section('title', $article->meta_title ?: $article->title)
@section('meta_description', $article->meta_description ?: $article->excerpt)

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;0,900;1,400&family=Source+Sans+3:wght@400;500;600;700&display=swap');

    :root {
        --rs-theme-primary: #0d6efd;
        --rs-theme-red: #da2128;
        --rs-text-serif: 'Merriweather', serif;
        --rs-text-sans: 'Source Sans 3', sans-serif;
        --rs-title-primary: #10171e;
        --rs-body-text: #4b5563;
    }

    #rsReadingProgress {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 4px;
        background: var(--rs-theme-red);
        z-index: 9999;
        transition: width 0.1s ease;
    }

    .rs-breadcrumb-two {
        padding: 30px 0;
        background: #f8fafc;
        border-bottom: 1px solid #eef2f6;
    }

    .rs-breadcumb-item {
        font-family: var(--rs-text-sans);
        font-size: 14px;
        color: #64748b;
    }

    .rs-breadcumb-item a {
        color: var(--rs-title-primary);
        font-weight: 600;
        transition: color 0.3s;
    }

    .rs-breadcumb-item a:hover {
        color: var(--rs-theme-red);
    }

    .rs-blog-post-area {
        padding-top: 60px;
    }

    .rs-article-header {
        position: relative;
        margin-bottom: 40px;
    }

    .rs-category-badge {
        position: absolute;
        top: 0;
        right: 0;
        background: var(--rs-theme-red);
        color: #fff;
        padding: 6px 16px;
        font-family: var(--rs-text-sans);
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        z-index: 2;
    }

    .rs-blog-post-title {
        font-family: var(--rs-text-serif);
        font-weight: 900;
        font-size: 42px;
        line-height: 1.2;
        color: var(--rs-title-primary);
        max-width: 900px;
        margin-bottom: 25px;
        text-align: left;
    }

    .rs-post-meta-row {
        display: flex;
        align-items: center;
        gap: 24px;
        padding-bottom: 25px;
        border-bottom: 1px solid #f1f5f9;
        flex-wrap: wrap;
    }

    .rs-meta-item {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: var(--rs-text-sans);
        font-size: 14px;
        color: #64748b;
        font-weight: 500;
    }

    .rs-meta-item i, .rs-meta-item svg {
        color: var(--rs-theme-primary);
    }

    .rs-meta-author-img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        object-fit: cover;
    }

    .rs-meta-link {
        color: var(--rs-title-primary);
        font-weight: 700;
        text-decoration: none;
        transition: color 0.2s;
    }

    .rs-meta-link:hover {
        color: var(--rs-theme-red);
    }

    .rs-featured-img-container {
        margin-bottom: 45px;
    }

    .rs-featured-img-container img {
        width: 100%;
        border-radius: 4px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }

    .article-body-content {
        font-family: var(--rs-text-serif);
        font-size: 19px;
        line-height: 1.8;
        color: var(--rs-body-text);
    }

    .article-body-content p {
        margin-bottom: 28px;
    }

    .article-body-content blockquote {
        position: relative;
        padding: 40px;
        background: #fdf2f2;
        border-left: 4px solid var(--rs-theme-red);
        margin: 45px 0;
        font-style: italic;
        font-size: 22px;
        color: var(--rs-title-primary);
        border-radius: 0 8px 8px 0;
    }

    .article-body-content blockquote::before {
        content: '"';
        position: absolute;
        top: 10px;
        left: 20px;
        font-size: 100px;
        font-family: Georgia, serif;
        color: rgba(218, 33, 40, 0.1);
        line-height: 1;
    }

    .rs-content-list {
        list-style: none;
        padding-left: 0;
        margin: 30px 0;
    }

    .rs-content-list li {
        position: relative;
        padding-left: 35px;
        margin-bottom: 15px;
        font-family: var(--rs-text-sans);
        font-weight: 500;
        font-size: 17px;
    }

    .rs-content-list li::before {
        content: '\2713';
        position: absolute;
        left: 0;
        top: 0;
        width: 24px;
        height: 24px;
        background: var(--rs-theme-primary);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: bold;
    }

    /* Paywall Styles */
    .rs-paywall-preview {
        position: relative;
    }

    .rs-paywall-gradient {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 250px;
        background: linear-gradient(to top, #fff, transparent);
        z-index: 5;
    }

    .rs-subscribe-cta {
        margin-top: -60px;
        padding: 50px;
        background: #111827;
        color: #fff;
        border-radius: 12px;
        text-align: center;
        position: relative;
        z-index: 10;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .rs-subscribe-cta h3 {
        color: #fff;
        font-family: var(--rs-text-serif);
        font-size: 28px;
        margin-bottom: 15px;
    }

    .rs-subscribe-cta p {
        color: #9ca3af;
        margin-bottom: 30px;
        font-family: var(--rs-text-sans);
    }

    .rs-subscribe-btn {
        background: var(--rs-theme-red);
        color: #fff;
        padding: 14px 40px;
        border-radius: 99px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        text-decoration: none;
        transition: transform 0.3s, background 0.3s;
        display: inline-block;
    }

    .rs-subscribe-btn:hover {
        background: #bc1921;
        transform: translateY(-3px);
        color: #fff;
    }

    /* Author Box */
    .rs-author-box {
        display: flex;
        gap: 30px;
        padding: 40px;
        background: #f8fafc;
        border-radius: 12px;
        margin-top: 60px;
        align-items: center;
    }

    .rs-author-box img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    .rs-author-info h4 {
        font-family: var(--rs-text-serif);
        margin-bottom: 10px;
        color: var(--rs-title-primary);
    }

    .rs-author-info p {
        font-family: var(--rs-text-sans);
        color: #64748b;
        font-size: 15px;
        line-height: 1.6;
        margin: 0;
    }

    .rs-related-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        margin-top: 30px;
    }

    .rs-related-card {
        text-decoration: none;
        group: hover;
    }

    .rs-related-thumb {
        width: 100%;
        height: 180px;
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    .rs-related-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .rs-related-card:hover .rs-related-thumb img {
        transform: scale(1.08);
    }

    .rs-related-card h6 {
        font-family: var(--rs-text-sans);
        font-weight: 700;
        line-height: 1.4;
        color: var(--rs-title-primary);
        transition: color 0.3s;
    }

    .rs-related-card:hover h6 {
        color: var(--rs-theme-red);
    }

    @media (max-width: 768px) {
        .rs-blog-post-title { font-size: 32px; }
        .rs-related-grid { grid-template-columns: 1fr; }
        .rs-author-box { flex-direction: column; text-align: center; }
    }
</style>

<div id="rsReadingProgress"></div>

<!-- breadcrumb area start -->
<div class="rs-breadcrumb-area rs-breadcrumb-two p-relative section-space">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="rs-breadcrumb-wrapper">
                    <div class="rs-breadcrumb-menu">
                        <nav>
                            <ul>
                                <li class="rs-breadcumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                @if($article->category)
                                    <li class="rs-breadcumb-item">
                                        <a href="{{ route('category.show', $article->category->slug) }}">
                                            {{ $article->category->name }}
                                        </a>
                                    </li>
                                @endif
                                <li class="rs-breadcumb-item">
                                    {{ \Illuminate\Support\Str::limit($article->title, 40) }}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb area end -->

<!-- blog post area start -->
<section class="rs-blog-post-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="rs-article-header">
                    @if($article->category)
                        <a href="{{ route('category.show', $article->category->slug) }}" class="rs-category-badge">
                            {{ $article->category->name }}
                        </a>
                    @endif

                    <h1 class="rs-blog-post-title">
                        {{ $article->title }}
                    </h1>

                    <div class="rs-post-meta-row">
                        <div class="rs-meta-item">
                            <img src="{{ $article->author->profile_photo_path ? asset('storage/' . $article->author->profile_photo_path) : asset('assets/images/user/user-thumb-05.webp') }}"
                                 alt="{{ $article->author->name }}" class="rs-meta-author-img">
                            <a href="javascript:void(0)" class="rs-meta-link">
                                {{ $article->author->name ?? 'Editorial Team' }}
                            </a>
                        </div>

                        <div class="rs-meta-item">
                            <i class="ri-calendar-line"></i>
                            <span>{{ optional($article->published_at)->format('F d, Y') }}</span>
                        </div>

                        <div class="rs-meta-item">
                            <i class="ri-chat-3-line"></i>
                            <span>0 Comments</span>
                        </div>

                        <div class="rs-meta-item">
                            <i class="ri-time-line"></i>
                            @php
                                $wordCount = str_word_count(strip_tags($article->content));
                                $readingTime = ceil($wordCount / 200);
                            @endphp
                            <span>{{ $readingTime }} min read</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-5">
            <div class="col-xl-8 col-lg-8">
                <div class="rs-postbox-details-content">
                    <div class="rs-featured-img-container">
                        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                             alt="{{ $article->title }}">
                    </div>
                    @php
                        $canRead = auth()->check() && auth()->user()->canReadFullArticles();
                        $cleanContent = $article->content;

                        $cleanContent = preg_replace('#\sstyle=("|\')(.*?)\1#i', '', $cleanContent);
                        $cleanContent = preg_replace('#</?(span|font)[^>]*>#i', '', $cleanContent);
                        $cleanContent = preg_replace('#\s(width|height|align|class)=("|\')(.*?)\2#i', '', $cleanContent);
                    @endphp

                       <div class="article-body-content">
                            {!! $cleanContent !!}
                        </div>
                        
                    <!-- @if($canRead)
                        <div class="article-body-content">
                            {!! $cleanContent !!}
                        </div>
                    @else
                        <div class="article-body-content">
                            {!! \Illuminate\Support\Str::limit(strip_tags($cleanContent), 550) !!}
                        </div>

                        <div class="rs-paywall-preview">
                            <div style="filter: blur(8px); user-select: none; pointer-events: none; height: 350px; overflow: hidden; opacity: 0.6;">
                                {!! $cleanContent !!}
                            </div>
                            <div class="rs-paywall-gradient"></div>

                            <div class="rs-subscribe-cta">
                                <h3>Unlock the Full Story</h3>
                                <p>Get unlimited access to award-winning journalism, exclusive reports, and deep analysis by subscribing to Democracy Asia.</p>
                                <a href="{{ route('frontend.plans.index') }}" class="rs-subscribe-btn">
                                    Become a Member
                                </a>
                            </div>
                        </div>
                    @endif -->

                    <!-- Tags -->
                    <div class="rs-postbox-details-social mt-50">
                        <div class="rs-postbox-details-tags tagcloud">
                            @forelse($article->tags as $tag)
                                <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</a>
                            @empty
                                <a href="javascript:void(0)">World News</a>
                            @endforelse
                        </div>
                    </div>

                    <!-- Author Box -->
                    <div class="rs-author-box">
                        <div class="rs-author-info">
                            <h4>{{ $article->author->name ?? 'Editorial Staff' }}</h4>
                            <p>Senior editor and contributor covering global politics, emerging technology, and social justice. Dedicated to delivering impartial, fact-based reporting from the heart of Asia.</p>
                        </div>
                    </div>

                    <!-- Related News -->
                    @if($relatedArticles->count())
                        <div class="mt-60">
                            <h4 class="font-serif mb-4">Related News</h4>
                            <div class="rs-related-grid">
                                @foreach($relatedArticles as $related)
                                    <a href="{{ route('news.show', $related->slug) }}" class="rs-related-card">
                                        <div class="rs-related-thumb">
                                            <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                 alt="{{ $related->title }}">
                                        </div>
                                        <h6>{{ \Illuminate\Support\Str::limit($related->title, 65) }}</h6>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-xl-4 col-lg-4">
                @include('news.partials.news-sidebar')
            </div>
        </div>
    </div>
</section>

<script>
    window.onscroll = function() {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / height) * 100;
        document.getElementById("rsReadingProgress").style.width = scrolled + "%";
    };
</script>

@endsection