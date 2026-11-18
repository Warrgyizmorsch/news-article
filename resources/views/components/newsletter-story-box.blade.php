@php
    $boxHeading = $heading ?? "Get Asia's story of the week, free.";
    $boxSubtext = $subtext ?? "One essential read on politics, power and democracy across Asia — delivered every week.";
    $btnText = $buttonText ?? "Subscribe Free";
    $inputPlaceholder = $placeholder ?? "Enter your email address";
    $extraClass = $class ?? "";
    // When true, the card also shows the "Follow us" social row and drops the extra copy
    $withSocial = $showSocial ?? false;
    $socialLinks = [
        ['name' => 'X', 'url' => 'https://x.com/Democracyasia', 'icon' => 'ri-twitter-x-line', 'color' => '#000000'],
        ['name' => 'YouTube', 'url' => 'https://www.youtube.com/@democracyasiaofficial', 'icon' => 'ri-youtube-fill', 'color' => '#ff0000'],
        ['name' => 'Instagram', 'url' => 'https://www.instagram.com/democracyasiaofficial', 'icon' => 'ri-instagram-line', 'color' => '#d6249f'],
        ['name' => 'TikTok', 'url' => 'https://www.tiktok.com/@democracyasia', 'icon' => 'ri-tiktok-fill', 'color' => '#000000'],
        ['name' => 'Facebook', 'url' => 'https://www.facebook.com/democracyasia/', 'icon' => 'ri-facebook-fill', 'color' => '#1877f2'],
        ['name' => 'LinkedIn', 'url' => 'https://www.linkedin.com/company/democracy-asia', 'icon' => 'ri-linkedin-fill', 'color' => '#0a66c2'],
        ['name' => 'Pinterest', 'url' => 'https://in.pinterest.com/democracyasia/', 'icon' => 'ri-pinterest-fill', 'color' => '#bd081c'],
    ];
@endphp

<div class="rs-newsletter-story-box {{ $withSocial ? 'has-social' : '' }} {{ $extraClass }}">
    <div class="rs-newsletter-glow" aria-hidden="true"></div>

    <div class="rs-newsletter-flex">
        <!-- Left: Icon + Copy -->
        <div class="rs-newsletter-copy">
            <span class="rs-newsletter-icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                    <path d="m22 7-10 6L2 7"></path>
                </svg>
            </span>
            <div>
                <span class="rs-newsletter-eyebrow">Weekly Newsletter</span>
                <h3 class="rs-newsletter-heading">{{ $boxHeading }}</h3>
                @unless($withSocial)
                    <p class="rs-newsletter-subtext">{{ $boxSubtext }}</p>
                @endunless
            </div>
        </div>

        <!-- Right: Form -->
        <div class="rs-newsletter-form-wrap">
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="rs-newsletter-form">
                @csrf
                <input type="hidden" name="mode" value="subscribe">
                <div class="rs-newsletter-bar">
                    <svg class="rs-newsletter-input-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-4 8"></path>
                    </svg>
                    <input type="email" name="email" placeholder="{{ $inputPlaceholder }}" required
                           aria-label="Email address" autocomplete="email" class="rs-newsletter-input">
                    <button type="submit" class="rs-newsletter-btn">
                        <span>{{ $btnText }}</span>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
                @unless($withSocial)
                    <p class="rs-newsletter-note">Free forever. No spam — unsubscribe anytime.</p>
                @endunless
            </form>
        </div>
    </div>

    @if($withSocial)
        <div class="rs-newsletter-social">
            <span class="rs-newsletter-social-label">Follow us</span>
            <div class="rs-newsletter-social-icons">
                @foreach($socialLinks as $social)
                    <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer"
                       title="{{ $social['name'] }}" aria-label="Democracy Asia on {{ $social['name'] }}"
                       style="--brand: {{ $social['color'] }};">
                        <i class="{{ $social['icon'] }}"></i>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

<style>
.rs-newsletter-story-box {
    position: relative;
    overflow: hidden;
    background:
        linear-gradient(135deg, rgba(225, 18, 11, 0.10) 0%, transparent 45%),
        linear-gradient(135deg, #111b2c 0%, #070b13 100%);
    border-radius: 16px;
    padding: 32px 40px;
    margin: 24px 0;
    box-shadow: 0 18px 40px -18px rgba(7, 11, 19, 0.55);
    border: 1px solid rgba(255, 255, 255, 0.07);
}

/* Red accent strip on the left edge */
.rs-newsletter-story-box::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, #ff3b30 0%, #e1120b 100%);
}

.rs-newsletter-glow {
    position: absolute;
    right: -80px;
    bottom: -120px;
    width: 320px;
    height: 320px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(225, 18, 11, 0.18) 0%, transparent 70%);
    pointer-events: none;
}

.rs-newsletter-flex {
    position: relative;
    z-index: 2;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 24px 40px;
}

.rs-newsletter-copy {
    flex: 1 1 320px;
    display: flex;
    align-items: flex-start;
    gap: 16px;
    min-width: 0;
}

.rs-newsletter-icon {
    flex-shrink: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 12px;
    color: #ff4d45;
    background: rgba(225, 18, 11, 0.12);
    border: 1px solid rgba(225, 18, 11, 0.28);
}

