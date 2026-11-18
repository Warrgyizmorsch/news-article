@php
    $boxHeading = $heading ?? "Get Asia's story of the week, free.";
    $btnText = $buttonText ?? "Subscribe Free";
    $inputPlaceholder = $placeholder ?? "Enter your email address...";
    $extraClass = $class ?? "";
@endphp

<div class="rs-newsletter-story-box {{ $extraClass }}">
    <!-- Background Glow Accent -->
    <div class="rs-newsletter-glow"></div>

    <div class="rs-newsletter-flex">
        <!-- Left Side: Heading Only -->
        <div class="rs-newsletter-heading-wrap">
            <h3 class="rs-newsletter-heading">
                {{ $boxHeading }}
            </h3>
        </div>

        <!-- Right Side: Email Input and Subscribe Button -->
        <div class="rs-newsletter-form-wrap">
            <form action="{{ route('newsletter.subscribe') }}" method="POST" class="rs-newsletter-form">
                @csrf
                <input type="hidden" name="mode" value="subscribe">
                <div class="rs-newsletter-bar">
                    <input type="email" name="email" placeholder="{{ $inputPlaceholder }}" required class="rs-newsletter-input">
                    <button type="submit" class="rs-newsletter-btn">
                        {{ $btnText }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.rs-newsletter-story-box {
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #0e1726 0%, #080d16 100%);
    border-radius: 14px;
    padding: 24px 34px;
    margin: 24px 0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.rs-newsletter-glow {
    position: absolute;
    right: -40px;
    top: -40px;
    width: 220px;
    height: 220px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(225, 18, 11, 0.14) 0%, transparent 70%);
    pointer-events: none;
}

.rs-newsletter-flex {
    position: relative;
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 28px;
}

.rs-newsletter-heading-wrap {
    flex: 1 1 auto;
}

.rs-newsletter-heading {
    font-family: var(--rr-ff-serif, 'Playfair Display', Georgia, serif);
    color: #ffffff;
    font-size: 24px;
    font-weight: 700;
    margin: 0;
    line-height: 1.3;
    letter-spacing: -0.01em;
}

.rs-newsletter-form-wrap {
    flex: 0 0 auto;
    width: 100%;
    max-width: 460px;
}

.rs-newsletter-form {
    margin: 0;
}

.rs-newsletter-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.06);
    padding: 5px 5px 5px 16px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.16);
    transition: all 0.25s ease;
}

.rs-newsletter-bar:focus-within {
    border-color: #e1120b;
    background: rgba(255, 255, 255, 0.09);
    box-shadow: 0 0 0 3px rgba(225, 18, 11, 0.2);
}

.rs-newsletter-input {
    flex: 1;
    min-width: 0;
    background: transparent;
    border: none;
    color: #ffffff;
    font-size: 14px;
    outline: none;
    padding: 8px 0;
}

.rs-newsletter-input::placeholder {
    color: rgba(255, 255, 255, 0.45);
}

.rs-newsletter-btn {
    background: #e1120b;
    color: #ffffff;
    font-weight: 700;
    font-size: 14px;
    border: none;
    border-radius: 7px;
    padding: 10px 22px;
    cursor: pointer;
    transition: all 0.2s ease;
    white-space: nowrap;
    flex-shrink: 0;
    line-height: 1.4;
}

.rs-newsletter-btn:hover {
    background: #b80d07;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(225, 18, 11, 0.35);
}

/* RESPONSIVE DESIGN */
@media (max-width: 991px) {
    .rs-newsletter-flex {
        flex-direction: column;
        align-items: stretch;
        gap: 16px;
    }

    .rs-newsletter-form-wrap {
        max-width: 100%;
    }

    .rs-newsletter-heading {
        font-size: 21px;
    }
}

@media (max-width: 575px) {
    .rs-newsletter-story-box {
        padding: 20px 16px;
        border-radius: 12px;
    }

    .rs-newsletter-heading {
        font-size: 18px;
    }

    .rs-newsletter-bar {
        flex-direction: column;
        background: transparent;
        border: none;
        padding: 0;
        gap: 10px;
    }

    .rs-newsletter-bar:focus-within {
        background: transparent;
        box-shadow: none;
    }

    .rs-newsletter-input {
        width: 100%;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        padding: 12px 14px;
    }

    .rs-newsletter-btn {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
    }
}
</style>
