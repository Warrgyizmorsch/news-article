@php
    $videoNews = [
        [
            "subtitle" => "",
            "title" => "From beer baron to real baron – an interview with Lord Bilimoria",
            "url" => "https://youtu.be/p8Dgc0rgpeM?si=HrA4LnqDEo8J8sal",
            "excerpt" => "India-born Karan Bilimoria, founder of Cobra Beer, has spent his career promoting links between Britain and India.",
            "duration" => "30 min",
            "image" => "/assets/images/video3.webp",
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
            <div class="col-xl-9 col-lg-9">
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
                                {{ $mainVideo['subtitle'] ?? '' }}
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
            <div class="col-xl-3 col-lg-3">

                {{-- CASE 1: SHOW VIDEO LIST --}}
                @if(count($videoNews) > 1)

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
                            : 'https://img.youtube.com/vi/' . $id . '/hqdefault.jpg' }}" alt="{{ $video['title'] }}">
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

                    {{-- CASE 2: SHOW POPULAR ARTICLES --}}
                @elseif(isset($popularArticles) && count($popularArticles))

                    @foreach($popularArticles as $popular)

                            <div class="rs-post-small-item d-flex align-items-center mb-20 pb-20"
                                style="border-bottom:1px solid #f1f1f1;">

                                <div class="rs-post-small-thumb"
                                    style="flex:0 0 80px;height:80px;border-radius:8px;overflow:hidden;margin-right:15px;">

                                    <a href="{{ route('news.show', $popular->slug) }}" class="image-link h-100">

                                        <img src="{{ $popular->featured_image
                        ? asset('storage/' . $popular->featured_image)
                        : asset('assets/images/default/news-placeholder.webp') }}" alt="{{ $popular->title }}"
                                            class="w-100 h-100 object-fit-cover">

                                    </a>
                                </div>

                                <div class="rs-post-small-content">

                                    <h6 class="rs-post-small-title"
                                        style="font-size:15px;font-weight:700;line-height:1.4;margin-bottom:8px;">

                                        <a href="{{ route('news.show', $popular->slug) }}"
                                            class="text-decoration-none transition-all"
                                            style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;color:white;">

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

                    {{-- CASE 3: SHOW ADVERTISEMENT --}}
                @else

                    <div class="mt-auto">
                        <x-advertisement-box width="100%" height="400px" />
                    </div>

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