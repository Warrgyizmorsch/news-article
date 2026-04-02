<div class="da-newsletter-modal {{ (session('newsletter_success') || $errors->has('email')) ? 'active' : '' }}"
  id="daNewsletterModal">
  <div class="da-newsletter-overlay"></div>

  <div class="da-newsletter-dialog">
    <button type="button" class="da-newsletter-close" id="daNewsletterClose">
      <i class="ri-close-line"></i>
    </button>

    <div class="da-newsletter-left">
        <img
          src="{{ asset('assets/images/contact/contact-modal.webp') }}"
          alt="Subscribe and login">
    </div>

    <div class="da-newsletter-right">
      <div class="da-newsletter-logo">
        <img src="{{ asset('assets/images/logo/democracy-asia-logo.webp') }}" alt="Democracy Asia">
      </div>

      @if(session('newsletter_success'))
          <div class="newsletter-success-box">

            <div class="newsletter-success-icon">
              <i class="ri-checkbox-circle-fill"></i>
            </div>

            <h3>
              {{ session('newsletter_success') === 'Login successful.'
    ? 'Login Successful 🎉'
    : 'Subscription Successful 🎉' }}
            </h3>

            <p>
              @if(session('newsletter_success') === 'Login successful.')
                You are now logged in. Enjoy personalized content and updates.
              @else
                Thank you for subscribing! You will now receive the latest headlines,
                exclusive reports, and important updates from Democracy Asia.
              @endif
            </p>

            <button onclick="document.getElementById('daNewsletterModal').classList.remove('active')"
              class="da-newsletter-btn">
              Continue Reading
            </button>

          </div>

      @else
        <div>
          <h3>Unlock Your Daily Briefing</h3>
          <p>Get the latest headlines, exclusive reports, and important updates delivered directly to your inbox.</p>

          <form method="POST" action="{{ route('newsletter.subscribe') }}" class="da-newsletter-form">
            @csrf

            <input type="hidden" name="mode" id="modalMode" value="subscribe">

            <div class="da-newsletter-field">
              <input type="email" name="email" placeholder="Enter your email..." value="{{ old('email') }}" required>
              @error('email')
                <small style="color: #dc3545; margin-top: 5px; display: block;">{{ $message }}</small>
              @enderror
            </div>

            <label class="da-newsletter-check" style="display: flex !important;">
              <input type="checkbox" name="terms" required style="display: block !important;">
              <span>I agree to the <a href="#">terms & conditions</a></span>
            </label>

            <button type="submit" class="da-newsletter-btn">Subscribe</button>
          </form>
        </div>

      @endif


    </div>
  </div>
</div>

<script>
  // Close modal logic
  document.getElementById('daNewsletterClose').addEventListener('click', function () {
    document.getElementById('daNewsletterModal').classList.remove('active');
  });

  // Optional: Close when clicking overlay
  document.querySelector('.da-newsletter-overlay').addEventListener('click', function () {
    document.getElementById('daNewsletterModal').classList.remove('active');
  });
</script>

