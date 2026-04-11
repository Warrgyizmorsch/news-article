@if($article)

    <div class="rs-post-small-item mb-20">

        <div class="rs-post-small-thumb">
            <a href="{{ route('news.show', $article->slug) }}" class="image-link">
                <img src="{{ $article->featured_image
            ? asset('storage/' . $article->featured_image)
            : asset('assets/images/default/news-placeholder.webp') }}" alt="{{ $article->title }}"
                    style="width:100%; height:200px; object-fit:cover; border-radius:6px;">
            </a>
        </div>

        <div class="rs-post-small-content mt-2">

            <div class="rs-post-tag-two">
                <a href="javascript:void(0)" class="post-tag is-green">
                    {{ $article->category->name ?? 'News' }}
                </a>
            </div>

            <h5 class="rs-post-small-title underline mt-2">
                <a href="{{ route('news.show', $article->slug) }}">
                    {{ $article->title }}
                </a>
            </h5>

            @if(!empty($article->auther))
                <div class="rs-post-meta">
                    <ul>
                        <li>
                            <span class="rs-meta">
                                By <a href="#" class="meta-author">
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