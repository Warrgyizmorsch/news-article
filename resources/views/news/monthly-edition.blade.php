@extends('layouts.app')

@section('title', $pageTitle . ' News')

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
                                        <a href="{{ route('news.index') }}">News</a>
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
                    <button class="nav-link active" id="current-tab" data-bs-toggle="tab" data-bs-target="#current" type="button" role="tab" aria-controls="current" aria-selected="true">Current edition</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="browse-tab" data-bs-toggle="tab" data-bs-target="#browse" type="button" role="tab" aria-controls="browse" aria-selected="false">Browse all editions</button>
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
                                <span style="font-weight: 700; color: #111827; font-size: 14px; letter-spacing: 0.5px; text-transform: uppercase;">
                                    {{ optional($latestArticle->published_at)->format('M jS Y') }}
                                </span>
                            </div>
                            <h1 style="font-size: 56px; font-weight: 700; color: #111827; line-height: 1.1; font-family: 'Playfair Display', serif; margin-bottom: 24px;">
                                <a href="{{ route('news.show', $latestArticle->slug) }}" style="color: inherit; text-decoration: none;">
                                    {{ $latestArticle->title }}
                                </a>
                            </h1>
                            <div class="mt-4">
                                <a href="{{ route('news.show', $latestArticle->slug) }}" class="rs-btn bg-primary is-white has-icon">
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
                            </div>
                        </div>
                        <div class="col-lg-8 col-xl-7">
                            <div style="aspect-ratio: 16/9; overflow: hidden; border: 1px solid #e5e7eb;">
                                <a href="{{ route('news.show', $latestArticle->slug) }}" class="hover-zoom-img">
                                    <img src="{{ $latestArticle->featured_image ? asset('storage/' . $latestArticle->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                        alt="{{ $latestArticle->title }}" style="width: 100%; height: 100%; object-fit: contain;">
                                </a>
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
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="custom-news-card"
                            style="border: 1px solid #f0f0f0; border-radius: 12px; overflow: hidden; background: #fff; height: 100%; display: flex; flex-direction: column; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);">
                            <div class="card-thumb" style="aspect-ratio: 16/10; overflow: hidden; flex-shrink: 0;">
                                <a href="{{ asset('assets/video/'.$article->excerpt)}}}" class="hover-zoom-img">
                                    <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                        alt="{{ $article->title }}"
                                        style="width: 100%; height: 100%; object-fit: contain; transition: transform 0.4s ease;">
                                </a>
                            </div>

                            <div class="card-content"
                                style="padding: 24px; display: flex; flex-direction: column; flex-grow: 1;">
                                <div class="card-tag" style="margin-bottom: 12px;">
                                    @if($article->category)
                                    <a href="{{ route('category.show', $article->category->slug) }}"
                                        style="background: #ff3b3b; color: #fff; padding: 4px 12px; border-radius: 9999px; font-size: 13px; font-weight: 600; text-transform: uppercase; display: inline-block; letter-spacing: 0.5px;">
                                        {{ $article->category->name }}
                                    </a>
                                    @endif
                                </div>

                                <h3 class="card-title"
                                    style="font-size: 20px; font-weight: 700; color: #111827; margin-bottom: 14px; line-height: 1.3;">
                                    <a href="{{ asset('assets/video/'.$article->excerpt)}}"
                                        style="color: inherit; text-decoration: none;">
                                        {{ \Illuminate\Support\Str::limit($article->title, 70) }}
                                    </a>
                                </h3>

                                <div class="card-meta"
                                    style="display: flex; align-items: center; flex-wrap: wrap; gap: 16px; font-size: 14px; color: #6b7280; margin-bottom: 16px;">
                                    <span style="display: flex; align-items: center; gap: 6px;">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                            <line x1="16" y1="2" x2="16" y2="6"></line>
                                            <line x1="8" y1="2" x2="8" y2="6"></line>
                                            <line x1="3" y1="10" x2="21" y2="10"></line>
                                        </svg>
                                        {{ optional($article->published_at)->format('M j, Y') }}
                                    </span>
                                </div>
                                
                                <p class="card-desc"
                                    style="font-size: 15px; color: #4b5563; line-height: 1.6; margin-bottom: 20px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; flex-grow: 1;">
                                    {{ $article->excerpt ?: strip_tags($article->content) }}
                                </p>
                                <div class="card-footer" style="margin-top: auto;">
                                    <a href="{{ asset('assets/video/'.$article->excerpt)}}"
                                        style="color: #2563eb; font-weight: 600; font-size: 15px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: color 0.2s;">
                                        Read
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path d="M5 12h14M12 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
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

@endsection
