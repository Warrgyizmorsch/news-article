@php
    // Newest first: the first video is featured, the rest appear in the side list
    $videoNews = [
        [
            "subtitle" => "",
            "title" => "From shipping lanes to boardrooms – an interview with Ravi Mehrotra",
            "url" => "https://youtu.be/49la3b2cwh4?si=WnzsunmDIz6oVA8b",
            "excerpt" => "India-born Ravi Mehrotra, founder of the London-based Foresight Group, has spent decades building a global business from shipping to energy.",
            "duration" => "36 min",
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

                    <div class="row g-0 hv-card" id="highlightCard">

                        <!-- LEFT: Thumbnail / Player (fixed 16:9 so the card never changes height) -->
                        <div class="col-md-6">
                            <div id="featuredVideo" class="hv-media">

                                <img src="{{ $mainVideo['thumb'] }}" id="featuredThumbnail" alt="{{ $mainVideo['title'] }}">

                                <a href="javascript:void(0)" onclick="playFeaturedVideo(currentHighlightId)"
                                    class="rs-play-btn is-red hv-play" id="featuredPlayBtn" aria-label="Play video">
                                    <i class="ri-play-large-fill"></i>
                                </a>

                                <div class="hv-player"><div id="youtubePlayer"></div></div>
                            </div>
                        </div>

                        <!-- RIGHT: Content -->
                        <div class="col-md-6 hv-content">

                            <span id="featuredSubtitle" class="hv-subtitle" @if(empty($mainVideo['subtitle'])) style="display:none;" @endif>
                                {{ $mainVideo['subtitle'] ?? '' }}
                            </span>

                            <h3 id="featuredTitle" class="hv-title">{{ $mainVideo['title'] }}</h3>

                            <p id="featuredExcerpt" class="hv-excerpt" @if(empty($mainVideo['excerpt'])) style="display:none;" @endif>
                                {{ $mainVideo['excerpt'] ?? '' }}
                            </p>

                            <div class="hv-actions">
                                <button type="button" class="hv-btn" id="featuredPlayCta" onclick="highlightCtaClick()">
                                    <i class="ri-play-fill"></i> <span>Play Video</span>
                                </button>
                                <span id="featuredDuration" class="hv-duration" @if(empty($mainVideo['duration'])) style="display:none;" @endif>
                                    <i class="ri-time-line"></i> <span>{{ $mainVideo['duration'] ?? '' }}</span>
                                </span>
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
<style>
    /* Featured card: same height whether showing the thumbnail or the player */
    .hv-card {
        background: #000;
        border-radius: 8px;
        overflow: hidden;
    }

    .hv-media {
        position: relative;
        aspect-ratio: 16 / 9;
        background: #000;
        overflow: hidden;
    }

    .hv-media > img,
    .hv-media .hv-player,
    .hv-media .hv-player iframe {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
    }

    .hv-media > img {
        object-fit: cover;
    }

    .hv-media .hv-player {
        display: none;
    }

    .hv-card.is-playing .hv-player { display: block; }
    .hv-card.is-playing #featuredThumbnail,
    .hv-card.is-playing .hv-play { display: none !important; }

    .hv-media .hv-play {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
    }

    .hv-content {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        gap: 14px;
        padding: 28px 36px;
        color: #fff;
    }

    .hv-subtitle {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: #ff4d45;
    }

    .hv-title {
        margin: 0;
        color: #fff;
        font-size: 30px;
        font-weight: 700;
        line-height: 1.25;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .hv-excerpt {
        margin: 0;
        font-size: 16px;
        line-height: 1.55;
        color: rgba(255, 255, 255, 0.72);
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .hv-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px 16px;
        margin-top: 6px;
    }

    .hv-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #e1120b;
        color: #fff;
        border: none;
        padding: 11px 24px;
        border-radius: 30px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .hv-btn:hover { background: #b80d07; transform: translateY(-1px); }

    .hv-card.is-playing .hv-btn {
        background: rgba(255, 255, 255, 0.1);
        cursor: default;
        transform: none;
    }

    .hv-duration {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.65);
    }

    /* Side list: uniform 16:9 thumbnails */
    .rs-video-one .rs-post-video-three .rs-post-video-thumb {
        aspect-ratio: 16 / 9;
        flex-shrink: 0;
    }

    .rs-video-one .rs-post-video-three .rs-post-video-thumb > a:first-child {
        display: block;
        height: 100%;
    }

    .rs-video-one .rs-post-video-three .rs-post-video-item {
        gap: 16px;
    }

    .rs-video-one .rs-post-video-three .rs-post-video-title {
        font-size: 16px;
        line-height: 1.35;
        margin: 0;
    }

    @media (max-width: 1399px) {
        .hv-title { font-size: 26px; }
        .hv-excerpt { font-size: 15px; }
    }

    @media (max-width: 767px) {
        .hv-content { padding: 22px 18px 26px; gap: 10px; }
        .hv-title { font-size: 22px; }
        .hv-excerpt { font-size: 14px; }
    }
</style>
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

        const subtitle = document.getElementById('featuredSubtitle');
        subtitle.textContent = selected.subtitle || '';
        subtitle.style.display = selected.subtitle ? '' : 'none';

        const excerpt = document.getElementById('featuredExcerpt');
        excerpt.textContent = selected.excerpt || '';
        excerpt.style.display = selected.excerpt ? '' : 'none';

        const duration = document.getElementById('featuredDuration');
        duration.querySelector('span').textContent = selected.duration || '';
        duration.style.display = selected.duration ? '' : 'none';

        document.getElementById('featuredVideo').scrollIntoView({ behavior: 'smooth', block: 'center' });
        playFeaturedVideo(selected.id);
    }

    function playFeaturedVideo(videoId) {

        currentVideoId = videoId;
        setHighlightPlaying(true);

        if (!player) {

            player = new YT.Player('youtubePlayer', {
                height: '100%',
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

    // Toggle the card between thumbnail and player; the CTA reflects the state
    function setHighlightPlaying(isPlaying) {
        document.getElementById('highlightCard').classList.toggle('is-playing', isPlaying);
        const cta = document.getElementById('featuredPlayCta');
        cta.querySelector('span').textContent = isPlaying ? 'Now Playing' : 'Play Video';
        cta.querySelector('i').className = isPlaying ? 'ri-volume-up-line' : 'ri-play-fill';
    }

    // While a video is loaded, the CTA resumes it instead of restarting it
    function highlightCtaClick() {
        if (player && document.getElementById('highlightCard').classList.contains('is-playing')) {
            player.playVideo();
        } else {
            playFeaturedVideo(currentHighlightId);
        }
    }

    function onPlayerStateChange(event) {
        // Pausing keeps the player (and position); only a finished video returns to the thumbnail
        if (event.data === YT.PlayerState.ENDED) {
            showThumbnailAgain();
        }
    }

    function showThumbnailAgain() {
        setHighlightPlaying(false);
        if (player) {
            player.stopVideo();
        }
    }
</script>