@extends('layouts.app')

@section('title', 'Confirm Subscription')

@section('content')
    <section class="rs-breadcrumb-area rs-breadcrumb-one p-relative">
        <div class="rs-breadcrumb-bg"
            style="background-image: url('{{ asset('assets/images/breadcrumb/breadcrumb-bg.jpg') }}');"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rs-breadcrumb-content-wrapper text-center">
                        <div class="rs-breadcrumb-title-wrapper">
                            <h1 class="rs-breadcrumb-title">Confirm Subscription</h1>
                        </div>
                        <div class="rs-breadcrumb-menu">
                            <nav>
                                <ul>
                                    <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                    <li><span><a href="{{ route('frontend.plans.index') }}">Plans</a></span></li>
                                    <li><span>Confirm</span></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="rs-postbox-area section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8">
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-body p-4 p-md-5">
                            <div class="text-center mb-4">
                                <span class="badge bg-danger text-white px-3 py-2 mb-3">{{ $plan->name }}</span>
                                <h2 class="mb-2">₹{{ number_format($plan->price, 2) }}</h2>
                                <p class="text-muted mb-0">{{ $plan->duration_days }} Days Access</p>
                            </div>

                            <div class="mb-4">
                                <h5 class="mb-3">Plan Summary</h5>
                                <p class="mb-2">
                                    {{ $plan->description ?: 'This subscription gives you access to premium articles and complete news content.' }}
                                </p>
                                <ul style="padding-left: 18px;">
                                    <li>Full premium article access</li>
                                    <li>Readable full content without blur</li>
                                    <li>Valid for {{ $plan->duration_days }} days from activation</li>
                                </ul>
                            </div>

                            <div class="alert alert-warning">
                                This is the confirmation step before final activation. Later, payment gateway or manual
                                payment approval can be added here.
                            </div>

                            <form action="{{ route('plans.subscribe', $plan->slug) }}" method="POST">
                                @csrf

                                <div class="d-flex flex-wrap gap-3">
                                    <a href="{{ route('frontend.plans.index') }}"
                                        class="rs-btn rs-btn-secondary text-center">
                                        Back to Plans
                                    </a>

                                    <button type="submit" class="rs-btn text-center">
                                        Confirm & Subscribe
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection