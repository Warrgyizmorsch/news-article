@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')

    {{-- Success Message --}}
    @if(session('success'))
        <div class="container mt-4">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif


    <!-- ================================= -->
    <!-- HERO CONTACT SECTION -->
    <!-- ================================= -->

    <section class="rs-banner-area section-space-top section-space-bottom">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <div class="section-title-wrapper">

                        <h2 class="section-title rs-split-text-enable split-in-left">
                            Get in Touch With Us
                        </h2>

                        <p class="mt-3">
                            Have questions, suggestions, or business enquiries?
                            Our team would love to hear from you. Fill out the form and we’ll respond as soon as possible.
                        </p>

                        <div class="mt-4">

                            <div class="d-flex mb-3">
                                <div class="me-3">
                                    <i class="ri-mail-line" style="font-size:22px"></i>
                                </div>
                                <div>
                                    <strong>Email</strong><br>
                                    info@democracyasia.com
                                </div>
                            </div>

                            <div class="d-flex mb-3">
                                <div class="me-3">
                                    <i class="ri-phone-line" style="font-size:22px"></i>
                                </div>
                                <div>
                                    <strong>Phone</strong><br>
                                    07974960666
                                </div>
                            </div>

                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="ri-map-pin-line" style="font-size:22px"></i>
                                </div>
                                <div>
                                    <strong>Location</strong><br>
                                   35 Bow Road, London, England, E3 2AD

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <img src="{{ asset('assets/images/contact/contact-thumb-01.webp') }}" alt="contact image"
                        style="border-radius:10px;">
                </div>

            </div>
        </div>
    </section>


    <!-- ================================= -->
    <!-- CONTACT FORM SECTION -->
    <!-- ================================= -->

    <section class="rs-contact-area rs-contact-two section-space-bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="rs-contact-wrapper">

                        <div class="rs-contact-form">
                            <h3 class="rs-contact-form-title">Send Us a Message</h3>

                            <form method="POST" action="{{ route('contact.send') }}">
                                @csrf

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="rs-contact-input-box">
                                            <label>Full Name *</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                placeholder="Your Name">

                                            @error('name')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="rs-contact-input-box">
                                            <label>Email *</label>
                                            <input type="email" name="email" value="{{ old('email') }}"
                                                placeholder="Email Address">

                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="rs-contact-input-box">
                                            <label>Phone</label>
                                            <input type="text" name="phone" value="{{ old('phone') }}"
                                                placeholder="Phone Number">

                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="rs-contact-input-box">
                                            <label>Website</label>
                                            <input type="text" name="website" value="{{ old('website') }}"
                                                placeholder="https://example.com">

                                            @error('website')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="rs-contact-input-box">
                                            <label>Message *</label>
                                            <textarea name="message"
                                                placeholder="Write your message...">{{ old('message') }}</textarea>

                                            @error('message')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="rs-contact-btn">
                                            <button type="submit" class="rs-btn has-icon">
                                                Send Message
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>


                        <div class="rs-contact-thumb">
                            <img src="{{ asset('assets/images/contact/contact-thumb-04.webp') }}" alt="contact">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- ================================= -->
    <!-- GOOGLE MAP -->
    <!-- ================================= -->

    <div class="rs-map-area rs-map-one">
        <div class="rs-google-map">
            <iframe
                src="https://maps.google.com/maps?q=Central%20District%20Hong%20Kong&t=&z=13&ie=UTF8&iwloc=&output=embed"
                allowfullscreen loading="lazy">
            </iframe>
        </div>
    </div>

@endsection