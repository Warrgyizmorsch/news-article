@php
    // Newest first: the first video is featured, the rest appear in the side list
    $videoNews = [
        [
            "subtitle" => "",
            "title" => "EXCLUSIVE FULL INTERVIEW: Ravi Mehrotra",
            "url" => "https://youtu.be/49la3b2cwh4?si=WnzsunmDIz6oVA8b",
            "excerpt" => "",
            "duration" => "",
            "image" => "/assets/images/video-ravi-mehrotra.jpg",
        ],
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
    if (!function_exists('youtubeId')) {
        function youtubeId($url)
        {
            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^\&\?\/]+)/', $url, $m);
            return $m[1] ?? null;
        }
    }

    $videoNews = array_map(function ($video) {
        $video['id'] = youtubeId($video['url']);
        $video['thumb'] = !empty($video['image'])
            ? asset($video['image'])
            : 'https://img.youtube.com/vi/' . $video['id'] . '/maxresdefault.jpg';
        return $video;
    }, $videoNews);

    $mainVideo = $videoNews[0];
    $mainId = $mainVideo['id'];

    $highlightVideosJs = array_map(
        fn($video) => \Illuminate\Support\Arr::only($video, ['id', 'title', 'subtitle', 'excerpt', 'duration', 'thumb']),
        $videoNews
    );

@endphp
<section class="rs-video-area bg-primary rs-video-one" style="padding: 30px 0;">
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

                                <img src="{{ $mainVideo['thumb'] }}" id="featuredThumbnail" alt="{{ $mainVideo['title'] }}"
                                    style="width:100%;height:100%;object-fit:fill;">

                                <a href="javascript:void(0)" onclick="playFeaturedVideo(currentHighlightId)"
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

                            <span id="featuredSubtitle" style="font-size:15px;letter-spacing:1px;color:#aaa; text-align: center;">
                                {{ $mainVideo['subtitle'] ?? '' }}
                            </span>

                            <h3 id="featuredTitle" class="section-title is-white"
                                style="text-align: center; margin:10px 0; line-height: 1.3;">
                                {{ $mainVideo['title'] }}
                            </h3>

                            <p id="featuredExcerpt"
                                style="color:white;font-size:18px;line-height:1.6; text-align: center; {{ empty($mainVideo['excerpt']) ? 'display:none;' : '' }}">
                                {{ $mainVideo['excerpt'] ?? '' }}
                            </p>

                            <div style="text-align:center; margin-top:10px;">
                                <button onclick="playFeaturedVideo(currentHighlightId)" style="
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

                            <div id="featuredDuration"
                                style="margin-top:10px;font-size:13px;color:white; text-align: center; {{ empty($mainVideo['duration']) ? 'display:none;' : '' }}">
                                {{ $mainVideo['duration'] ?? '' }}
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
                        @foreach(array_slice($videoNews, 1, null, true) as $index => $video)

                            <div class="rs-post-video-item" data-highlight-index="{{ $index }}">
                                <div class="rs-post-video-thumb">
                                    <a href="javascript:void(0)" onclick="selectHighlightVideo(this)">
                                        <img src="{{ $video['thumb'] }}" alt="{{ $video['title'] }}">
                                    </a>

                                    <a href="javascript:void(0)" onclick="selectHighlightVideo(this)"
                                        class="rs-play-btn is-small is-red">
                                        <i class="ri-play-large-fill"></i>
                                    </a>
                                </div>

                                <div class="rs-post-video-content">
                                    <h6 class="rs-post-video-title underline is-white">
                                        <a href="javascript:void(0)" onclick="selectHighlightVideo(this)">
                                            {{ \Illuminate\Support\Str::limit($video['title'], 60) }}
                                        </a>
                                    </h6>
                                </div>
                            </div>

                        @endforeach
                    </div>

                    {{-- CASE 2: SHOW ADVERTISEMENT --}}
                @else

                    <div class="mt-auto">
                        <x-advertisement-box width="100%" height="100%" class="dark" style="min-height: 500px;" />
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

    const highlightVideos = @json($highlightVideosJs);
    let currentHighlightIndex = 0;
    let currentHighlightId = highlightVideos[0].id;

    // Swap the clicked side-list video into the featured panel and play it
    function selectHighlightVideo(el) {
        const item = el.closest('.rs-post-video-item');
        const index = parseInt(item.dataset.highlightIndex, 10);
        const selected = highlightVideos[index];
        const previous = highlightVideos[currentHighlightIndex];

        // The previously featured video takes the clicked slot in the list
        item.dataset.highlightIndex = currentHighlightIndex;
        const thumb = item.querySelector('.rs-post-video-thumb img');
        thumb.src = previous.thumb;
        thumb.alt = previous.title;
        item.querySelector('.rs-post-video-title a').textContent =
            previous.title.length > 60 ? previous.title.substring(0, 60) + '...' : previous.title;

        currentHighlightIndex = index;
        currentHighlightId = selected.id;

        document.getElementById('featuredThumbnail').src = selected.thumb;
        document.getElementById('featuredThumbnail').alt = selected.title;
        document.getElementById('featuredTitle').textContent = selected.title;
        document.getElementById('featuredSubtitle').textContent = selected.subtitle || '';

        const excerpt = document.getElementById('featuredExcerpt');
        excerpt.textContent = selected.excerpt || '';
        excerpt.style.display = selected.excerpt ? '' : 'none';

        const duration = document.getElementById('featuredDuration');
        duration.textContent = selected.duration || '';
        duration.style.display = selected.duration ? '' : 'none';

        document.getElementById('featuredVideo').scrollIntoView({ behavior: 'smooth', block: 'center' });
        playFeaturedVideo(selected.id);
    }

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