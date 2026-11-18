<section class="rs-categories-area secondary-bg rs-categories-three" style="padding: 20px 0;">
        <div class="container">

            <div class="row">
                <div class="col-xl-9 col-lg-9">
                    <!-- Section heading  -->
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 section-title-space mb-3">
                        <div class="section-title-wrapper">
                            <h2 class="section-title rs-split-text-enable split-in-left m-0">DA Videos</h2>
                        </div>
                    
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            <a class="da-yt-subscribe-btn" href="https://www.youtube.com/@democracyasiaofficial?sub_confirmation=1" target="_blank" title="Subscribe to Democracy Asia on YouTube">
                                <svg width="20" height="15" viewBox="0 0 24 24" fill="currentColor" style="display: block;">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                </svg>
                                <span>Subscribe on YouTube</span>
                            </a>
                            <a class="rs-btn has-text has-icon m-0" href="https://www.youtube.com/@democracyasiaofficial" target="_blank" style="white-space: nowrap;">
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

                    <!-- Videos  -->
                    <div class="swiper rs-featured-video-slider">
                        <div class="swiper-wrapper">
                    
                            @foreach($featuredVideos as $video)

                                @php
    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/shorts\/)([^\&\?\/]+)/', $video->url, $matches);
    $youtubeId = $matches[1] ?? null;

    $thumbnail = $video->thumbnail
        ? asset('uploads/thumbnails/' . $video->thumbnail)
        : "https://img.youtube.com/vi/" . $youtubeId . "/hqdefault.jpg";
                                @endphp

                                <div class="swiper-slide">

                                    {{-- FULL CARD CLICKABLE --}}
                                    <div class="da-video-card" onclick="playVideo('{{ $youtubeId }}')">

                                        <div class="da-video-thumb">

                                            <img src="{{ $thumbnail }}" alt="{{ $video->title ?? 'DA Video' }}">

                                            {{-- Overlay --}}
                                            <div class="da-video-overlay"></div>

                                            {{-- TITLE & SHORT DESCRIPTION (BOTTOM) --}}
                                            <div class="da-video-content">
                                                <h4>{{ \Illuminate\Support\Str::limit($video->title ?: 'Democracy Asia Video', 55) }}</h4>
                                                @if(!empty($video->description))
                                                    <p class="da-video-desc">{{ \Illuminate\Support\Str::limit($video->description, 80) }}</p>
                                                @endif
                                            </div>

                                            {{-- PLAY BUTTON --}}
                                            <div class="da-video-play">
                                                <i class="ri-play-fill"></i>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endforeach
                    
                        </div>
                    
                        <div class="rs-featured-video-pagination mt-30"></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3">
                    <x-advertisement-box width="100%" height="100%" style="min-height: 350px;" />
                </div>
            </div>

        </div>
    </section>
    <div id="videoModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
                     background:rgba(0,0,0,0.85); z-index:9999; align-items:center; justify-content:center;">

        <div style="width:80%; max-width:900px; position:relative;">

            <span onclick="closeVideo()" style="position:absolute; right:-10px; top:-40px;
                              font-size:35px; color:white; cursor:pointer;">
                ✕
            </span>

            <iframe id="videoFrame" width="100%" height="500" src="" frameborder="0" allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>

        </div>

    </div>
    <style>
        /* YOUTUBE SUBSCRIBE BUTTON */
        .da-yt-subscribe-btn {
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
            background: #e1120b !important;
            color: #ffffff !important;
            font-size: 13.5px !important;
            font-weight: 600 !important;
            padding: 8px 18px !important;
            border-radius: 50px !important;
            text-decoration: none !important;
            white-space: nowrap !important;
            transition: all 0.25s ease !important;
            box-shadow: 0 3px 10px rgba(225, 18, 11, 0.25) !important;
            line-height: 1 !important;
            border: none !important;
        }
        .da-yt-subscribe-btn:hover {
            background: #b80d07 !important;
            color: #ffffff !important;
            transform: translateY(-2px) !important;
            box-shadow: 0 5px 14px rgba(225, 18, 11, 0.4) !important;
        }

        /* CARD */
.da-video-card {
    border-radius: 5px;
    overflow: hidden;
    cursor: pointer;
}

/* IMAGE */
.da-video-thumb {
    position: relative;
    aspect-ratio: 3/5;
    overflow: hidden;
}

.da-video-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.da-video-card:hover img {
    transform: scale(1.05);
}

/* OVERLAY */
.da-video-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.92) 0%, rgba(0,0,0,0.55) 50%, rgba(0,0,0,0.15) 100%);
    z-index: 1;
}

/* CONTENT (BOTTOM LEFT) */
.da-video-content {
    position: absolute;
    bottom: 14px;
    left: 14px;
    right: 14px;
    z-index: 2;
}

.da-video-content h4 {
    font-size: 15px;
    font-weight: 700;
    color: #fff;
    line-height: 1.35;
    margin-bottom: 4px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-shadow: 0 1px 3px rgba(0,0,0,0.8);
}

.da-video-content .da-video-desc {
    font-size: 12px;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.35;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-shadow: 0 1px 2px rgba(0,0,0,0.8);
}

/* PLAY BUTTON (CENTER) */
.da-video-play {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 3;

    width: 55px;
    height: 55px;
    border-radius: 50%;

    background: rgba(0, 0, 0, 0.6);
    border: 2px solid #fff;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #fff;
    font-size: 22px;

    transition: 0.3s ease;
}

.da-video-card:hover .da-video-play {
    transform: translate(-50%, -50%) scale(1.1);
    background: rgba(227, 18, 11, 0.9);
    border-color: rgba(227, 18, 11, 0.9);
}

.rs-featured-video-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

.rs-featured-video-pagination .swiper-pagination-bullet {
    margin: 0 4px !important;
}
    </style>
    <script>
        let videoSwiper;

            document.addEventListener('DOMContentLoaded', function () {

                let videoCount = {{ $featuredVideos->count() }};

                videoSwiper = new Swiper('.rs-featured-video-slider', {
                    slidesPerView: 2,
                    spaceBetween: 18,
                    loop: videoCount > 4,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false,
                    },
                    pagination: {
                        el: '.rs-featured-video-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        576: { slidesPerView: 2 },
                        768: { slidesPerView: 2.5 },
                        992: { slidesPerView: 3 },
                        1200: { slidesPerView: 4 }
                    }
                });

                /* ✅ STOP ON HOVER */
                const slider = document.querySelector('.rs-featured-video-slider');

                slider.addEventListener('mouseenter', () => {
                    videoSwiper.autoplay.stop();
                });

                slider.addEventListener('mouseleave', () => {
                    videoSwiper.autoplay.start();
                });

            });

        function playVideo(videoId) {
                let modal = document.getElementById("videoModal");
                let iframe = document.getElementById("videoFrame");

                iframe.src = "https://www.youtube.com/embed/" + videoId + "?autoplay=1";

                modal.style.display = "flex";

                // ✅ STOP SLIDER
                if (videoSwiper) {
                    videoSwiper.autoplay.stop();
                }
            }

        function closeVideo() {
                let modal = document.getElementById("videoModal");
                let iframe = document.getElementById("videoFrame");

                iframe.src = "";
                modal.style.display = "none";

                // ✅ START SLIDER AGAIN
                if (videoSwiper) {
                    videoSwiper.autoplay.start();
                }
            }
    </script>