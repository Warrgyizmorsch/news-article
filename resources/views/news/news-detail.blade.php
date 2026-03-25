@extends('layouts.app')

@section('title', $article->meta_title ?: $article->title)
@section('meta_description', $article->meta_description ?: $article->excerpt)

@section('content')

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
                                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M15.4125 6.1124L9.69686 1.3249C8.71561 0.503027 7.28436 0.503027 6.30311 1.3249L0.587484 6.1124C-0.106266 6.69365 -0.196891 7.72803 0.384359 8.41865C0.671859 8.7624 1.08748 8.97178 1.53123 8.9999V13.6562C1.53123 14.5562 2.26248 15.2874 3.16561 15.2905H6.67811V11.2593C6.67811 10.5312 7.26873 9.94053 7.99686 9.94053C8.72498 9.94053 9.31561 10.5312 9.31561 11.2593V15.2937H12.8312C13.7312 15.2937 14.4625 14.5624 14.4656 13.6593V9.00303C15.3687 8.94365 16.0531 8.1624 15.9937 7.25928C15.9625 6.81553 15.7531 6.3999 15.4125 6.1124Z"
                                                            fill="black" />
                                                    </svg>
                                                    Home
                                                </a>
                                            </span>
                                        </li>
                                        @if($article->category)
                                            <li class="rs-breadcumb-item">
                                                <span>
                                                    <a href="{{ route('category.show', $article->category->slug) }}">
                                                        {{ $article->category->name }}
                                                    </a>
                                                </span>
                                            </li>
                                        @endif
                                        <li class="rs-breadcumb-item">
                                            {{ \Illuminate\Support\Str::limit($article->title, 20) }}
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

        <!-- blog post area start -->
        <section class="rs-blog-post-area section-space-top rs-blog-post-one">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="rs-blog-post-wrapper">
                            <div class="rs-blog-post-left">
                                <div class="rs-post-tag">
                                    @if($article->category)
                                        <a href="{{ route('category.show', $article->category->slug) }}" class="post-tag is-red">
                                            {{ $article->category->name }}
                                        </a>
                                    @endif
                                </div>

                                <h1 class="rs-blog-post-title">
                                    {{ $article->title }}
                                </h1>

                                <div class="rs-post-meta">
                                    <ul>
                                        <li>
                                            <span class="rs-meta">
                                                <span class="rs-meta-thumb">
                                                    <img src="{{ asset('assets/images/user/user-thumb-05.webp') }}"
                                                        alt="{{ $article->author->name ?? 'Author' }}">
                                                </span>
                                                <span class="rs-meta-content">
                                                    By
                                                    <a href="javascript:void(0)" class="meta-author">
                                                        {{ $article->author->name ?? 'Admin' }}
                                                    </a>
                                                </span>
                                            </span>
                                        </li>

                                        <li>
                                            <span class="rs-meta">
                                                <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M4.33447 3.8335C4.06114 3.8335 3.83447 3.60683 3.83447 3.3335V1.3335C3.83447 1.06016 4.06114 0.833496 4.33447 0.833496C4.60781 0.833496 4.83447 1.06016 4.83447 1.3335V3.3335C4.83447 3.60683 4.60781 3.8335 4.33447 3.8335ZM9.66781 3.8335C9.39447 3.8335 9.16781 3.60683 9.16781 3.3335V1.3335C9.16781 1.06016 9.39447 0.833496 9.66781 0.833496C9.94114 0.833496 10.1678 1.06016 10.1678 1.3335V3.3335C10.1678 3.60683 9.94114 3.8335 9.66781 3.8335ZM4.66781 9.66683C4.58114 9.66683 4.49447 9.64683 4.41447 9.6135C4.32781 9.58016 4.26114 9.5335 4.19447 9.4735C4.07447 9.34683 4.00114 9.18016 4.00114 9.00016C4.00114 8.9135 4.02114 8.82683 4.05447 8.74683C4.08781 8.66683 4.13447 8.5935 4.19447 8.52683C4.26114 8.46683 4.32781 8.42016 4.41447 8.38683C4.65447 8.28683 4.95447 8.34016 5.14114 8.52683C5.26114 8.6535 5.33447 8.82683 5.33447 9.00016C5.33447 9.04016 5.32781 9.08683 5.32114 9.1335C5.31447 9.1735 5.30114 9.2135 5.28114 9.2535C5.26781 9.2935 5.24781 9.3335 5.22114 9.3735C5.20114 9.40683 5.16781 9.44016 5.14114 9.4735C5.01447 9.5935 4.84114 9.66683 4.66781 9.66683ZM7.00114 9.66683C6.91447 9.66683 6.82781 9.64683 6.74781 9.6135C6.66114 9.58016 6.59447 9.5335 6.52781 9.4735C6.40781 9.34683 6.33447 9.18016 6.33447 9.00016C6.33447 8.9135 6.35447 8.82683 6.38781 8.74683C6.42114 8.66683 6.46781 8.5935 6.52781 8.52683C6.59447 8.46683 6.66114 8.42016 6.74781 8.38683C6.98781 8.28016 7.28781 8.34016 7.47447 8.52683C7.59447 8.6535 7.66781 8.82683 7.66781 9.00016C7.66781 9.04016 7.66114 9.08683 7.65447 9.1335C7.64781 9.1735 7.63447 9.2135 7.61447 9.2535C7.60114 9.2935 7.58114 9.3335 7.55447 9.3735C7.53447 9.40683 7.50114 9.44016 7.47447 9.4735C7.34781 9.5935 7.17447 9.66683 7.00114 9.66683ZM9.33447 9.66683C9.24781 9.66683 9.16114 9.64683 9.08114 9.6135C8.99447 9.58016 8.92781 9.5335 8.86114 9.4735L8.78114 9.3735C8.75589 9.33635 8.73571 9.29599 8.72114 9.2535C8.70188 9.21572 8.6884 9.17527 8.68114 9.1335C8.67447 9.08683 8.66781 9.04016 8.66781 9.00016C8.66781 8.82683 8.74114 8.6535 8.86114 8.52683C8.92781 8.46683 8.99447 8.42016 9.08114 8.38683C9.32781 8.28016 9.62114 8.34016 9.80781 8.52683C9.92781 8.6535 10.0011 8.82683 10.0011 9.00016C10.0011 9.04016 9.99447 9.08683 9.98781 9.1335C9.98114 9.1735 9.96781 9.2135 9.94781 9.2535C9.93447 9.2935 9.91447 9.3335 9.88781 9.3735C9.86781 9.40683 9.83447 9.44016 9.80781 9.4735C9.68114 9.5935 9.50781 9.66683 9.33447 9.66683ZM4.66781 12.0002C4.58114 12.0002 4.49447 11.9802 4.41447 11.9468C4.33447 11.9135 4.26114 11.8668 4.19447 11.8068C4.07447 11.6802 4.00114 11.5068 4.00114 11.3335C4.00114 11.2468 4.02114 11.1602 4.05447 11.0802C4.08781 10.9935 4.13447 10.9202 4.19447 10.8602C4.44114 10.6135 4.89447 10.6135 5.14114 10.8602C5.26114 10.9868 5.33447 11.1602 5.33447 11.3335C5.33447 11.5068 5.26114 11.6802 5.14114 11.8068C5.01447 11.9268 4.84114 12.0002 4.66781 12.0002ZM7.00114 12.0002C6.82781 12.0002 6.65447 11.9268 6.52781 11.8068C6.40781 11.6802 6.33447 11.5068 6.33447 11.3335C6.33447 11.2468 6.35447 11.1602 6.38781 11.0802C6.42114 10.9935 6.46781 10.9202 6.52781 10.8602C6.77447 10.6135 7.22781 10.6135 7.47447 10.8602C7.53447 10.9202 7.58114 10.9935 7.61447 11.0802C7.64781 11.1602 7.66781 11.2468 7.66781 11.3335C7.66781 11.5068 7.59447 11.6802 7.47447 11.8068C7.34781 11.9268 7.17447 12.0002 7.00114 12.0002ZM9.33447 12.0002C9.16114 12.0002 8.98781 11.9268 8.86114 11.8068C8.79945 11.7442 8.75174 11.6692 8.72114 11.5868C8.68781 11.5068 8.66781 11.4202 8.66781 11.3335C8.66781 11.2468 8.68781 11.1602 8.72114 11.0802C8.75447 10.9935 8.80114 10.9202 8.86114 10.8602C9.01447 10.7068 9.24781 10.6335 9.46114 10.6802C9.50781 10.6868 9.54781 10.7002 9.58781 10.7202C9.62781 10.7335 9.66781 10.7535 9.70781 10.7802C9.74114 10.8002 9.77447 10.8335 9.80781 10.8602C9.92781 10.9868 10.0011 11.1602 10.0011 11.3335C10.0011 11.5068 9.92781 11.6802 9.80781 11.8068C9.68114 11.9268 9.50781 12.0002 9.33447 12.0002ZM12.6678 6.56016H1.33447C1.06114 6.56016 0.834473 6.3335 0.834473 6.06016C0.834473 5.78683 1.06114 5.56016 1.33447 5.56016H12.6678C12.9411 5.56016 13.1678 5.78683 13.1678 6.06016C13.1678 6.3335 12.9411 6.56016 12.6678 6.56016Z"
                                                        fill="white"></path>
                                                    <path
                                                        d="M9.66667 15.1668H4.33333C1.9 15.1668 0.5 13.7668 0.5 11.3335V5.66683C0.5 3.2335 1.9 1.8335 4.33333 1.8335H9.66667C12.1 1.8335 13.5 3.2335 13.5 5.66683V11.3335C13.5 13.7668 12.1 15.1668 9.66667 15.1668ZM4.33333 2.8335C2.42667 2.8335 1.5 3.76016 1.5 5.66683V11.3335C1.5 13.2402 2.42667 14.1668 4.33333 14.1668H9.66667C11.5733 14.1668 12.5 13.2402 12.5 11.3335V5.66683C12.5 3.76016 11.5733 2.8335 9.66667 2.8335H4.33333Z"
                                                        fill="white"></path>
                                                </svg>
                                                <span>{{ optional($article->published_at)->format('M d, Y') }}</span>
                                            </span>
                                        </li>

                                        <li>
                                            <span class="rs-meta">
                                                <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M6.165 8.00011H6.06C5.84838 7.97911 5.64896 7.8912 5.49071 7.74913C5.33246 7.60707 5.22362 7.41825 5.18 7.21011L3.84 1.00011L2.46 4.20011C2.42097 4.28955 2.35661 4.36561 2.27487 4.41892C2.19314 4.47223 2.09758 4.50045 2 4.50011H0.5C0.367392 4.50011 0.240215 4.44743 0.146447 4.35367C0.0526784 4.2599 0 4.13272 0 4.00011C0 3.8675 0.0526784 3.74033 0.146447 3.64656C0.240215 3.55279 0.367392 3.50011 0.5 3.50011H1.67L2.925 0.605113C3.00948 0.410844 3.15348 0.248423 3.33622 0.141268C3.51896 0.0341136 3.73102 -0.0122382 3.9418 0.0088961C4.15259 0.0300304 4.35122 0.117559 4.50905 0.258861C4.66689 0.400163 4.77577 0.587939 4.82 0.795113L6.16 7.00011L7.54 3.81011C7.57751 3.7188 7.64121 3.64064 7.72307 3.58547C7.80493 3.53031 7.90129 3.50061 8 3.50011H9.5C9.63261 3.50011 9.75979 3.55279 9.85355 3.64656C9.94732 3.74033 10 3.8675 10 4.00011C10 4.13272 9.94732 4.2599 9.85355 4.35367C9.75979 4.44743 9.63261 4.50011 9.5 4.50011H8.33L7.075 7.39511C6.99836 7.57337 6.87153 7.72548 6.70995 7.8329C6.54837 7.94033 6.35902 7.99843 6.165 8.00011Z"
                                                        fill="white" />
                                                </svg>
                                                <span>{{ number_format($article->views) }} Views</span>
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="rs-blog-post-right">
                                <div class="rs-blog-post-social">
                                    <span class="rs-blog-post-social-title">Share This Article:</span>
                                    <div class="theme-social rs-social-links has-transform">
                                        <a href="#" class="is-facebook"><svg width="12" height="20" viewBox="0 0 12 20"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M9.9636 10.8675L10.4513 7.76501L7.40219 7.76501V5.75173C7.40219 4.90296 7.82812 4.07561 9.1937 4.07561H10.5799V1.43421C10.5799 1.43421 9.32196 1.22461 8.11928 1.22461C5.60827 1.22461 3.96696 2.71055 3.96696 5.4005V7.76501L1.17578 7.76501L1.17578 10.8675H3.96696L3.96696 18.3675H7.40219L7.40219 10.8675H9.9636Z"
                                                    fill="white"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="is-instagram">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15.8218 4.77354C15.785 3.94126 15.6505 3.36913 15.4576 2.87331C15.2588 2.34704 14.9528 1.87589 14.5519 1.48419C14.1602 1.08641 13.6859 0.777307 13.1658 0.581538C12.6671 0.388767 12.0979 0.254133 11.2657 0.217476C10.4272 0.177637 10.161 0.168457 8.0344 0.168457C5.9078 0.168457 5.64163 0.177637 4.80625 0.214355C3.974 0.251073 3.40184 0.385768 2.90618 0.578416C2.37976 0.777307 1.9086 1.08329 1.51691 1.48419C1.11913 1.87586 0.810175 2.35013 0.614252 2.87031C0.421481 3.36913 0.286878 3.9382 0.250191 4.77042C0.210382 5.60891 0.201172 5.87509 0.201172 8.00169C0.201172 10.1283 0.210382 10.3945 0.24707 11.2298C0.283788 12.0621 0.418483 12.6342 0.611284 13.1301C0.810175 13.6563 1.11913 14.1275 1.51691 14.5192C1.9086 14.917 2.38288 15.2261 2.90306 15.4218C3.40181 15.6146 3.97088 15.7492 4.80329 15.7859C5.6385 15.8227 5.90483 15.8318 8.03143 15.8318C10.158 15.8318 10.4242 15.8227 11.2596 15.7859C12.0918 15.7492 12.664 15.6146 13.1597 15.4218C13.6803 15.2206 14.153 14.9127 14.5477 14.5181C14.9424 14.1234 15.2503 13.6506 15.4516 13.1301C15.6442 12.6313 15.779 12.0621 15.8156 11.2298C15.8524 10.3945 15.8615 10.1283 15.8615 8.00169C15.8615 5.87509 15.8584 5.60888 15.8218 4.77354ZM14.4112 11.1686C14.3775 11.9336 14.249 12.3467 14.1419 12.6221C13.8787 13.3044 13.3372 13.846 12.6548 14.1092C12.3794 14.2163 11.9633 14.3448 11.2014 14.3784C10.3752 14.4152 10.1274 14.4243 8.03752 14.4243C5.94761 14.4243 5.69673 14.4152 4.87354 14.3784C4.10858 14.3448 3.6955 14.2163 3.42011 14.1092C3.08056 13.9837 2.77148 13.7848 2.52057 13.5247C2.26049 13.2708 2.06159 12.9648 1.93608 12.6252C1.82898 12.3498 1.7005 11.9336 1.66693 11.1718C1.63009 10.3456 1.62104 10.0977 1.62104 8.00778C1.62104 5.91786 1.63009 5.66699 1.66693 4.84395C1.7005 4.07898 1.82898 3.6659 1.93608 3.39052C2.06159 3.05081 2.26049 2.7418 2.52369 2.49083C2.77754 2.23074 3.08353 2.03185 3.42323 1.90649C3.69862 1.79939 4.11482 1.67088 4.87666 1.63719C5.70282 1.60047 5.95073 1.59129 8.04049 1.59129C10.1335 1.59129 10.3813 1.60047 11.2045 1.63719C11.9694 1.67091 12.3825 1.79936 12.6579 1.90646C12.9975 2.03185 13.3066 2.23074 13.5574 2.49083C13.8175 2.74482 14.0164 3.05081 14.1419 3.39052C14.249 3.6659 14.3775 4.08195 14.4112 4.84395C14.4479 5.67011 14.4571 5.91786 14.4571 8.00778C14.4571 10.0977 14.448 10.3425 14.4112 11.1686Z"
                                                    fill="white"></path>
                                                <path
                                                    d="M8.03055 3.97929C5.80915 3.97929 4.00684 5.78148 4.00684 8.003C4.00684 10.2245 5.80915 12.0267 8.03055 12.0267C10.252 12.0267 12.0543 10.2245 12.0543 8.003C12.0543 5.78148 10.252 3.97929 8.03055 3.97929ZM8.03055 10.6131C6.58942 10.6131 5.42043 9.44425 5.42043 8.003C5.42043 6.56174 6.58942 5.39294 8.03052 5.39294C9.47177 5.39294 10.6406 6.56174 10.6406 8.003C10.6406 9.44425 9.47174 10.6131 8.03055 10.6131ZM13.1528 3.82017C13.1528 4.33894 12.7322 4.75955 12.2133 4.75955C11.6946 4.75955 11.274 4.33894 11.274 3.82017C11.274 3.30134 11.6946 2.88086 12.2133 2.88086C12.7322 2.88086 13.1528 3.30131 13.1528 3.82017Z"
                                                    fill="white"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="is-twitter"><svg width="14" height="14" viewBox="0 0 14 14"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.22993 5.98838L13.0426 0.394043H11.9021L7.72331 5.25153L4.38569 0.394043H0.536133L5.58328 7.73942L0.536133 13.6059H1.67665L6.0896 8.47627L9.61438 13.6059H13.4639L8.22965 5.98838H8.22993ZM6.66784 7.80413L6.15646 7.0727L2.08759 1.2526H3.83935L7.12298 5.94961L7.63436 6.68104L11.9027 12.7864H10.1509L6.66784 7.80441V7.80413Z"
                                                    fill="white"></path>
                                            </svg></a>
                                        <a href="#" class="is-linkedin"><svg width="16" height="16" viewBox="0 0 16 16"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M15.9971 16V10.14C15.9971 7.26 15.3771 5.06 12.0171 5.06C10.3971 5.06 9.31707 5.94 8.87707 6.78H8.83707V5.32H5.65707V16H8.97707V10.7C8.97707 9.3 9.23707 7.96 10.9571 7.96C12.6571 7.96 12.6771 9.54 12.6771 10.78V15.98H15.9971V16ZM0.25707 5.32H3.57707V16H0.25707V5.32ZM1.91707 0C0.85707 0 -0.00292969 0.86 -0.00292969 1.92C-0.00292969 2.98 0.85707 3.86 1.91707 3.86C2.97707 3.86 3.83707 2.98 3.83707 1.92C3.83707 0.86 2.97707 0 1.91707 0Z"
                                                    fill="white"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="rs-blog-post-description">
                            {{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 220) }}
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="rs-blog-post-border">
                            <div class="rs-section-border-wrapper">
                                <div class="section-border">
                                    <span class="rs-section-dot"></span>
                                    <span class="rs-section-line"></span>
                                    <span class="rs-section-dot"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog post area end -->

        <!-- postbox area start -->
        <section class="rs-postbox-area section-space-bottom pt-60">
            <div class="container">
                <div class="row g-5">
                    <div class="col-xl-8 col-lg-7">
                        <div class="rs-postbox-details-wrapper">
                            <div class="rs-postbox-details-thumb mb-30">
                                <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                    alt="{{ $article->title }}">
                            </div>

                            <div class="rs-postbox-details-content">
                                @php
    $canRead = auth()->check() && auth()->user()->canReadFullArticles();
                                @endphp

                                @if($canRead)

                                    <div class="article-content">
                                        {!! $article->content !!}
                                    </div>

                                @else

                                    {{-- PREVIEW --}}
                                    <div class="article-content">
                                        {!! \Illuminate\Support\Str::limit(strip_tags($article->content), 400) !!}
                                    </div>

                                    {{-- BLUR LIMITED HEIGHT --}}
                                    <div class="position-relative mt-3" style="max-height: 220px; overflow: hidden;">

                                        <div style="filter: blur(5px); user-select: none; pointer-events: none;">
                                            {!! $article->content !!}
                                        </div>

                                        {{-- GRADIENT FADE --}}
                                        <div style="
                                                position:absolute;
                                                bottom:0;
                                                left:0;
                                                width:100%;
                                                height:120px;
                                                background: linear-gradient(to top, #fff, transparent);
                                            "></div>

                                        {{-- CTA --}}
                                        <div style="
                                                position:absolute;
                                                bottom:20px;
                                                left:0;
                                                width:100%;
                                                text-align:center;
                                            ">

                                            <h6 class="mb-2 fw-semibold">Subscribe to read full article</h6>

                                            <a href="{{ route('frontend.plans.index') }}" class="btn btn-primary btn-sm">
                                                Subscribe Now
                                            </a>

                                        </div>

                                    </div>

                                @endif

                                <div class="rs-postbox-details-social mt-30">
                                    <div class="rs-postbox-details-tags tagcloud">
                                        <span>Tags:</span>
                                        @forelse($article->tags as $tag)
                                            <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</a>
                                        @empty
                                            <a href="javascript:void(0)">News</a>
                                        @endforelse
                                    </div>

                                </div>

                                @if($relatedArticles->count())
                                    <div class="rs-postbox-related-post mt-30">
                                        <div class="rs-postbox-comments-title mb-25">
                                            <h5>Related News</h5>
                                        </div>

                                        <div class="row g-4">
                                            @foreach($relatedArticles as $related)
                                                <div class="col-xl-6 col-lg-6">
                                                    <div class="rs-postbox-related-item">
                                                        <div class="rs-postbox-related-thumb mb-15">
                                                            <a href="{{ route('news.show', $related->slug) }}">
                                                                <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : asset('assets/images/default/news-placeholder.webp') }}"
                                                                    alt="{{ $related->title }}">
                                                            </a>
                                                        </div>
                                                        <h6>
                                                            <a href="{{ route('news.show', $related->slug) }}">
                                                                {{ \Illuminate\Support\Str::limit($related->title, 70) }}
                                                            </a>
                                                        </h6>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="rs-postbox-comment-form">
                                    <div class="rs-postbox-comments-title mt-35 mb-25">
                                        <h5>Leave a Comment</h5>
                                    </div>
                                    <form>
                                        <div class="row g-4">
                                            <div class="col-xl-6">
                                                <div class="rs-contact-input-box">
                                                    <div class="rs-contact-input-title">
                                                        <label for="name">Full Name<span>*</span></label>
                                                    </div>
                                                    <div class="rs-contact-input">
                                                        <input id="name" name="name" type="text" placeholder="Your Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6">
                                                <div class="rs-contact-input-box">
                                                    <div class="rs-contact-input-title">
                                                        <label for="name">Email Address<span>*</span></label>
                                                    </div>
                                                    <div class="rs-contact-input">
                                                        <input id="email" name="email" type="email" placeholder="Your Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="rs-contact-input-box">
                                                    <div class="rs-contact-input-title">
                                                        <label for="name">Message<span>*</span></label>
                                                    </div>
                                                    <div class="rs-contact-input">
                                                        <textarea id="message" name="message" placeholder="Write Message"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <div class="rs-postbox-comment-btn">
                                                    <button type="submit" class="rs-btn has-icon">
                                                        Post Comment
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
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        @include('news.partials.news-sidebar')

                    </div>
                </div>
            </div>
        </section>
        <!-- rs-postbox area end -->

@endsection