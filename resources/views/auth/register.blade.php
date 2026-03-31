@extends('layouts.app')

@section('content')
    <section class="rs-login-area section-space">
        <div class="container">
            <div class="row gx-0 gy-0 justify-content-center">
                <div class="col-xl-5 col-lg-6">
                    <div class="rs-login-wrapper text-center">
                        <h3 class="rs-login-title mb-10">Subscribe Free</h3>

                        <p class="mb-15" style="line-height: 1.5;">
                            Create your free subscription account to receive timely alerts, featured stories,
                            and key updates from <strong>Democracy Asia</strong> delivered directly to your inbox.
                        </p>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Name --}}
                            <div class="input-box mb-15">
                                <input id="name" type="text" name="name" class="input" value="{{ old('name') }}" required
                                    autofocus autocomplete="name" placeholder="Full Name">
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-start d-block" />
                            </div>

                            {{-- Email --}}
                            <div class="input-box mb-15">
                                <input id="email" type="email" name="email" class="input" value="{{ old('email') }}"
                                    required autocomplete="username" placeholder="Email Address">
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-start d-block" />
                            </div>

                            {{-- Password --}}
                            <div class="input-box mb-15">
                                <input id="password" type="password" name="password" class="input" required
                                    autocomplete="new-password" placeholder="Password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-start d-block" />
                            </div>

                            {{-- Confirm Password --}}
                            <div class="input-box mb-20">
                                <input id="password_confirmation" type="password" name="password_confirmation" class="input"
                                    required autocomplete="new-password" placeholder="Confirm Password">
                                <x-input-error :messages="$errors->get('password_confirmation')"
                                    class="mt-2 text-start d-block" />
                            </div>

                            <div class="rs-login-btn">
                                <button type="submit" class="rs-btn hover-white">Subscribe</button>
                            </div>
                        </form>

                        <div id="form-messages"></div>

                        <div class="rs-login-meta-divider-wrapper">
                            <div class="rs-login-meta-divider-line left-line"></div>
                            <span class="rs-login-meta-divider-title">or</span>
                            <div class="rs-login-meta-divider-line right-line"></div>
                        </div>

                        <div class="rs-login-social mt-20 mb-20">
                            <div class="theme-social rs-social-links has-transform">
                                <a href="#" class="is-facebook">
                                    <svg width="12" height="20" viewBox="0 0 12 20" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
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

                                <a href="#" class="is-twitter">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M8.22993 5.98838L13.0426 0.394043H11.9021L7.72331 5.25153L4.38569 0.394043H0.536133L5.58328 7.73942L0.536133 13.6059H1.67665L6.0896 8.47627L9.61438 13.6059H13.4639L8.22965 5.98838H8.22993ZM6.66784 7.80413L6.15646 7.0727L2.08759 1.2526H3.83935L7.12298 5.94961L7.63436 6.68104L11.9027 12.7864H10.1509L6.66784 7.80441V7.80413Z"
                                            fill="white"></path>
                                    </svg>
                                </a>

                                <a href="#" class="is-linkedin">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.9971 16V10.14C15.9971 7.26 15.3771 5.06 12.0171 5.06C10.3971 5.06 9.31707 5.94 8.87707 6.78H8.83707V5.32H5.65707V16H8.97707V10.7C8.97707 9.3 9.23707 7.96 10.9571 7.96C12.6571 7.96 12.6771 9.54 12.6771 10.78V15.98H15.9971V16ZM0.25707 5.32H3.57707V16H0.25707V5.32ZM1.91707 0C0.85707 0 -0.00292969 0.86 -0.00292969 1.92C-0.00292969 2.98 0.85707 3.86 1.91707 3.86C2.97707 3.86 3.83707 2.98 3.83707 1.92C3.83707 0.86 2.97707 0 1.91707 0Z"
                                            fill="white"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <div class="rs-login-label text-center">
                            Already have an account?
                            <a href="{{ route('login') }}" class="rs-login-link"> Sign in</a>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-6">
                    <div class="rs-login-thumb">
                        <img src="{{ asset('assets/images/contact/contact-thumb-05.webp') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection