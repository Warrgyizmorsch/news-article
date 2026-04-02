@extends('layouts.app')

@section('title', $pageTitle . ' Articles')

@section('content')

    <style>
        .hover-zoom-img {
            display: block;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .hover-zoom-img img {
            transition: transform 0.4s ease;
        }

        .hover-zoom-img:hover img {
            transform: scale(1.08);
        }

        .monthly-tabs .nav-link {
            color: #111827;
            font-weight: 600;
            font-size: 18px;
            padding: 12px 24px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            margin-right: -1px;
            border-radius: 0;
        }

        .monthly-tabs .nav-link.active {
            color: #ef4444;
            background-color: #fff;
            border-bottom-color: transparent;
        }

        .monthly-tabs-wrapper {
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 50px;
        }
    </style>

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
                                    <li class="rs-breadcumb-item">
                                        <span>
                                            <a href="{{ route('news.index') }}">Articles</a>
                                        </span>
                                    </li>
                                    <li class="rs-breadcumb-item active">
                                        {{ $pageTitle }}
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

    <section class="rs-postbox-area section-space-bottom pt-30">
        <div class="container">

            <div class="monthly-tabs-wrapper">
                <ul class="nav nav-tabs monthly-tabs border-0" id="monthlyTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="current-tab" data-bs-toggle="tab" data-bs-target="#current"
                            type="button" role="tab" aria-controls="current" aria-selected="true">Current edition</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="browse-tab" data-bs-toggle="tab" data-bs-target="#browse" type="button"
                            role="tab" aria-controls="browse" aria-selected="false">Previous editions</button>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="monthlyTabContent">
                <!-- Current Edition Tab -->
                <div class="tab-pane fade show active" id="current" role="tabpanel" aria-labelledby="current-tab">
                    @if($latestArticle)
                        <div class="row align-items-center g-5">
                            <div class="col-lg-4 col-xl-5">
                                <div class="mb-3">
                                    <span
                                        style="font-weight: 700; color: #111827; font-size: 14px; letter-spacing: 0.5px; text-transform: uppercase;">
                                        {{ optional($latestArticle->published_at)->format('M  Y') }}
                                    </span>
                                </div>
                                <h1
                                    style="font-size: 56px; font-weight: 700; color: #111827; line-height: 1.1; font-family: 'Playfair Display', serif; margin-bottom: 24px;">
                                    {{ $latestArticle->title }}
                                </h1>
                                <div class="mt-4">

                                    @if($latestArticle->pdf_file)
                                        <a href="{{ asset('storage/' . $latestArticle->pdf_file) }}" target="_blank"
                                            class="rs-btn bg-primary is-white has-icon">

                                            Read Edition

                                            <span class="icon-box">
                                                <svg class="icon-first" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                                        fill="white" />
                                                </svg>
                                                <svg class="icon-second" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                                        fill="white" />
                                                </svg>
                                            </span>
                                        </a>
                                    @else
                                        <span class="rs-btn bg-light text-muted" style="cursor: not-allowed;">
                                            Read Edition
                                        </span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-lg-8 col-xl-7">
                                <div style="aspect-ratio: 16/9; overflow: hidden; border: 1px solid #e5e7eb;">

                                    @if($latestArticle->pdf_file)
                                        <a href="{{ asset('storage/' . $latestArticle->pdf_file) }}" target="_blank"
                                            class="hover-zoom-img">
                                            <img src="{{ $latestArticle->featured_image ? asset('storage/' . $latestArticle->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                alt="{{ $latestArticle->title }}"
                                                style="width: 100%; height: 100%; object-fit: contain;">
                                        </a>
                                    @else
                                        <div class="hover-zoom-img" style="cursor: default;">
                                            <img src="{{ $latestArticle->featured_image ? asset('storage/' . $latestArticle->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                alt="{{ $latestArticle->title }}"
                                                style="width: 100%; height: 100%; object-fit: contain;">
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-light text-center py-5">
                            <h4 class="mb-0">No current edition found.</h4>
                        </div>
                    @endif
                </div>

                <!-- Browse All Editions Tab -->
                <div class="tab-pane fade" id="browse" role="tabpanel" aria-labelledby="browse-tab">
                    <div class="row g-4">

                        @forelse($otherArticles as $article)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="edition-card">

                                    <div class="edition-image">
                                        @if($article->pdf_file)
                                            <a href="{{ asset('storage/' . $article->pdf_file) }}" target="_blank">
                                                <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                    alt="{{ $article->title }}">
                                            </a>
                                        @else
                                            <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                alt="{{ $article->title }}">
                                        @endif
                                    </div>

                                    <div class="edition-content">

                                        <span class="edition-date">
                                            {{ optional($article->published_at)->format('M, Y') }}
                                        </span>

                                        <h4 class="edition-title">
                                            {{ \Illuminate\Support\Str::limit($article->title, 70) }}
                                        </h4>

                                        @if($article->pdf_file)
                                            <a href="{{ asset('storage/' . $article->pdf_file) }}" target="_blank"
                                                class="edition-read">
                                                Read Edition →
                                            </a>
                                        @endif

                                    </div>

                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-light text-center py-5">
                                    <h4 class="mb-0">No archived editions found.</h4>
                                </div>
                            </div>
                        @endforelse

                    </div>

                    @if($otherArticles && $otherArticles->hasPages())
                        <div class="rs-pagination-wrap mt-40 d-flex justify-content-center">
                            {{ $otherArticles->links('pagination::bootstrap-4') }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
    <style>
        .edition-card {
            transition: all .35s ease;
        }

        .edition-image {
            overflow: hidden;
        }

        .edition-image img {
            width: 100%;
            height: 360px;
            object-fit: fill;
            transition: transform .4s ease;
        }

        .edition-card:hover img {
            transform: scale(1.05);
        }

        .edition-content {
            padding-top: 14px;
        }

        .edition-date {
            font-size: 13px;
            color: #ef4444;
            font-weight: 600;
        }

        .edition-title {
            font-size: 18px;
            font-weight: 600;
            margin-top: 5px;
            line-height: 1.4;
        }

        .edition-read {
            display: inline-block;
            margin-top: 8px;
            font-size: 14px;
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .edition-read:hover {
            text-decoration: underline;
        }
    </style>

@endsection