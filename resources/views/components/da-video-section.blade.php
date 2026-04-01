<section class="rs-categories-area section-space-bottom rs-ptop secondary-bg rs-categories-three">
        <div class="container">

            <div class="row section-title-space align-items-center g-5">
                <div class="col-xl-6 col-lg-6">
                    <div class="section-title-wrapper">
                        <h2 class="section-title rs-split-text-enable split-in-left">DA Videos</h2>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="section-btn">
                        <a class="rs-btn has-text has-icon" href="https://www.youtube.com/" target="_blank">
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

                                    <div class="rs-categories-item">

                                        <div class="rs-categories-thumb position-relative">

                                            <a href="javascript:void(0)" onclick="playVideo('{{ $youtubeId }}')">
                                                <img src="{{ $thumbnail }}" alt="{{ $video->title }}">
                                            </a>

                                            <a href="javascript:void(0)" onclick="playVideo('{{ $youtubeId }}')"
                                                class="rs-video-play-btn">
                                                <i class="ri-play-fill"></i>
                                            </a>

                                        </div>


                                        <div class="rs-categories-info">

                                            <div class="rs-categories-title-wrap">

                                                <h6 class="rs-categories-title underline">
                                                    <a href="javascript:void(0)" onclick="playVideo('{{ $youtubeId }}')">
                                                        {{ \Illuminate\Support\Str::limit($video->title, 30) }}
                                                    </a>
                                                </h6>

                                                <span class="rs-categories-meta">DA Video</span>

                                            </div>


                                            <div class="rs-categories-btn">
                                                <a class="rs-square-btn has-icon has-transparent" href="javascript:void(0)"
                                                    onclick="playVideo('{{ $youtubeId }}')">

                                                    <span class="icon-box">
                                                        <svg class="icon-first" width="14" height="10" viewBox="0 0 14 10"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M12.7628 4.24925C10.9324 4.24925 9.26427 2.58258 9.26427 0.750751V0H7.76276V0.750751C7.76276 2.08258 8.34685 3.33183 9.26351 4.24925H0V5.75075H9.26351C8.34685 6.66817 7.76276 7.91742 7.76276 9.24925V10H9.26427V9.24925C9.26427 7.41817 10.9324 5.75075 12.7628 5.75075H13.5135V4.24925H12.7628Z"
                                                                fill="white"></path>
                                                        </svg>
                                                        <svg class="icon-second" width="14" height="10" viewBox="0 0 14 10"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M12.7628 4.24925C10.9324 4.24925 9.26427 2.58258 9.26427 0.750751V0H7.76276V0.750751C7.76276 2.08258 8.34685 3.33183 9.26351 4.24925H0V5.75075H9.26351C8.34685 6.66817 7.76276 7.91742 7.76276 9.24925V10H9.26427V9.24925C9.26427 7.41817 10.9324 5.75075 12.7628 5.75075H13.5135V4.24925H12.7628Z"
                                                                fill="white"></path>
                                                        </svg>
                                                    </span>

                                                </a>
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
        .rs-featured-video-slider .swiper-slide {
            height: auto;
        }

        .rs-video-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: rgba(220, 38, 38, 0.92);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            text-decoration: none;
            z-index: 2;
            transition: 0.3s ease;
        }

        .rs-video-play-btn:hover {
            transform: translate(-50%, -50%) scale(1.08);
            color: #fff;
        }

        .rs-categories-thumb {
            position: relative;
            overflow: hidden;
        }

        .rs-categories-thumb img {
            width: 100%;
            display: block;
            object-fit: cover;
        }

        .rs-featured-video-pagination {
            text-align: center;
        }

        .rs-featured-video-pagination .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            opacity: 1;
            background: #d1d5db;
        }

        .rs-featured-video-pagination .swiper-pagination-bullet-active {
            background: #121213;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            let videoCount = {{ $featuredVideos->count() }};

            new Swiper('.rs-featured-video-slider', {
                slidesPerView: 1,
                spaceBetween: 24,
                loop: videoCount > 4, // enable loop only if enough videos
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
                    992: { slidesPerView: 3 },
                    1200: { slidesPerView: 4 }
                }
            });

        });

        function playVideo(videoId) {
            let modal = document.getElementById("videoModal");
            let iframe = document.getElementById("videoFrame");

            iframe.src = "https://www.youtube.com/embed/" + videoId + "?autoplay=1";

            modal.style.display = "flex";
        }

        function closeVideo() {
            let modal = document.getElementById("videoModal");
            let iframe = document.getElementById("videoFrame");

            iframe.src = "";
            modal.style.display = "none";
        }
    </script>