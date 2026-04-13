<section class="rs-categories-area secondary-bg rs-categories-three" style="padding: 20px 0;">
        <div class="container">

            <div class="row section-title-space align-items-center g-5">
                <div class="col-xl-6 col-lg-6">
                    <div class="section-title-wrapper">
                        <h2 class="section-title rs-split-text-enable split-in-left">DA Videos</h2>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="section-btn">
                        <a class="rs-btn has-text has-icon" href="https://www.youtube.com/@democracyasiaofficial" target="_blank">
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


            <div class="row">
                <div class="col-12">
                    <div class="swiper rs-featured-video-slider">
                        <div class="swiper-wrapper">
                    
                            @foreach($featuredVideos as $video)

                                @php
    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $video->url, $matches);
    $youtubeId = $matches[1] ?? null;

    $thumbnail = $video->thumbnail
        ? asset('uploads/thumbnails/' . $video->thumbnail)
        : "https://img.youtube.com/vi/" . $youtubeId . "/hqdefault.jpg";
                                @endphp

                                <div class="swiper-slide">

                                    {{-- FULL CARD CLICKABLE --}}
                                    <div class="da-video-card" onclick="playVideo('{{ $youtubeId }}')">

                                        <div class="da-video-thumb">

                                            <img src="{{ $thumbnail }}" alt="{{ $video->title }}">

                                            {{-- Overlay --}}
                                            <div class="da-video-overlay"></div>

                                            {{-- TITLE (BOTTOM LEFT) --}}
                                            <div class="da-video-content">
                                                <h4>{{ \Illuminate\Support\Str::limit($video->title, 60) }}</h4>
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
        /* CARD */
.da-video-card {
    border-radius: 12px;
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
    background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.2));
    z-index: 1;
}

/* CONTENT (BOTTOM LEFT) */
.da-video-content {
    position: absolute;
    bottom: 15px;
    left: 15px;
    right: 15px;
    z-index: 2;
}

.da-video-content h4 {
    font-size: 16px;
    font-weight: 700;
    color: #fff;
    line-height: 1.3;

    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
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
                    slidesPerView: 1,
                    spaceBetween: 24,
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