.rs-newsletter-eyebrow {
    display: inline-block;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: #ff4d45;
    margin-bottom: 6px;
}

.rs-newsletter-story-box .rs-newsletter-heading {
    font-family: var(--rr-ff-serif, 'Playfair Display', Georgia, serif);
    color: #ffffff;
    font-size: 26px;
    font-weight: 700;
    margin: 0 0 6px;
    line-height: 1.25;
    letter-spacing: -0.01em;
}

.rs-newsletter-subtext {
    margin: 0;
    font-size: 14px;
    line-height: 1.55;
    color: rgba(255, 255, 255, 0.62);
    max-width: 460px;
}

.rs-newsletter-form-wrap {
    flex: 1 1 380px;
    max-width: 480px;
}

.rs-newsletter-form {
    margin: 0;
}

.rs-newsletter-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.05);
    padding: 6px 6px 6px 16px;
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.14);
    transition: border-color 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
}

.rs-newsletter-bar:focus-within {
    border-color: rgba(255, 77, 69, 0.75);
    background: rgba(255, 255, 255, 0.08);
    box-shadow: 0 0 0 4px rgba(225, 18, 11, 0.15);
}

.rs-newsletter-input-icon {
    flex-shrink: 0;
    color: rgba(255, 255, 255, 0.45);
}

/* Reset theme input styles that otherwise add borders/height/shadow */
.rs-newsletter-story-box .rs-newsletter-input,
.rs-newsletter-story-box .rs-newsletter-input:focus {
    flex: 1;
    min-width: 0;
    width: auto;
    height: auto;
    background: transparent;
    border: 0;
    border-radius: 0;
    box-shadow: none;
    outline: none;
    color: #ffffff;
    font-size: 15px;
    line-height: 1.4;
    padding: 10px 0;
    margin: 0;
}

.rs-newsletter-story-box .rs-newsletter-input::placeholder {
    color: rgba(255, 255, 255, 0.42);
    opacity: 1;
}

.rs-newsletter-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: linear-gradient(180deg, #f0261f 0%, #d10f08 100%);
    color: #ffffff;
    font-weight: 700;
    font-size: 14px;
    border: none;
    border-radius: 9px;
    padding: 12px 20px;
    cursor: pointer;
    white-space: nowrap;
    flex-shrink: 0;
    line-height: 1.2;
    transition: transform 0.2s ease, box-shadow 0.2s ease, filter 0.2s ease;
}

.rs-newsletter-btn svg {
    transition: transform 0.2s ease;
}

.rs-newsletter-btn:hover {
    filter: brightness(1.08);
    box-shadow: 0 8px 20px -6px rgba(225, 18, 11, 0.6);
}

.rs-newsletter-btn:hover svg {
    transform: translateX(3px);
}

.rs-newsletter-btn:focus-visible {
    outline: 2px solid #ffffff;
    outline-offset: 2px;
}

.rs-newsletter-note {
    margin: 10px 0 0 4px;
    font-size: 12px;
    color: rgba(255, 255, 255, 0.45);
}

/* Merged card: heading left, compact form right, social row below */
.rs-newsletter-story-box.has-social .rs-newsletter-flex {
    gap: 18px 32px;
}

.rs-newsletter-story-box.has-social .rs-newsletter-copy {
    flex: 1 1 280px;
    align-items: center;
}

.rs-newsletter-story-box.has-social .rs-newsletter-form-wrap {
    flex: 0 1 400px;
    max-width: 400px;
}

@media (max-width: 767px) {
    .rs-newsletter-story-box.has-social .rs-newsletter-form-wrap {
        flex-basis: 100%;
        max-width: 100%;
    }
}

.rs-newsletter-story-box.has-social .rs-newsletter-heading {
    margin-bottom: 0;
}

/* Social row (merged "Follow us") */
.rs-newsletter-social {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px 20px;
    margin-top: 22px;
    padding-top: 18px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
}

.rs-newsletter-social-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: rgba(255, 255, 255, 0.55);
}

.rs-newsletter-social-icons {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.rs-newsletter-social-icons a {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    text-decoration: none;
    transition: background 0.2s ease, color 0.2s ease, border-color 0.2s ease, transform 0.2s ease;
}

.rs-newsletter-social-icons a:hover,
.rs-newsletter-social-icons a:focus-visible {
    color: #ffffff;
    background: var(--brand);
    border-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
}

/* RESPONSIVE */
@media (max-width: 767px) {
    .rs-newsletter-story-box {
        padding: 26px 24px;
    }

    .rs-newsletter-story-box .rs-newsletter-heading {
        font-size: 22px;
    }

    .rs-newsletter-form-wrap {
        max-width: 100%;
    }
}

@media (max-width: 575px) {
    .rs-newsletter-story-box {
        padding: 22px 18px;
        border-radius: 14px;
    }

    .rs-newsletter-icon {
        display: none;
    }

    .rs-newsletter-story-box .rs-newsletter-heading {
        font-size: 20px;
    }

    .rs-newsletter-bar {
        flex-wrap: wrap;
        padding: 6px;
    }

    .rs-newsletter-input-icon {
        margin-left: 10px;
    }

    .rs-newsletter-story-box .rs-newsletter-input {
        flex: 1 1 0;
    }

    .rs-newsletter-btn {
        flex: 1 1 100%;
        padding: 13px;
    }
}
</style>
