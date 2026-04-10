@extends('layouts.app')
@section('content')
    <!-- hero area start -->
    <section class="rs-banner-area rs-banner-six section-space-top section-space-bottom">
        <div class="container">
            <div class="row g-4 align-items-stretch">

                {{-- Left Side: 3 News (25% Width) --}}
                <div class="col-xl-3 col-lg-4 d-flex">
                    <div class="rs-banner-small-post">
                        <div class="rs-post-small rs-post-small-seventeen" id="hero-left">
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
                                            <a href="javascript:void(0)" class="post-tag is-green">
                                                {{ $article->category->name ?? 'News' }}
                                            </a>
                                        </div>
                                        <h6 class="rs-post-small-title underline">
                                            <a href="{{ route('news.show', $article->slug) }}">
                                                <!-- {{ \Illuminate\Support\Str::limit($article->title, 45) }} -->
                                                {{ $article->title }}
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

                {{-- Center Main News: Carousel (50% Width) --}}
                <div class="col-xl-6 col-lg-5 d-flex">
                    @if($heroCenter && $heroCenter->images->count() > 0)
                        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                            <div class="carousel-inner">
                                @foreach($heroCenter->images as $index => $img)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <div class="rs-post-overlay rs-post-overlay-one">
                                            <a href="{{ asset('storage/' . $heroCenter->pdf_file) }}" target="_blank">
                                                <div class="rs-post-overlay-bg-thumb"
                                                    style="background-image: url('{{ asset('storage/' . $img->image) }}'); background-size: cover; background-position: center; height: 100%; border-radius: 8px;">
                                                </div>
                                            </a>
                                            <div class="rs-post-overlay-content">
                                                <h3 class="rs-post-overlay-title is-white underline">
                                                    <a href="{{ asset('storage/' . $heroCenter->pdf_file) }}" target="_blank">
                                                        <!-- {{ \Str::limit($heroCenter->title, 60) }} -->
                                                        {{ $heroCenter->title }}
                                                    </a>
                                                </h3>
                                                <!-- <div class="rs-post-meta meta-white">
                                                                                            <ul>
                                                                                                @if(!empty($heroCenter->auther))
                                                                                                    <li>By {{ $heroCenter->auther }}</li>
                                                                                                @endif
                                                                                                <li>{{ $heroCenter->published_at?->format('F Y') }}</li>
                                                                                            </ul>
                                                                                        </div> -->
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="rs-post-overlay rs-post-overlay-one">
                            <div class="rs-post-overlay-bg-thumb"
                                style="background-image: url('{{ asset('assets/images/default/news-placeholder.webp') }}'); height: 400px; border-radius: 8px;">
                            </div>
                            <div class="rs-post-overlay-content text-center">
                                <h3 class="rs-post-overlay-title is-white">No Featured Story</h3>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Right Side: 3 News (25% Width) --}}
                <div class="col-xl-3 col-lg-3 d-flex">
                    <div class="rs-banner-small-post">
                        <div class="rs-post-small rs-post-small-seventeen" id="hero-right">
                            @forelse($heroRight as $article)
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
                                            <a href="javascript:void(0)" class="post-tag is-green">
                                                {{ $article->category->name ?? 'News' }}
                                            </a>
                                        </div>
                                        <h6 class="rs-post-small-title underline">
                                            <a href="{{ route('news.show', $article->slug) }}">
                                                <!-- {{ \Illuminate\Support\Str::limit($article->title, 25) }} -->
                                                {{ $article->title }}
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
                /* Fixed width for sidebar thumbs */
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

            #heroCarousel {
                width: 100%;
                height: 100%;
            }

            #heroCarousel .carousel-inner {
                height: 100%;
            }

            #heroCarousel .carousel-item {
                height: 100%;
            }

            #hero-left,
            #hero-right {
                transition: opacity .4s ease;
            }

            .fade-item {
                animation: heroFade .5s ease;
            }

            @keyframes heroFade {
                from {
                    transform: translateY(15px);
                    opacity: 0;
                }

                to {
                    transform: translateY(0);
                    opacity: 1;
                }
            }
        </style>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const heroArticles = @json($heroAll);

            if (!heroArticles.length) return;

            const leftContainer = document.getElementById("hero-left");
            const rightContainer = document.getElementById("hero-right");


            const newsRoute = "{{ route('news.show', '__slug__') }}";

            function createArticleHTML(article) {

                const img = article.featured_image
                    ? "/storage/" + article.featured_image
                    : "/assets/images/default/news-placeholder.webp";

                const url = newsRoute.replace('__slug__', article.slug);

                const authorHTML = article.author
                    ? `<div class="rs-post-meta">
                            <ul>
                                <li>
                                    <span class="rs-meta">
                                        By <a href="#" class="meta-author">${article.author}</a>
                                    </span>
                                </li>
                            </ul>
                       </div>`
                    : "";

                return `
                    <div class="rs-post-small-item mb-20 fade-item">
                        <div class="rs-post-small-thumb">
                            <a href="${url}" class="image-link">
                                <img class="hero-side-image"
                                    src="${img}"
                                    alt="${article.title}">
                            </a>
                        </div>

                        <div class="rs-post-small-content">

                            <div class="rs-post-tag-two">
                                <a href="#" class="post-tag is-green">
                                    ${article.category}
                                </a>
                            </div>

                            <h6 class="rs-post-small-title underline">
                                <a href="${url}">
                                    ${article.title}
                                </a>
                            </h6>

                            ${authorHTML}

                        </div>

                    </div>`;
            }

            let index = 6; // first 6 already visible
            let side = "left";

            setInterval(function () {

                if (index >= heroArticles.length) {
                    index = 0;
                }

                const article = heroArticles[index];

                const target = side === "left" ? leftContainer : rightContainer;

                if (target.children.length >= 3) {
                    target.lastElementChild.remove();
                }

                target.insertAdjacentHTML("afterbegin", createArticleHTML(article));

                side = side === "left" ? "right" : "left";

                index++;

            }, 5000);

        });
    </script>
    <!-- hero area end -->

    <!-- video area start -->
    @php
        $videoNews = [
            [
                "subtitle" => "The Insider",
                "title" => "From beer baron to real baron – an interview with Lord Bilimoria",
                "url" => "https://youtu.be/p8Dgc0rgpeM?si=HrA4LnqDEo8J8sal",
                "excerpt" => "India-born Karan Bilimoria, founder of Cobra Beer, has spent his career promoting links between Britain and India.",
                "duration" => "30 min",
                "image" => "/assets/images/video.webp",
            ],
            // [
            //     "title" => "Top Strategies to Dominate Multiplayer Games",
            //     "url" => "https://www.youtube.com/watch?v=p8Dhe4SRvOs",
            // ],

            // [
            //     "title" => "Vintage Fashion Styles Making Comeback",
            //     "url" => "https://www.youtube.com/watch?v=SYQShy6ZwCw",
            // ],
        ];
        function youtubeId($url)
        {
            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $url, $m);
            return $m[1] ?? null;
        }

        $mainVideo = $videoNews[0];
        $mainId = youtubeId($mainVideo['url']);

    @endphp
    <section class="rs-video-area bg-primary section-space-bottom rs-ptop rs-video-one">
        <div class="container">

            <div class="row section-title-space align-items-center g-5">
                <div class="col-xl-6">
                    <div class="section-title-wrapper">
                        <h2 class="section-title is-white">
                            Highlight Stories
                        </h2>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                <!-- FEATURED VIDEO -->
                <div class="col-xl-8 col-lg-7">
                    <div class="rs-post-video-one">

                        <div class="row g-0 align-items-stretch" style="background:#000;border-radius:6px;overflow:hidden;">

                            <!-- LEFT: Thumbnail -->
                            <div class="col-md-6 position-relative">
                                <div id="featuredVideo" style="height:100%;">

                                    <img src="{{ !empty($mainVideo['image'])
        ? $mainVideo['image']
        : 'https://img.youtube.com/vi/' . $mainId . '/maxresdefault.jpg' }}" id="featuredThumbnail"
                                        style="width:100%;height:100%;object-fit:fill;">

                                    <a href="javascript:void(0)" onclick="playFeaturedVideo('{{ $mainId }}')"
                                        class="rs-play-btn is-red" id="featuredPlayBtn"
                                        style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);">
                                        <i class="ri-play-large-fill"></i>
                                    </a>

                                    <div id="youtubePlayer"></div>
                                </div>
                            </div>

                            <!-- RIGHT: Content -->
                            <div class="col-md-6 d-flex flex-column justify-content-center px-4 text-white"
                                style="padding-top:35px;padding-bottom:35px;">

                                <span style="font-size:15px;letter-spacing:1px;color:#aaa; text-align: center;">
                                    {{ $mainVideo['subtitle'] ?? 'The Insider' }}
                                </span>

                                <h3 class="section-title is-white"
                                    style="text-align: center; margin:10px 0; line-height: 1.3;">
                                    {{ $mainVideo['title'] }}
                                </h3>

                                <p style="color:white;font-size:18px;line-height:1.6; text-align: center;">
                                    {{ $mainVideo['excerpt'] ?? 'This is a short description for the featured video. You can control this from your PHP array.' }}
                                </p>

                                <div style="text-align:center; margin-top:10px;">
                                    <button onclick="playFeaturedVideo('{{ $mainId }}')" style="
                                                background:red;
                                                color:white;
                                                border:none;
                                                padding:12px 25px;
                                                border-radius:30px;
                                                font-size:14px;
                                                cursor:pointer;
                                                display:inline-flex;
                                                align-items:center;
                                                gap:8px;
                                            ">
                                        <i class="ri-play-fill"></i> Play Video
                                    </button>
                                </div>

                                <div style="margin-top:10px;font-size:13px;color:white; text-align: center;">
                                    {{ $mainVideo['duration'] ?? '30 min' }}
                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- RIGHT VIDEO LIST -->
                <div class="col-xl-4 col-lg-5">
                    @if(count($videoNews) > 1)
                        {{-- SHOW VIDEO LIST --}}
                        <div class="rs-post-video rs-post-video-three">
                            @foreach(array_slice($videoNews, 1) as $video)
                                        @php
                                            $id = youtubeId($video['url']);
                                        @endphp
                                        <div class="rs-post-video-item">
                                            <div class="rs-post-video-thumb">
                                                <a href="javascript:void(0)" onclick="playVideo('{{ $id }}')">
                                                    <img src="{{ !empty($video['image'])
                                ? asset($video['image'])
                                : 'https://img.youtube.com/vi/' . $id . '/hqdefault.jpg' }}"
                                                        alt="{{ $video['title'] }}">
                                                </a>
                                                <a href="javascript:void(0)" onclick="playVideo('{{ $id }}')"
                                                    class="rs-play-btn is-small is-red">
                                                    <i class="ri-play-large-fill"></i>
                                                </a>
                                            </div>

                                            <div class="rs-post-video-content">
                                                <h6 class="rs-post-video-title underline is-white">
                                                    <a href="javascript:void(0)" onclick="playVideo('{{ $id }}')">
                                                        {{ \Illuminate\Support\Str::limit($video['title'], 60) }}
                                                    </a>
                                                </h6>
                                            </div>
                                        </div>
                            @endforeach
                        </div>
                    @else

                        {{-- SHOW POPULAR ARTICLES --}}
                        @foreach($popularArticles as $popular)
                            <div class="rs-post-small-item d-flex align-items-center mb-20 pb-20"
                                style="border-bottom: 1px solid #f1f1f1;">
                                <div class="rs-post-small-thumb"
                                    style="flex: 0 0 80px;height:80px;border-radius:8px;overflow:hidden;margin-right:15px;">
                                    <a href="{{ route('news.show', $popular->slug) }}" class="image-link h-100">
                                        <img src="{{ $popular->featured_image ? asset('storage/' . $popular->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                            alt="{{ $popular->title }}" class="w-100 h-100 object-fit-cover">
                                    </a>
                                </div>

                                <div class="rs-post-small-content">
                                    <h6 class="rs-post-small-title"
                                        style="font-size:15px;font-weight:700;line-height:1.4;margin-bottom:8px;">
                                        <a href="{{ route('news.show', $popular->slug) }}"
                                            class="text-decoration-none transition-all"
                                            style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden; color:white;"
                                            onmouseover="this.style.color='white';" onmouseout="this.style.color='white';">
                                            {{ $popular->title }}
                                        </a>
                                    </h6>

                                    <div class="rs-post-meta d-flex align-items-center gap-3" style="font-size:12px;color:#888;">
                                        @if(!empty($popular->auther))
                                            <span class="rs-meta">By {{ $popular->auther }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    @endif

                </div>
            </div>
        </div>
    </section>
    <div id="videoModal"
        style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;
                                        background:rgba(0,0,0,0.9);z-index:9999;align-items:center;justify-content:center;">
        <div style="width:80%;max-width:900px;position:relative">
            <span onclick="closeVideo()"
                style="position:absolute;right:-10px;top:-40px;font-size:35px;color:white;cursor:pointer">
                ✕
            </span>
            <iframe id="videoFrame" width="100%" height="500" frameborder="0" allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>
        </div>
    </div>
    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        let player;
        let currentVideoId = null;

        function playFeaturedVideo(videoId) {

            currentVideoId = videoId;

            document.getElementById("featuredThumbnail").style.display = "none";
            document.getElementById("featuredPlayBtn").style.display = "none";

            document.getElementById("youtubePlayer").style.display = "block";

            if (!player) {

                player = new YT.Player('youtubePlayer', {
                    height: '420',
                    width: '100%',
                    videoId: videoId,
                    playerVars: {
                        autoplay: 1,
                        modestbranding: 1,
                        rel: 0
                    },
                    events: {
                        'onStateChange': onPlayerStateChange
                    }
                });

            } else {

                player.loadVideoById(videoId);

            }
        }

        function onPlayerStateChange(event) {

            if (event.data === YT.PlayerState.PAUSED || event.data === YT.PlayerState.ENDED) {

                showThumbnailAgain();

            }

        }

        function showThumbnailAgain() {

            const thumbnail = document.getElementById("featuredThumbnail");
            const playBtn = document.getElementById("featuredPlayBtn");
            const playerBox = document.getElementById("youtubePlayer");

            thumbnail.style.display = "block";
            playBtn.style.display = "flex";

            // reset play button styling
            playBtn.style.width = "70px";
            playBtn.style.height = "70px";
            playBtn.style.alignItems = "center";
            playBtn.style.justifyContent = "center";
            playBtn.style.borderRadius = "50%";

            // hide video iframe
            playerBox.style.display = "none";

            if (player) {
                player.stopVideo();
            }
        }
    </script>
    <!-- video area end -->

    <!-- DA Video section  -->
    <!-- @include('components.da-video-section') -->

    <!-- ad banner area start -->
    <!-- <div class="ad-banner-area rs-ad-banner-one section-space">
                                                                                            <div class="container">
                                                                                                <div class="row">
                                                                                                    <div class="col-12">
                                                                                                        <div class="rs-ad-banner-thumb">
                                                                                                                <a href="/plans"><img src="{{ asset('assets/images/ad/ad-1.webp') }}"
                                                                                                                        alt="image"></a>
                                                                                                            </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div> -->
    <!-- ad banner area end -->


    <!-- Politics news area start -->
    <section class="rs-trending-stories-area section-space-bottom rs-ptop rs-trending-stories-one secondary-bg">
        <div class="container">
            <div class="row section-title-space align-items-center g-5">
                <div class="col-xl-6 col-lg-6">

                    <div class="section-title-wrapper">
                        <h2 class="section-title rs-split-text-enable split-in-left is-black">
                            {{ $politicsCategory->name ?? 'Politics' }}
                        </h2>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="section-btn">
                        <a class="rs-btn has-text has-icon"
                            href="{{ route('category.show', $politicsCategory->slug ?? 'politics') }}">View All
                            <span class="icon-box">
                                <svg class="icon-first" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                        fill="#121213" />
                                </svg>
                                <svg class="icon-second" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                        fill="#121213" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                <div class="col-xl-8 col-lg-7">
                    <div class="rs-post-medium rs-post-medium-one">

                        @for($i = 0; $i < 7; $i++)
                            @if(isset($politicsArticles[$i]))
                                @php $article = $politicsArticles[$i]; @endphp
                                <div class="rs-post-medium-item">
                                    <div class="rs-post-medium-thumb">
                                        <a href="{{ route('news.show', $article->slug) }}" class="image-link"
                                            style="height: 240px;">
                                            <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                alt="{{ $article->title }}" style="height: 100%; width: 100%; object-fit: cover;">
                                        </a>
                                    </div>
                                    <div class="rs-post-medium-content">
                                        <div class="rs-post-medium-top">
                                            <div class="rs-post-tag">
                                                <a href="javascript:void(0)" class="post-tag">
                                                    {{ $article->category->name ?? 'News' }}
                                                </a>
                                            </div>
                                            <h5 class="rs-post-medium-title underline">
                                                <a href="{{ route('news.show', $article->slug) }}">
                                                    {{ \Illuminate\Support\Str::limit($article->title, 65) }}
                                                </a>
                                            </h5>
                                            <p class="rs-post-description">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($article->excerpt ?? $article->content), 140) }}
                                            </p>
                                        </div>
                                        <div class="rs-post-medium-bottom">
                                            <div class="rs-post-meta">
                                                <ul>
                                                    @if(!empty($article->auther))
                                                        <li>
                                                            <span class="rs-meta">
                                                                By <a href="javascript:void(0)" class="meta-author">
                                                                    {{ $article->auther }}
                                                                </a>
                                                            </span>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <span class="rs-meta">
                                                            <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M4.33447 3.8335C4.06114 3.8335 3.83447 3.60683 3.83447 3.3335V1.3335C3.83447 1.06016 4.06114 0.833496 4.33447 0.833496C4.60781 0.833496 4.83447 1.06016 4.83447 1.3335V3.3335C4.83447 3.60683 4.60781 3.8335 4.33447 3.8335ZM9.66781 3.8335C9.39447 3.8335 9.16781 3.60683 9.16781 3.3335V1.3335C9.16781 1.06016 9.39447 0.833496 9.66781 0.833496C9.94114 0.833496 10.1678 1.06016 10.1678 1.3335V3.3335C10.1678 3.60683 9.94114 3.8335 9.66781 3.8335ZM4.66781 9.66683C4.58114 9.66683 4.49447 9.64683 4.41447 9.6135C4.32781 9.58016 4.26114 9.5335 4.19447 9.4735C4.07447 9.34683 4.00114 9.18016 4.00114 9.00016C4.00114 8.9135 4.02114 8.82683 4.05447 8.74683C4.08781 8.66683 4.13447 8.5935 4.19447 8.52683C4.26114 8.46683 4.32781 8.42016 4.41447 8.38683C4.65447 8.28683 4.95447 8.34016 5.14114 8.52683C5.26114 8.6535 5.33447 8.82683 5.33447 9.00016C5.33447 9.04016 5.32781 9.08683 5.32114 9.1335C5.31447 9.1735 5.30114 9.2135 5.28114 9.2535C5.26781 9.2935 5.24781 9.3335 5.22114 9.3735C5.20114 9.40683 5.16781 9.44016 5.14114 9.4735C5.01447 9.5935 4.84114 9.66683 4.66781 9.66683ZM7.00114 9.66683C6.91447 9.66683 6.82781 9.64683 6.74781 9.6135C6.66114 9.58016 6.59447 9.5335 6.52781 9.4735C6.40781 9.34683 6.33447 9.18016 6.33447 9.00016C6.33447 8.9135 6.35447 8.82683 6.38781 8.74683C6.42114 8.66683 6.46781 8.5935 6.52781 8.52683C6.59447 8.46683 6.66114 8.42016 6.74781 8.38683C6.98781 8.28016 7.28781 8.34016 7.47447 8.52683C7.59447 8.6535 7.66781 8.82683 7.66781 9.00016C7.66781 9.04016 7.66114 9.08683 7.65447 9.1335C7.64781 9.1735 7.63447 9.2135 7.61447 9.2535C7.60114 9.2935 7.58114 9.3335 7.55447 9.3735C7.53447 9.40683 7.50114 9.44016 7.47447 9.4735C7.34781 9.5935 7.17447 9.66683 7.00114 9.66683ZM9.33447 9.66683C9.24781 9.66683 9.16114 9.64683 9.08114 9.6135C8.99447 9.58016 8.92781 9.5335 8.86114 9.4735L8.78114 9.3735C8.75589 9.33635 8.73571 9.29599 8.72114 9.2535C8.70188 9.21572 8.6884 9.17527 8.68114 9.1335C8.67447 9.08683 8.66781 9.04016 8.66781 9.00016C8.66781 8.82683 8.74114 8.6535 8.86114 8.52683C8.92781 8.46683 8.99447 8.42016 9.08114 8.38683C9.32781 8.28016 9.62114 8.34016 9.80781 8.52683C9.92781 8.6535 10.0011 8.82683 10.0011 9.00016C10.0011 9.04016 9.99447 9.08683 9.98781 9.1335C9.98114 9.1735 9.96781 9.2135 9.94781 9.2535C9.93447 9.2935 9.91447 9.3335 9.88781 9.3735C9.86781 9.40683 9.83447 9.44016 9.80781 9.4735C9.68114 9.5935 9.50781 9.66683 9.33447 9.66683ZM4.66781 12.0002C4.58114 12.0002 4.49447 11.9802 4.41447 11.9468C4.33447 11.9135 4.26114 11.8668 4.19447 11.8068C4.07447 11.6802 4.00114 11.5068 4.00114 11.3335C4.00114 11.2468 4.02114 11.1602 4.05447 11.0802C4.08781 10.9935 4.13447 10.9202 4.19447 10.8602C4.44114 10.6135 4.89447 10.6135 5.14114 10.8602C5.26114 10.9868 5.33447 11.1602 5.33447 11.3335C5.33447 11.5068 5.26114 11.6802 5.14114 11.8068C5.01447 11.9268 4.84114 12.0002 4.66781 12.0002ZM7.00114 12.0002C6.82781 12.0002 6.65447 11.9268 6.52781 11.8068C6.40781 11.6802 6.33447 11.5068 6.33447 11.3335C6.33447 11.2468 6.35447 11.1602 6.38781 11.0802C6.42114 10.9935 6.46781 10.9202 6.52781 10.8602C6.77447 10.6135 7.22781 10.6135 7.47447 10.8602C7.53447 10.9202 7.58114 10.9935 7.61447 11.0802C7.64781 11.1602 7.66781 11.2468 7.66781 11.3335C7.66781 11.5068 7.59447 11.6802 7.47447 11.8068C7.34781 11.9268 7.17447 12.0002 7.00114 12.0002ZM9.33447 12.0002C9.16114 12.0002 8.98781 11.9268 8.86114 11.8068C8.79945 11.7442 8.75174 11.6692 8.72114 11.5868C8.68781 11.5068 8.66781 11.4202 8.66781 11.3335C8.66781 11.2468 8.68781 11.1602 8.72114 11.0802C8.75447 10.9935 8.80114 10.9202 8.86114 10.8602C9.01447 10.7068 9.24781 10.6335 9.46114 10.6802C9.50781 10.6868 9.54781 10.7002 9.58781 10.7202C9.62781 10.7335 9.66781 10.7535 9.70781 10.7802C9.74114 10.8002 9.77447 10.8335 9.80781 10.8602C9.92781 10.9868 10.0011 11.1602 10.0011 11.3335C10.0011 11.5068 9.92781 11.6802 9.80781 11.8068C9.68114 11.9268 9.50781 12.0002 9.33447 12.0002ZM12.6678 6.56016H1.33447C1.06114 6.56016 0.834473 6.3335 0.834473 6.06016C0.834473 5.78683 1.06114 5.56016 1.33447 5.56016H12.6678C12.9411 5.56016 13.1678 5.78683 13.1678 6.06016C13.1678 6.3335 12.9411 6.56016 12.6678 6.56016Z"
                                                                    fill="white"></path>
                                                                <path
                                                                    d="M9.66667 15.1668H4.33333C1.9 15.1668 0.5 13.7668 0.5 11.3335V5.66683C0.5 3.2335 1.9 1.8335 4.33333 1.8335H9.66667C12.1 1.8335 13.5 3.2335 13.5 5.66683V11.3335C13.5 13.7668 12.1 15.1668 9.66667 15.1668ZM4.33333 2.8335C2.42667 2.8335 1.5 3.76016 1.5 5.66683V11.3335C1.5 13.2402 2.42667 14.1668 4.33333 14.1668H9.66667C11.5733 14.1668 12.5 13.2402 12.5 11.3335V5.66683C12.5 3.76016 11.5733 2.8335 9.66667 2.8335H4.33333Z"
                                                                    fill="white"></path>
                                                            </svg>
                                                            <span>{{ $article->published_at ? $article->published_at->format('F Y') : '' }}</span>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>

                    <div class="rs-trending-stories-btn text-center mt-40">
                        <a class="rs-btn has-icon has-bg-white"
                            href="{{ route('category.show', $politicsCategory->slug ?? 'politics') }}">Load More News
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M1.25 8C1.25 8.14918 1.19074 8.29226 1.08525 8.39775C0.979758 8.50324 0.836684 8.5625 0.6875 8.5625C0.538316 8.5625 0.395242 8.50324 0.289752 8.39775C0.184263 8.29226 0.125 8.14918 0.125 8C0.125 3.65764 3.65764 0.125 8 0.125C10.1644 0.125 12.167 0.987453 13.625 2.47245V0.6875C13.625 0.538316 13.6843 0.395242 13.7898 0.289752C13.8952 0.184263 14.0383 0.125 14.1875 0.125C14.3367 0.125 14.4798 0.184263 14.5852 0.289752C14.6907 0.395242 14.75 0.538316 14.75 0.6875V4.0625C14.75 4.21168 14.6907 4.35476 14.5852 4.46025C14.4798 4.56574 14.3367 4.625 14.1875 4.625H10.8125C10.6633 4.625 10.5202 4.56574 10.4148 4.46025C10.3093 4.35476 10.25 4.21168 10.25 4.0625C10.25 3.91332 10.3093 3.77024 10.4148 3.66475C10.5202 3.55926 10.6633 3.5 10.8125 3.5H13.0496C11.7875 2.08025 9.97184 1.25 8 1.25C4.27808 1.25 1.25 4.27808 1.25 8ZM15.3125 7.4375C15.1633 7.4375 15.0202 7.49676 14.9148 7.60225C14.8093 7.70774 14.75 7.85082 14.75 8C14.75 11.7219 11.7219 14.75 8 14.75C6.02816 14.75 4.21255 13.9197 2.95044 12.5H5.1875C5.33668 12.5 5.47976 12.4407 5.58525 12.3352C5.69074 12.2298 5.75 12.0867 5.75 11.9375C5.75 11.7883 5.69074 11.6452 5.58525 11.5398C5.47976 11.4343 5.33668 11.375 5.1875 11.375H1.8125C1.66332 11.375 1.52024 11.4343 1.41475 11.5398C1.30926 11.6452 1.25 11.7883 1.25 11.9375V15.3125C1.25 15.4617 1.30926 15.6048 1.41475 15.7102C1.52024 15.8157 1.66332 15.875 1.8125 15.875C1.96168 15.875 2.10476 15.8157 2.21025 15.7102C2.31574 15.6048 2.375 15.4617 2.375 15.3125V13.5275C3.833 15.0125 5.83564 15.875 8 15.875C12.3424 15.875 15.875 12.3424 15.875 8C15.875 7.85082 15.8157 7.70774 15.7102 7.60225C15.6048 7.49676 15.4617 7.4375 15.3125 7.4375Z"
                                    fill="#121213" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <div class="rs-sidebar-wrapper rs-sidebar-sticky">
                        <div class="rs-sidebar mb-30">
                            <div class="rs-categories rs-categories-one">
                                <h5 class="section-title is-small">Explore Categories</h5>
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <a href="{{ route('category.show', $category->slug) }}"
                                                class="rs-categories-bg-thumb"
                                                style="background-image: url('{{ $category->images ? asset($category->images) : asset('assets/images/categories/categories-thumb-01.webp') }}')">

                                                <span class="rs-categories-name">
                                                    {{ $category->name }}
                                                    {{-- Use the count from withCount or the manual query --}}
                                                    ({{ $category->articles_count ?? $category->articles()->where('status', 'published')->count() }})
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

                        {{-- <div class="rs-sidebar mb-30">
                            <div class="rs-post-small rs-post-small-five">
                                <h5 class="section-title is-small">Latest Stories</h5>

                                @foreach($popularArticles as $article)
                                <div class="rs-post-small-item">
                                    <div class="rs-post-small-thumb">
                                        <a href="{{ route('news.show', $article->slug) }}" class="image-link">
                                            <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                alt="{{ $article->title }}">
                                        </a>
                                    </div>
                                    <div class="rs-post-small-content">
                                        <div class="rs-post-tag">
                                            <a href="javascript:void(0)" class="post-tag is-green">
                                                {{ $article->category->name ?? 'News' }}
                                            </a>
                                        </div>
                                        <h6 class="rs-post-small-title underline">
                                            <a href="{{ route('news.show', $article->slug) }}">
                                                {{ \Illuminate\Support\Str::limit($article->title, 45) }}
                                            </a>
                                        </h6>
                                        <div class="rs-post-meta">
                                            <ul>
                                                <li>
                                                    <span class="rs-meta">
                                                        By <a href="javascript:void(0)" class="meta-author">
                                                            {{ $article->auther ?? 'Admin' }}
                                                        </a>
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div> --}}

                        <!-- <div class="rs-sidebar">
                                                                                                                    <div class="rs-social rs-social-one">
                                                                                                                        <h5 class="section-title is-small">Follow Us</h5>
                                                                                                                        <ul class="rs-social-wrapper">
                                                                                                                            <li class="rs-social-item">
                                                                                                                                <a href="#">
                                                                                                                                    <span class="rs-social-label">
                                                                                                                                        <span class="rs-social-icon">
                                                                                                                                            <svg width="14" height="22" viewBox="0 0 14 22" fill="none"
                                                                                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                <path
                                                                                                                                                    d="M11.624 11.9541L12.193 8.54137L8.63572 8.54137V6.32676C8.63572 5.39311 9.13264 4.48303 10.7258 4.48303H12.343V1.57748C12.343 1.57748 10.8755 1.34692 9.47233 1.34692C6.54282 1.34692 4.62796 2.98146 4.62796 5.94041L4.62796 8.54137H1.37158L1.37158 11.9541H4.62796L4.62796 20.2041H8.63572L8.63572 11.9541H11.624Z"
                                                                                                                                                    fill="white" />
                                                                                                                                            </svg>
                                                                                                                                        </span>
                                                                                                                                        <span class="rs-social-name">Facebook</span>
                                                                                                                                    </span>
                                                                                                                                    <span class="rs-social-count">88.2k Followers</span>
                                                                                                                                </a>
                                                                                                                            </li>
                                                                                                                            <li class="rs-social-item">
                                                                                                                                <a href="#">
                                                                                                                                    <span class="rs-social-label">
                                                                                                                                        <span class="rs-social-icon">
                                                                                                                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                <path
                                                                                                                                                    d="M9.35332 6.88729L14.6472 0.733521H13.3928L8.79603 6.07675L5.12465 0.733521H0.890137L6.44199 8.81343L0.890137 15.2666H2.1447L6.99896 9.62397L10.8762 15.2666H15.1107L9.35332 6.88729ZM7.63502 8.88462L7.0725 8.08004L2.59674 1.67793H4.52367L8.13567 6.84464L8.69818 7.64922L13.3933 14.3651H11.4664L7.63502 8.88462Z"
                                                                                                                                                    fill="white" />
                                                                                                                                            </svg>
                                                                                                                                        </span>
                                                                                                                                        <span class="rs-social-name">Twitter - X</span>
                                                                                                                                    </span>
                                                                                                                                    <span class="rs-social-count">48.6k Followers</span>
                                                                                                                                </a>
                                                                                                                            </li>
                                                                                                                            <li class="rs-social-item">
                                                                                                                                <a href="#">
                                                                                                                                    <span class="rs-social-label">
                                                                                                                                        <span class="rs-social-icon">
                                                                                                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                                                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                <path
                                                                                                                                                    d="M13.6283 19.3083C13.645 19.3033 13.6608 19.2967 13.6775 19.2908C23.8567 15.2467 21.0408 0 10 0C4.45917 0 0 4.51667 0 10C0 16.9392 7.02833 21.8908 13.6283 19.3083ZM4.40083 16.7158C5.11083 15.5225 7.40833 12.1558 11.33 10.9942C12.2429 13.3207 12.7345 15.7912 12.7817 18.29C11.3672 18.7696 9.85294 18.8767 8.385 18.601C6.91706 18.3253 5.54491 17.676 4.40083 16.7158ZM14.0108 17.7683C13.9187 15.355 13.4375 12.9724 12.5858 10.7125C14.3208 10.4417 16.3292 10.6225 18.6067 11.535C18.3689 12.8565 17.8309 14.1057 17.0341 15.1864C16.2373 16.2672 15.2029 17.1505 14.0108 17.7683ZM18.7375 10.2425C16.2292 9.3 14.0183 9.1825 12.105 9.5475C11.8092 8.88083 11.4983 8.24 11.1692 7.65C14.105 6.4775 15.84 5.04833 16.6167 4.29167C18.0497 5.93631 18.8073 8.06225 18.7375 10.2425ZM15.7292 3.40167C15.0225 4.07417 13.3583 5.4325 10.5125 6.54333C9.1175 4.33667 7.62583 2.78 6.68083 1.90833C8.17845 1.28978 9.81908 1.10183 11.4178 1.36568C13.0165 1.62953 14.5097 2.33469 15.7292 3.40167ZM5.48583 2.51917C6.19917 3.14667 7.765 4.65333 9.27583 6.98333C7.20083 7.65167 4.59917 8.1425 1.435 8.21167C1.93833 5.8 3.44167 3.75667 5.48583 2.51917ZM1.27667 9.46667C4.81833 9.40917 7.685 8.85 9.95083 8.09333C10.2642 8.6425 10.5617 9.24083 10.8475 9.8625C6.90167 11.1192 4.43583 14.3633 3.49167 15.8283C2.71507 14.9704 2.11881 13.9652 1.7383 12.8724C1.3578 11.7795 1.20081 10.6214 1.27667 9.46667Z"
                                                                                                                                                    fill="white" />
                                                                                                                                            </svg>
                                                                                                                                        </span>
                                                                                                                                        <span class="rs-social-name">Dribbble</span>
                                                                                                                                    </span>
                                                                                                                                    <span class="rs-social-count">39.5k Followers</span>
                                                                                                                                </a>
                                                                                                                            </li>
                                                                                                                            <li class="rs-social-item">
                                                                                                                                <a href="#">
                                                                                                                                    <span class="rs-social-label">
                                                                                                                                        <span class="rs-social-icon">
                                                                                                                                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none"
                                                                                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                <path
                                                                                                                                                    d="M6.61654 13.2282C6.09154 15.9813 5.45013 18.6212 3.55013 20.0001C2.9638 15.8384 4.41146 12.713 5.08334 9.39502C3.93724 7.46533 5.22123 3.58252 7.6388 4.53955C10.6134 5.71611 5.06302 11.7126 8.7892 12.4614C12.6798 13.2431 14.2677 5.71104 11.8556 3.26182C8.36966 -0.275292 1.70873 3.18096 2.52787 8.24502C2.72709 9.48291 4.00638 9.85869 3.03919 11.5669C0.807945 11.0724 0.142319 9.31299 0.227866 6.96729C0.365757 3.12744 3.67787 0.439161 7.00013 0.0672862C11.2013 -0.403026 15.1443 1.60947 15.6888 5.56182C16.3021 10.0224 13.7923 14.8532 9.30013 14.506C8.08216 14.4114 7.57123 13.8079 6.61654 13.2282Z"
                                                                                                                                                    fill="white" />
                                                                                                                                            </svg>
                                                                                                                                        </span>
                                                                                                                                        <span class="rs-social-name">Pinterest</span>
                                                                                                                                    </span>
                                                                                                                                    <span class="rs-social-count">28.2k Followers</span>
                                                                                                                                </a>
                                                                                                                            </li>
                                                                                                                            <li class="rs-social-item">
                                                                                                                                <a href="#">
                                                                                                                                    <span class="rs-social-label">
                                                                                                                                        <span class="rs-social-icon">
                                                                                                                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                                                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                <path
                                                                                                                                                    d="M17.7973 17.7992V11.3532C17.7973 8.18522 17.1153 5.76522 13.4193 5.76522C11.6373 5.76522 10.4493 6.73322 9.96527 7.65722H9.92126V6.05122H6.42326V17.7992H10.0753V11.9692C10.0753 10.4292 10.3613 8.95522 12.2533 8.95522C14.1233 8.95522 14.1453 10.6932 14.1453 12.0572V17.7772H17.7973V17.7992ZM0.483266 6.05122H4.13527V17.7992H0.483266V6.05122ZM2.30927 0.199219C1.14327 0.199219 0.197266 1.14522 0.197266 2.31122C0.197266 3.47722 1.14327 4.44522 2.30927 4.44522C3.47527 4.44522 4.42127 3.47722 4.42127 2.31122C4.42127 1.14522 3.47527 0.199219 2.30927 0.199219Z"
                                                                                                                                                    fill="white" />
                                                                                                                                            </svg>
                                                                                                                                        </span>
                                                                                                                                        <span class="rs-social-name">LinkedIn</span>
                                                                                                                                    </span>
                                                                                                                                    <span class="rs-social-count">30.3k Followers</span>
                                                                                                                                </a>
                                                                                                                            </li>
                                                                                                                            <li class="rs-social-item">
                                                                                                                                <a href="#">
                                                                                                                                    <span class="rs-social-label">
                                                                                                                                        <span class="rs-social-icon">
                                                                                                                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                                                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                                                                                <path
                                                                                                                                                    d="M17.6045 5.45036C17.5641 4.53485 17.4161 3.9055 17.204 3.3601C16.9852 2.78121 16.6486 2.26294 16.2077 1.83208C15.7768 1.39452 15.2551 1.0545 14.6829 0.839154C14.1344 0.627106 13.5083 0.479009 12.5928 0.438686C11.6705 0.394863 11.3777 0.384766 9.03843 0.384766C6.69917 0.384766 6.40637 0.394863 5.48747 0.435253C4.57199 0.475643 3.94261 0.623808 3.39738 0.835721C2.81832 1.0545 2.30005 1.39108 1.86919 1.83208C1.43163 2.26291 1.09178 2.78461 0.876264 3.3568C0.664216 3.9055 0.516152 4.53148 0.475796 5.44692C0.432006 6.36927 0.421875 6.66206 0.421875 9.00132C0.421875 11.3406 0.432006 11.6334 0.472363 12.5523C0.512753 13.4678 0.660917 14.0971 0.872999 14.6425C1.09178 15.2214 1.43163 15.7397 1.86919 16.1706C2.30005 16.6081 2.82175 16.9481 3.39395 17.1635C3.94258 17.3755 4.56856 17.5236 5.4842 17.564C6.40294 17.6045 6.6959 17.6144 9.03516 17.6144C11.3744 17.6144 11.6672 17.6045 12.5861 17.564C13.5016 17.5236 14.131 17.3756 14.6762 17.1635C15.2489 16.9421 15.7689 16.6035 16.2031 16.1693C16.6372 15.7352 16.9759 15.2152 17.1973 14.6425C17.4092 14.0939 17.5574 13.4678 17.5978 12.5523C17.6382 11.6334 17.6483 11.3406 17.6483 9.00132C17.6483 6.66206 17.6449 6.36923 17.6045 5.45036ZM16.0529 12.485C16.0159 13.3264 15.8745 13.7808 15.7567 14.0837C15.4672 14.8343 14.8715 15.4301 14.1208 15.7196C13.8179 15.8374 13.3603 15.9787 12.5221 16.0157C11.6133 16.0562 11.3408 16.0662 9.04186 16.0662C6.74296 16.0662 6.46699 16.0562 5.56148 16.0157C4.72002 15.9787 4.26563 15.8374 3.96271 15.7196C3.5892 15.5815 3.24922 15.3628 2.97322 15.0767C2.68712 14.7973 2.46834 14.4607 2.33027 14.0872C2.21247 13.7842 2.07114 13.3264 2.03421 12.4884C1.99369 11.5796 1.98373 11.3069 1.98373 9.00802C1.98373 6.70911 1.99369 6.43315 2.03421 5.5278C2.07114 4.68634 2.21247 4.23196 2.33027 3.92903C2.46834 3.55535 2.68712 3.21544 2.97665 2.93937C3.25588 2.65328 3.59246 2.4345 3.96614 2.2966C4.26907 2.17879 4.72689 2.03743 5.56491 2.00037C6.47369 1.95998 6.74639 1.94988 9.04513 1.94988C11.3475 1.94988 11.62 1.95998 12.5255 2.00037C13.367 2.03746 13.8214 2.17876 14.1243 2.29656C14.4978 2.4345 14.8378 2.65328 15.1138 2.93937C15.3999 3.21877 15.6186 3.55535 15.7567 3.92903C15.8745 4.23196 16.0159 4.68961 16.0529 5.5278C16.0933 6.43658 16.1034 6.70911 16.1034 9.00802C16.1034 11.3069 16.0933 11.5762 16.0529 12.485Z"
                                                                                                                                                    fill="white" />
                                                                                                                                                <path
                                                                                                                                                    d="M9.0335 4.57741C6.58997 4.57741 4.60742 6.55982 4.60742 9.00349C4.60742 11.4472 6.58997 13.4296 9.0335 13.4296C11.4771 13.4296 13.4596 11.4472 13.4596 9.00349C13.4596 6.55982 11.4771 4.57741 9.0335 4.57741ZM9.0335 11.8746C7.44826 11.8746 6.16237 10.5889 6.16237 9.00349C6.16237 7.41811 7.44826 6.13243 9.03347 6.13243C10.6188 6.13243 11.9046 7.41811 11.9046 9.00349C11.9046 10.5889 10.6188 11.8746 9.0335 11.8746ZM14.668 4.40239C14.668 4.97303 14.2053 5.4357 13.6345 5.4357C13.0639 5.4357 12.6013 4.97303 12.6013 4.40239C12.6013 3.83167 13.0639 3.36914 13.6346 3.36914C14.2053 3.36914 14.668 3.83164 14.668 4.40239Z"
                                                                                                                                                    fill="white" />
                                                                                                                                            </svg>
                                                                                                                                        </span>
                                                                                                                                        <span class="rs-social-name">Instagram</span>
                                                                                                                                    </span>
                                                                                                                                    <span class="rs-social-count">24.5k Followers</span>
                                                                                                                                </a>
                                                                                                                            </li>
                                                                                                                        </ul>
                                                                                                                    </div>
                                                                                                                </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Politics nes area end -->

    <!-- Asia In Brief area start -->
    <!-- @if($asiaInBriefCategory && $asiaInBriefArticles->count())
                                                                            <section class="rs-popular-news-area section-space-bottom rs-ptop bg-primary">
                                                                                <div class="container">
                                                                                    <div class="row section-title-space align-items-center g-5">
                                                                                        <div class="col-xl-6 col-lg-6">
                                                                                            <div class="section-title-wrapper">
                                                                                                <h2 class="section-title rs-split-text-enable split-in-left is-white">
                                                                                                    {{ $asiaInBriefCategory->name }}
                                                                                                </h2>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xl-6 col-lg-6">
                                                                                            <div class="section-btn d-flex justify-content-lg-end">
                                                                                                <a class="rs-btn has-text has-icon is-text-white"
                                                                                                    href="{{ route('category.show', $asiaInBriefCategory->slug) }}">
                                                                                                    View All
                                                                                                    <span class="icon-box">
                                                                                                    </span>
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    {{-- Added justify-content-center here --}}
                                                                                    <div class="row g-5 justify-content-center">
                                                                                        @foreach($asiaInBriefArticles as $article)
                                                                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                                                                <div class="rs-post-overlay rs-post-overlay-four">
                                                                                                    <a href="{{ route('news.show', $article->slug) }}">
                                                                                                        <div class="rs-post-overlay-bg-thumb" style="background-image: url('{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}'); 
                                                                                                                                                           background-size: cover; 
                                                                                                                                                           background-position: center;">
                                                                                                        </div>
                                                                                                    </a>

                                                                                                    <div class="rs-post-overlay-content">

                                                                                                        <h5 class="rs-post-overlay-title is-white underline">
                                                                                                            <a href="{{ route('news.show', $article->slug) }}">
                                                                                                                {{ \Illuminate\Support\Str::limit($article->title, 40) }}
                                                                                                            </a>
                                                                                                        </h5>

                                                                                                        <div class="rs-post-meta meta-white">
                                                                                                            <ul>
                                                                                                                @if(!empty($article->auther))
                                                                                                                    <li>
                                                                                                                        <span class="rs-meta">
                                                                                                                            By <a href="javascript:void(0)"
                                                                                                                                class="meta-author">{{ $article->auther ?? 'Admin' }}</a>
                                                                                                                        </span>
                                                                                                                    </li>
                                                                                                                @endif
                                                                                                                <li>
                                                                                                                    <span class="rs-meta">
                                                                                                                        <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                                                                            <path
                                                                                                                                d="M4.33447 3.8335C4.06114 3.8335 3.83447 3.60683 3.83447 3.3335V1.3335C3.83447 1.06016 4.06114 0.833496 4.33447 0.833496C4.60781 0.833496 4.83447 1.06016 4.83447 1.3335V3.3335C4.83447 3.60683 4.60781 3.8335 4.33447 3.8335ZM9.66781 3.8335C9.39447 3.8335 9.16781 3.60683 9.16781 3.3335V1.3335C9.16781 1.06016 9.39447 0.833496 9.66781 0.833496C9.94114 0.833496 10.1678 1.06016 10.1678 1.3335V3.3335C10.1678 3.60683 9.94114 3.8335 9.66781 3.8335ZM12.6678 6.56016H1.33447C1.06114 6.56016 0.834473 6.3335 0.834473 6.06016C0.834473 5.78683 1.06114 5.56016 1.33447 5.56016H12.6678C12.9411 5.56016 13.1678 5.78683 13.1678 6.06016C13.1678 6.3335 12.9411 6.56016 12.6678 6.56016Z"
                                                                                                                                fill="white"></path>
                                                                                                                            <path
                                                                                                                                d="M9.66667 15.1668H4.33333C1.9 15.1668 0.5 13.7668 0.5 11.3335V5.66683C0.5 3.2335 1.9 1.8335 4.33333 1.8335H9.66667C12.1 1.8335 13.5 3.2335 13.5 5.66683V11.3335C13.5 13.7668 12.1 15.1668 9.66667 15.1668ZM4.33333 2.8335C2.42667 2.8335 1.5 3.76016 1.5 5.66683V11.3335C1.5 13.2402 2.42667 14.1668 4.33333 14.1668H9.66667C11.5733 14.1668 12.5 13.2402 12.5 11.3335V5.66683C12.5 3.76016 11.5733 2.8335 9.66667 2.8335H4.33333Z"
                                                                                                                                fill="white"></path>
                                                                                                                        </svg>
                                                                                                                        <span>{{ optional($article->published_at)->format('M, Y') }}</span>
                                                                                                                    </span>
                                                                                                                </li>
                                                                                                            </ul>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>
                                                                            </section>
                                                                        @endif -->
    <!-- Asia In Brief area end -->

    <!-- Lifestyle category start -->
    @if($lifestyleCategory && $lifestyleArticles->count())
        <section class="rs-trending-news-area section-space-bottom rs-ptop rs-trending-news-three">
            <div class="container">
                <div class="row section-title-space align-items-center g-5">
                    <div class="col-xl-6 col-lg-6">
                        <div class="section-title-wrapper">
                            <h2 class="section-title rs-split-text-enable split-in-left">
                                {{ $lifestyleCategory->name }}
                            </h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="section-btn d-flex justify-content-lg-end">
                            <a class="rs-btn has-text has-icon" href="{{ route('category.show', $lifestyleCategory->slug) }}">
                                View All
                                <span class="icon-box">
                                    <svg class="icon-first" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                            fill="#121213" />
                                    </svg>
                                    <svg class="icon-second" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                            fill="#121213" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                @if(isset($lifestyleArticles[0]))
                    <div class="row g-5">
                        <div class="{{ count($lifestyleArticles) > 1 ? 'col-xl-4' : 'col-xl-12' }}">
                            <div style="height: 100%;" class="rs-post-overlay rs-post-overlay-one featured-category-post">
                                <a href="{{ route('news.show', $lifestyleArticles[0]->slug) }}">
                                    <div class="rs-post-overlay-bg-thumb"
                                        data-background="{{ $lifestyleArticles[0]->featured_image ? asset('storage/' . $lifestyleArticles[0]->featured_image) : asset('assets/images/default/news-placeholder.webp') }}">
                                    </div>
                                </a>

                                <div class="rs-post-overlay-content">

                                    <h5 class="rs-post-overlay-title is-white underline">
                                        <a href="{{ route('news.show', $lifestyleArticles[0]->slug) }}">
                                            {{ \Illuminate\Support\Str::limit($lifestyleArticles[0]->title, 55) }}
                                        </a>
                                    </h5>

                                    <div class="rs-post-meta meta-white">
                                        <ul>
                                            @if(!empty($lifestyleArticles[0]->auther))
                                                <li>
                                                    <span class="rs-meta">
                                                        By <a href="javascript:void(0)"
                                                            class="meta-author">{{ $lifestyleArticles[0]->auther }}</a>
                                                    </span>
                                                </li>
                                            @endif
                                            <li>
                                                <span class="rs-meta">
                                                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M4.33447 3.8335C4.06114 3.8335 3.83447 3.60683 3.83447 3.3335V1.3335C3.83447 1.06016 4.06114 0.833496 4.33447 0.833496C4.60781 0.833496 4.83447 1.06016 4.83447 1.3335V3.3335C4.83447 3.60683 4.60781 3.8335 4.33447 3.8335ZM9.66781 3.8335C9.39447 3.8335 9.16781 3.60683 9.16781 3.3335V1.3335C9.16781 1.06016 9.39447 0.833496 9.66781 0.833496C9.94114 0.833496 10.1678 1.06016 10.1678 1.3335V3.3335C10.1678 3.60683 9.94114 3.8335 9.66781 3.8335ZM12.6678 6.56016H1.33447C1.06114 6.56016 0.834473 6.3335 0.834473 6.06016C0.834473 5.78683 1.06114 5.56016 1.33447 5.56016H12.6678C12.9411 5.56016 13.1678 5.78683 13.1678 6.06016C13.1678 6.3335 12.9411 6.56016 12.6678 6.56016Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.66667 15.1668H4.33333C1.9 15.1668 0.5 13.7668 0.5 11.3335V5.66683C0.5 3.2335 1.9 1.8335 4.33333 1.8335H9.66667C12.1 1.8335 13.5 3.2335 13.5 5.66683V11.3335C13.5 13.7668 12.1 15.1668 9.66667 15.1668ZM4.33333 2.8335C2.42667 2.8335 1.5 3.76016 1.5 5.66683V11.3335C1.5 13.2402 2.42667 14.1668 4.33333 14.1668H9.66667C11.5733 14.1668 12.5 13.2402 12.5 11.3335V5.66683C12.5 3.76016 11.5733 2.8335 9.66667 2.8335H4.33333Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <span>{{ $lifestyleArticles[0]->published_at ? $lifestyleArticles[0]->published_at->format('F Y') : '' }}</span>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(count($lifestyleArticles) > 1)
                            <div class="col-xl-8">
                                <div class="rs-post-small-nineteen">
                                    <div class="rs-post-small-wrapper">
                                        @foreach($lifestyleArticles->slice(1, 8) as $article)
                                            <div class="rs-post-small">
                                                <div class="rs-post-small-thumb">
                                                    <a href="{{ route('news.show', $article->slug) }}" class="image-link">
                                                        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                            alt="{{ $article->title }}">
                                                    </a>
                                                </div>
                                                <div class="rs-post-small-content">
                                                    <h6 class="rs-post-small-title underline">
                                                        <a href="{{ route('news.show', $article->slug) }}">
                                                            {{ \Illuminate\Support\Str::limit($article->title, 55) }}
                                                        </a>
                                                    </h6>
                                                    @if(!empty($article->auther))
                                                        <div class="rs-post-meta">
                                                            <ul>
                                                                <li>
                                                                    <span class="rs-meta">
                                                                        By <a href="javascript:void(0)"
                                                                            class="meta-author">{{ $article->auther }}</a>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </section>
    @endif
    <!-- Lifestyle category end -->

    <!-- Monthly Edition category start -->
    @if($monthlyEditionCategory && $monthlyEditionArticles->count())
        <section class="rs-latest-post-area section-space-bottom rs-ptop bg-primary">
            <div class="container">
                <div class="row section-title-space align-items-center g-5">
                    <div class="col-xl-6 col-lg-6">
                        <div class="section-title-wrapper">
                            <h2 class="section-title rs-split-text-enable split-in-left is-white">
                                {{ $monthlyEditionCategory->name ?? 'Latest Stories' }}
                            </h2>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6">
                        <div class="section-btn d-flex justify-content-lg-end">
                            <a class="rs-btn has-text has-icon is-text-white"
                                href="{{ route('category.show', $monthlyEditionCategory->slug ?? '') }}">
                                View All
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row g-5">

                    @foreach($monthlyEditionArticles as $article)

                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="rs-post-medium rs-post-medium-two">
                                <div class="rs-post-medium-item" style="padding-bottom: 12px;">

                                    <div class="rs-post-medium-thumb" style="height: 480px;">
                                        <a href="{{ asset('storage/' . $article->pdf_file) }}" target="_blank" class="image-link">
                                            <img style="height: 100%; width: 100%; object-fit: fill;"
                                                src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                alt="{{ $article->title }}">
                                        </a>
                                    </div>

                                    <div class="rs-post-medium-content" style="padding-left: 2px; padding-top: 5px;">

                                        <h5 class="rs-post-medium-title is-white underline" style="color: white;font-size:16px;">
                                            <a href="{{ asset('storage/' . $article->pdf_file) }}" target="_blank">
                                                {{ \Illuminate\Support\Str::limit($article->title, 60) }}
                                            </a>
                                        </h5>

                                        <div class="rs-post-meta">
                                            <ul>

                                                <!-- @if(!empty($article->auther))
                                                                                                                                                                                                                    <li>
                                                                                                                                                                                                                        <span class="rs-meta">
                                                                                                                                                                                                                            By
                                                                                                                                                                                                                            <a href="#" class="meta-author">
                                                                                                                                                                                                                                {{ $article->auther }}
                                                                                                                                                                                                                            </a>
                                                                                                                                                                                                                        </span>
                                                                                                                                                                                                                    </li>
                                                                                                                                                                                                                @endif -->

                                                <li>
                                                    <span class="rs-meta">
                                                        <span>
                                                            {{ $article->created_at->format('F Y') }}
                                                        </span>
                                                    </span>
                                                </li>

                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach

                </div>
            </div>
        </section>
    @endif
    <!-- Monthly Edition category end  -->


    <!-- cta area start -->
    @if(!auth()->user())
        <section class="rs-cta-area rs-cta-one section-space">
            <div class="container">
                <div class="rs-cta-wrapper"
                    style="background: linear-gradient(90deg, #0b1d4d 0%, #173f88 45%, #2d83e6 100%); border-radius: 12px;">
                    <div class="cta-shape-one">
                        <img src="{{ asset('assets/images/cta/cta-thumb-01.webp') }}" alt="image">
                    </div>
                    <div class="cta-shape-two">
                        <img src="{{ asset('assets/images/cta/cta-thumb-02.webp') }}" alt="image">
                    </div>
                    <div class="cta-shape-three">
                        <img src="{{ asset('assets/images/cta/cta-thumb-03.webp') }}" alt="image">
                    </div>
                    <div class="cta-shape-four">
                        <img src="{{ asset('assets/images/cta/cta-thumb-04.webp') }}" alt="image">
                    </div>
                    <div class="cta-shape-five">
                        <img src="{{ asset('assets/images/shape/multi-dot-shape.webp') }}" alt="image">
                    </div>
                    <div class="rs-cta-bg-thumb" data-background="{{ asset('assets/images/bg/cta-bg-thumb-01.webp') }}"></div>

                    <div class="row">
                        <div class="col-xxl-5 col-xl-6 col-lg-7 col-md-10">
                            <div class="rs-cta-content-wrapper">
                                <h3 class="section-title rs-split-text-enable split-in-left is-white">
                                    Subscribe to our new updates!
                                </h3>

                                <div class="rs-cta-form">
                                    <form method="POST" action="{{ route('newsletter.subscribe') }}" id="newsletterForm">
                                        @csrf

                                        <div class="rs-cta-input">
                                            <input id="cta_email" name="email" type="email" placeholder="Enter your email"
                                                value="{{ old('email') }}" required>

                                            <button type="submit" class="rs-btn has-icon hover-black">
                                                Subscribe
                                                <span class="icon-box">
                                                    <svg class="icon-first" width="17" height="12" viewBox="0 0 17 12"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                                            fill="white" />
                                                    </svg>

                                                    <svg class="icon-second" width="17" height="12" viewBox="0 0 17 12"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                                            fill="white" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- cta area end -->

    <!-- Bookshelf area start -->
    @if($bookshelfCategory && $bookshelfArticles->count())
        <section class="rs-trending-news-area section-space-bottom rs-ptop rs-trending-news-three">
            <div class="container">
                <div class="row section-title-space align-items-center g-5">
                    <div class="col-xl-6 col-lg-6">
                        <div class="section-title-wrapper">
                            <h2 class="section-title rs-split-text-enable split-in-left">
                                {{ $bookshelfCategory->name }}
                            </h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="section-btn d-flex justify-content-lg-end">
                            <a class="rs-btn has-text has-icon" href="{{ route('category.show', $bookshelfCategory->slug) }}">
                                View All
                                <span class="icon-box">
                                    <svg class="icon-first" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                            fill="#121213" />
                                    </svg>
                                    <svg class="icon-second" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                            fill="#121213" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row g-5 justify-content-center">
                    @foreach($bookshelfArticles as $article)
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="rs-post-overlay rs-post-overlay-four">
                                <a href="{{ route('news.show', $article->slug) }}">
                                    <div class="rs-post-overlay-bg-thumb"
                                        style="background-image: url('{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}'); 
                                                                                                                                                                                                                                                                   background-size: cover; 
                                                                                                                                                                                                                                                                   background-position: center;">
                                    </div>
                                </a>

                                <div class="rs-post-overlay-content">

                                    <h5 class="rs-post-overlay-title is-white underline">
                                        <a href="{{ route('news.show', $article->slug) }}">
                                            {{ \Illuminate\Support\Str::limit($article->title, 40) }}
                                        </a>
                                    </h5>

                                    <div class="rs-post-meta meta-white">
                                        <ul>
                                            @if(!empty($article->auther))
                                                <li>
                                                    <span class="rs-meta">
                                                        By <a href="javascript:void(0)" class="meta-author">{{ $article->auther }}</a>
                                                    </span>
                                                </li>
                                            @endif
                                            <li>
                                                <span class="rs-meta">
                                                    <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M4.33447 3.8335C4.06114 3.8335 3.83447 3.60683 3.83447 3.3335V1.3335C3.83447 1.06016 4.06114 0.833496 4.33447 0.833496C4.60781 0.833496 4.83447 1.06016 4.83447 1.3335V3.3335C4.83447 3.60683 4.60781 3.8335 4.33447 3.8335ZM9.66781 3.8335C9.39447 3.8335 9.16781 3.60683 9.16781 3.3335V1.3335C9.16781 1.06016 9.39447 0.833496 9.66781 0.833496C9.94114 0.833496 10.1678 1.06016 10.1678 1.3335V3.3335C10.1678 3.60683 9.94114 3.8335 9.66781 3.8335ZM12.6678 6.56016H1.33447C1.06114 6.56016 0.834473 6.3335 0.834473 6.06016C0.834473 5.78683 1.06114 5.56016 1.33447 5.56016H12.6678C12.9411 5.56016 13.1678 5.78683 13.1678 6.06016C13.1678 6.3335 12.9411 6.56016 12.6678 6.56016Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M9.66667 15.1668H4.33333C1.9 15.1668 0.5 13.7668 0.5 11.3335V5.66683C0.5 3.2335 1.9 1.8335 4.33333 1.8335H9.66667C12.1 1.8335 13.5 3.2335 13.5 5.66683V11.3335C13.5 13.7668 12.1 15.1668 9.66667 15.1668ZM4.33333 2.8335C2.42667 2.8335 1.5 3.76016 1.5 5.66683V11.3335C1.5 13.2402 2.42667 14.1668 4.33333 14.1668H9.66667C11.5733 14.1668 12.5 13.2402 12.5 11.3335V5.66683C12.5 3.76016 11.5733 2.8335 9.66667 2.8335H4.33333Z"
                                                            fill="white"></path>
                                                    </svg>
                                                    <span>{{ optional($article->published_at)->format('F Y') }}</span>
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- Bookshelf area end -->

    <!-- category news start -->
    <section class="rs-trending-news-area section-space-bottom rs-ptop rs-trending-news-three">
        <div class="container">
            <div class="row section-title-space align-items-center g-5">
                <div class="col-xl-6 col-lg-6">
                    <div class="section-title-wrapper">
                        <h2 class="section-title rs-split-text-enable split-in-left">
                            {{ $selectedCategory->name ?? 'Business' }}
                        </h2>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="section-btn d-flex justify-content-lg-end">
                        <a class="rs-btn has-text has-icon" href="{{ route('category.show', 'business') }}">View All
                            <span class="icon-box">
                                <svg class="icon-first" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                        fill="#121213" />
                                </svg>
                                <svg class="icon-second" width="17" height="12" viewBox="0 0 17 12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M15.3153 5.0991C13.1189 5.0991 11.1171 3.0991 11.1171 0.900901V0H9.31532V0.900901C9.31532 2.4991 10.0162 3.9982 11.1162 5.0991H0V6.9009H11.1162C10.0162 8.0018 9.31532 9.5009 9.31532 11.0991V12H11.1171V11.0991C11.1171 8.9018 13.1189 6.9009 15.3153 6.9009H16.2162V5.0991H15.3153Z"
                                        fill="#121213" />
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            @if(isset($categoryArticles[0]))
                <div class="row g-5">
                    <div class="{{ count($categoryArticles) > 1 ? 'col-xl-4' : 'col-xl-12' }}">
                        <div style="height: 100%;" class="rs-post-overlay rs-post-overlay-one featured-category-post">
                            <a href="{{ route('news.show', $categoryArticles[0]->slug) }}">
                                <div class="rs-post-overlay-bg-thumb"
                                    data-background="{{ $categoryArticles[0]->featured_image ? asset('storage/' . $categoryArticles[0]->featured_image) : asset('assets/images/default/news-placeholder.webp') }}">
                                </div>
                            </a>

                            <div class="rs-post-overlay-content">

                                <h5 class="rs-post-overlay-title is-white underline">
                                    <a href="{{ route('news.show', $categoryArticles[0]->slug) }}">
                                        {{ \Illuminate\Support\Str::limit($categoryArticles[0]->title, 55) }}
                                    </a>
                                </h5>

                                <div class="rs-post-meta meta-white">
                                    <ul>
                                        @if(!empty($categoryArticles[0]->auther))
                                            <li>
                                                <span class="rs-meta">
                                                    By <a href="javascript:void(0)" class="meta-author">
                                                        {{ $categoryArticles[0]->auther }}
                                                    </a>
                                                </span>
                                            </li>
                                        @endif
                                        <li>
                                            <span class="rs-meta">
                                                <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.33447 3.8335C4.06114 3.8335 3.83447 3.60683 3.83447 3.3335V1.3335C3.83447 1.06016 4.06114 0.833496 4.33447 0.833496C4.60781 0.833496 4.83447 1.06016 4.83447 1.3335V3.3335C4.83447 3.60683 4.60781 3.8335 4.33447 3.8335ZM9.66781 3.8335C9.39447 3.8335 9.16781 3.60683 9.16781 3.3335V1.3335C9.16781 1.06016 9.39447 0.833496 9.66781 0.833496C9.94114 0.833496 10.1678 1.06016 10.1678 1.3335V3.3335C10.1678 3.60683 9.94114 3.8335 9.66781 3.8335ZM12.6678 6.56016H1.33447C1.06114 6.56016 0.834473 6.3335 0.834473 6.06016C0.834473 5.78683 1.06114 5.56016 1.33447 5.56016H12.6678C12.9411 5.56016 13.1678 5.78683 13.1678 6.06016C13.1678 6.3335 12.9411 6.56016 12.6678 6.56016Z"
                                                        fill="white"></path>
                                                    <path
                                                        d="M9.66667 15.1668H4.33333C1.9 15.1668 0.5 13.7668 0.5 11.3335V5.66683C0.5 3.2335 1.9 1.8335 4.33333 1.8335H9.66667C12.1 1.8335 13.5 3.2335 13.5 5.66683V11.3335C13.5 13.7668 12.1 15.1668 9.66667 15.1668ZM4.33333 2.8335C2.42667 2.8335 1.5 3.76016 1.5 5.66683V11.3335C1.5 13.2402 2.42667 14.1668 4.33333 14.1668H9.66667C11.5733 14.1668 12.5 13.2402 12.5 11.3335V5.66683C12.5 3.76016 11.5733 2.8335 9.66667 2.8335H4.33333Z"
                                                        fill="white"></path>
                                                </svg>
                                                <span>
                                                    {{ $categoryArticles[0]->published_at ? $categoryArticles[0]->published_at->format('F Y') : '' }}
                                                </span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(count($categoryArticles) > 1)
                        <div class="col-xl-8">
                            <div class="rs-post-small-nineteen">
                                <div class="rs-post-small-wrapper">
                                    @for($i = 1; $i < 9; $i++)
                                        @if(isset($categoryArticles[$i]))
                                            @php $article = $categoryArticles[$i]; @endphp
                                            <div class="rs-post-small">
                                                <div class="rs-post-small-thumb">
                                                    <a href="{{ route('news.show', $article->slug) }}" class="image-link">
                                                        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                            alt="{{ $article->title }}">
                                                    </a>
                                                </div>
                                                <div class="rs-post-small-content">
                                                    <h6 class="rs-post-small-title underline">
                                                        <a href="{{ route('news.show', $article->slug) }}">
                                                            {{ \Illuminate\Support\Str::limit($article->title, 55) }}
                                                        </a>
                                                    </h6>
                                                    @if(!empty($article->auther))
                                                        <div class="rs-post-meta">
                                                            <ul>
                                                                <li>
                                                                    <span class="rs-meta">
                                                                        By <a href="javascript:void(0)" class="meta-author">
                                                                            {{ $article->auther }}
                                                                        </a>
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
    <!-- category news end -->

    <!-- ad banner area start -->
    <!-- <div class="ad-banner-area rs-ad-banner-one section-space-bottom">
                                                                            <div class="container">
                                                                                <div class="row">
                                                                                    <div class="col-12">
                                                                                        <div class="rs-ad-banner-thumb">
                                                                                                                    <a href="/plans"><img src="{{ asset('assets/images/ad/ad-2.webp') }}"
                                                                                                                            alt="image"></a>
                                                                                                                </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->
    <!-- ad banner area end -->

@endsection