<style>
  .da-newsletter-modal {
    position: fixed;
    inset: 0;
    z-index: 99999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease, visibility 0.3s ease;
  }

  .da-newsletter-modal.active {
    opacity: 1;
    visibility: visible;
  }

  .da-newsletter-overlay {
    position: absolute;
    inset: 0;
    background: rgba(10, 16, 28, 0.58);
  }

  .da-newsletter-dialog {
    position: relative;
    z-index: 2;
    width: 100%;
    max-width: 780px;
    max-height: 90vh;
    background: #ffffff;
    border-radius: 20px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 0.9fr 1.1fr;
    box-shadow: 0 24px 70px rgba(0, 0, 0, 0.22);
    transform: translateY(16px);
    transition: transform 0.3s ease;
  }

  .da-newsletter-modal.active .da-newsletter-dialog {
    transform: translateY(0);
  }

  .da-newsletter-close {
    position: absolute;
    top: 12px;
    right: 14px;
    z-index: 5;
    width: 34px;
    height: 34px;
    border: 0;
    background: transparent;
    color: #0d6efd;
    font-size: 28px;
    line-height: 1;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .da-newsletter-left {
    min-height: 360px;
    background: #9fdcff;
  }

  .da-newsletter-left img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
  }

  .da-newsletter-right {
    padding: 34px 36px 28px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .da-newsletter-logo {
    margin-bottom: 12px;
  }

  .da-newsletter-logo img {
    max-height: 38px;
    width: auto;
    display: block;
  }

  .da-newsletter-right h3 {
    font-size: 32px;
    line-height: 1.15;
    font-weight: 700;
    color: #101828;
    margin-bottom: 12px;
    letter-spacing: -0.02em;
    max-width: 420px;
  }

  .da-newsletter-right p {
    font-size: 15px;
    line-height: 1.65;
    color: #667085;
    margin-bottom: 20px;
    max-width: 470px;
  }

  .da-newsletter-form {
    max-width: 470px;
  }

  .da-newsletter-field {
    margin-bottom: 12px;
  }

  .da-newsletter-field input {
    width: 100%;
    height: 50px;
    border: 1px solid #d9dde5;
    border-radius: 10px;
    padding: 0 16px;
    font-size: 15px;
    color: #111827;
    outline: none;
    transition: all 0.25s ease;
    background: #fff;
  }

  .da-newsletter-field input:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.08);
  }

  .da-newsletter-check {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    margin: 6px 0 16px;
    font-size: 14px;
    line-height: 1.5;
    color: #475467;
    cursor: pointer;
  }

  .da-newsletter-check input {
    margin-top: 3px;
    width: 16px;
    height: 16px;
    flex: 0 0 16px;
  }

  .da-newsletter-check a {
    color: #475467;
    text-decoration: underline;
  }

  .da-newsletter-btn {
    min-width: 150px;
    height: 46px;
    border: 0;
    border-radius: 10px;
    background: #0d6efd;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    padding: 0 24px;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  .da-newsletter-btn:hover {
    background: #0b5ed7;
  }

  .da-newsletter-social {
    display: flex;
    gap: 12px;
    margin-top: 18px;
  }

  .da-newsletter-social a {
    width: 38px;
    height: 38px;
    border: 1px solid #e5e7eb;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #111827;
    font-size: 17px;
    transition: all 0.25s ease;
    text-decoration: none;
  }

  .da-newsletter-social a:hover {
    background: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
  }

  @media (max-width: 991px) {
    .da-newsletter-dialog {
      max-width: 620px;
      grid-template-columns: 1fr;
    }

    .da-newsletter-left {
      display: none;
    }

    .da-newsletter-right {
      padding: 28px 24px 22px;
    }

    .da-newsletter-right h3 {
      font-size: 26px;
      max-width: 100%;
    }

    .da-newsletter-right p,
    .da-newsletter-form {
      max-width: 100%;
    }
  }

  @media (max-width: 575px) {
    .da-newsletter-modal {
      padding: 12px;
    }

    .da-newsletter-dialog {
      border-radius: 16px;
    }

    .da-newsletter-right {
      padding: 24px 16px 18px;
    }

    .da-newsletter-close {
      top: 10px;
      right: 10px;
      width: 30px;
      height: 30px;
      font-size: 24px;
    }

    .da-newsletter-right h3 {
      font-size: 22px;
      margin-bottom: 10px;
    }

    .da-newsletter-right p {
      font-size: 14px;
      margin-bottom: 16px;
    }

    .da-newsletter-field input {
      height: 46px;
      font-size: 14px;
      padding: 0 14px;
    }

    .da-newsletter-btn {
      width: 100%;
      height: 44px;
      font-size: 15px;
    }

    .da-newsletter-social {
      margin-top: 14px;
    }

    .da-newsletter-social a {
      width: 36px;
      height: 36px;
      font-size: 16px;
    }
  }

  .newsletter-success-box {
    text-align: center;
    padding: 20px 10px;
  }

  .newsletter-success-icon {
    font-size: 60px;
    color: #22c55e;
    margin-bottom: 15px;
  }

  .newsletter-success-box h3 {
    font-size: 28px;
    margin-bottom: 10px;
  }

  .newsletter-success-box p {
    color: #667085;
    font-size: 15px;
    margin-bottom: 20px;
  }
</style>