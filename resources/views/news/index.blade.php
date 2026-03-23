@extends('layouts.app')

@section('title', $pageType === 'news' ? 'News' : $pageTitle . ' News')

@section('content')

    <!-- breadcrumb area start -->
    <div class="rs-breadcrumb-area rs-breadcrumb-two p-relative section-space">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-8 col-lg-9">
                    <div class="rs-breadcrumb-wrapper">
                        <div class="rs-breadcrumb-menu">
                            <nav>
                                <ul>
                                    <li class="rs-breadcumb-item">
                                        <span>
                                            <a href="{{ route('home') }}">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M15.4125 6.1124L9.69686 1.3249C8.71561 0.503027 7.28436 0.503027 6.30311 1.3249L0.587484 6.1124C-0.106266 6.69365 -0.196891 7.72803 0.384359 8.41865C0.671859 8.7624 1.08748 8.97178 1.53123 8.9999V13.6562C1.53123 14.5562 2.26248 15.2874 3.16561 15.2905H6.67811V11.2593C6.67811 10.5312 7.26873 9.94053 7.99686 9.94053C8.72498 9.94053 9.31561 10.5312 9.31561 11.2593V15.2937H12.8312C13.7312 15.2937 14.4625 14.5624 14.4656 13.6593V9.00303C15.3687 8.94365 16.0531 8.1624 15.9937 7.25928C15.9625 6.81553 15.7531 6.3999 15.4125 6.1124Z"
                                                        fill="black" />
                                                </svg>
                                                Home
                                            </a>
                                        </span>
                                    </li>

                                    @if($pageType === 'news')
                                        <li class="rs-breadcumb-item active">
                                            News
                                        </li>
                                    @elseif($pageType === 'category')
                                        <li class="rs-breadcumb-item">
                                            <span>
                                                <a href="{{ route('news.index') }}">News</a>
                                            </span>
                                        </li>
                                        <li class="rs-breadcumb-item active">
                                            {{ $pageTitle }}
                                        </li>
                                    @elseif($pageType === 'tag')
                                        <li class="rs-breadcumb-item">
                                            <span>
                                                <a href="{{ route('news.index') }}">News</a>
                                            </span>
                                        </li>
                                        <li class="rs-breadcumb-item active">
                                            {{ $pageTitle }}
                                        </li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- postbox area start -->
    <section class="rs-postbox-area section-space-bottom pt-30">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-8 col-lg-7">
                    <div class="mb-30">
                        <h2 class="section-title">
                            @if($pageType === 'news')
                                All News
                            @elseif($pageType === 'category')
                                {{ $pageTitle }} News
                            @elseif($pageType === 'tag')
                                {{ $pageTitle }} News
                            @endif
                        </h2>
                    </div>
                    <div class="row g-4">
                        @forelse($articles as $article)
                            <div class="col-xl-6 col-md-6">
                                <div class="rs-post-item rs-post-item-two">
                                    <div class="rs-post-thumb">
                                        <a href="{{ route('news.show', $article->slug) }}" class="image-link">
                                            <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                alt="{{ $article->title }}">
                                        </a>
                                    </div>

                                    <div class="rs-post-content">
                                        <div class="rs-post-tag">
                                            @if($article->category)
                                                <a href="{{ route('category.show', $article->category->slug) }}" class="post-tag is-red">
                                                    {{ $article->category->name }}
                                                </a>
                                            @endif
                                        </div>

                                        <h4 class="rs-post-title underline">
                                            <a href="{{ route('news.show', $article->slug) }}">
                                                {{ \Illuminate\Support\Str::limit($article->title, 70) }}
                                            </a>
                                        </h4>

                                        <p class="rs-post-desc" style="margin-bottom: 10px;">
                                            {{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 120) }}
                                        </p>

                                        <div class="rs-post-meta">
                                            <ul>
                                                <li>
                                                    <span class="rs-meta">
                                                        By
                                                        <a href="javascript:void(0)" class="meta-author">
                                                            {{ $article->author->name ?? 'Admin' }}
                                                        </a>
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="rs-meta">
                                                        {{ optional($article->published_at)->format('M d, Y') }}
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="rs-meta">
                                                        {{ number_format($article->views) }} Views
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-light mb-0">
                                    No published articles found.
                                </div>
                            </div>
                        @endforelse
                    </div>

                    @if($articles->hasPages())
                        <div class="rs-pagination-wrap mt-40 d-flex justify-content-center">
                            {{ $articles->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
                <div class="col-xl-4 col-lg-5">
                    @include('news.partials.news-sidebar')

                </div>
            </div>
        </div>
    </section>
    <!-- rs-postbox area end -->

@endsection