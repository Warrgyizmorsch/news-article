@extends('layouts.app')

@section('title', 'Subscription Plans')

@section('content')
    <section class="rs-breadcrumb-area rs-breadcrumb-one p-relative">
        <div class="rs-breadcrumb-bg"
            style="background-image: url('{{ asset('assets/images/breadcrumb/breadcrumb-bg.jpg') }}');"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rs-breadcrumb-content-wrapper text-center">
                        <div class="rs-breadcrumb-title-wrapper">
                            <h1 class="rs-breadcrumb-title">Choose Your Plan</h1>
                        </div>
                        <div class="rs-breadcrumb-menu">
                            <nav>
                                <ul>
                                    <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                    <li><span>Subscription Plans</span></li>
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

            @if(session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger mb-4">
                    {{ session('error') }}
                </div>
            @endif

            @auth
                @if($user && $user->role === 'admin')
                    <div class="row justify-content-center mb-40">
                        <div class="col-lg-10">
                            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                                <div class="card-body p-4">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                        <div>
                                            <span class="badge bg-success text-white px-3 py-2 mb-2">Admin Access</span>
                                            <h4 class="mb-1">Full Premium Access Enabled</h4>
                                            <p class="mb-0 text-muted">
                                                Your administrator account already has unrestricted access to all articles and premium content.
                                            </p>
                                        </div>

                                        <div>
                                            <a href="{{ route('dashboard') }}" class="rs-btn rs-btn-secondary text-center">
                                                Go to Dashboard
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($activeSubscription)
                    <div class="row justify-content-center mb-40">
                        <div class="col-lg-10">
                            <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                                <div class="card-body p-4">
                                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                                        <div>
                                            <span class="badge bg-success text-white px-3 py-2 mb-2">Active Subscription</span>
                                            <h4 class="mb-1">{{ $activeSubscription->plan?->name }}</h4>
                                            <p class="mb-0 text-muted">
                                                Valid till {{ \Carbon\Carbon::parse($activeSubscription->end_date)->format('d M Y') }}
                                            </p>
                                        </div>

                                        <div>
                                            <a href="{{ route('profile.edit') }}" class="rs-btn rs-btn-secondary text-center">
                                                View Profile
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            <div class="row justify-content-center mb-40">
                <div class="col-lg-8">
                    <div class="section-title-wrapper text-center">
                        <h2 class="section-title">
                            @auth
                                @if($user && $user->role === 'admin')
                                    Premium Access Overview
                                @else
                                    Unlock Full Access to Premium News
                                @endif
                            @else
                                Unlock Full Access to Premium News
                            @endauth
                        </h2>

                        <p>
                            @auth
                                @if($user && $user->role === 'admin')
                                    These plans are available for subscriber accounts. Your admin role already includes full access.
                                @else
                                    Choose a subscription plan and get complete access to full articles, insights, and premium content.
                                @endif
                            @else
                                Choose a subscription plan and get complete access to full articles, insights, and premium content.
                            @endauth
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse($plans as $plan)
                    <div class="col-xl-4 col-lg-6 col-md-6 mb-30">
                        <div class="rs-post-item rs-post-item-five h-100"
                            style="padding: 35px; border: 1px solid #e9e9e9; border-radius: 12px;">
                            <div class="rs-post-content">
                                <div class="rs-post-meta mb-15">
                                    <span class="badge bg-danger text-white px-3 py-2">{{ $plan->name }}</span>
                                </div>

                                <h3 class="rs-post-title mb-15">
                                    ₹{{ number_format($plan->price, 2) }}
                                </h3>

                                <p class="mb-10">
                                    <strong>{{ $plan->duration_days }} Days</strong> access
                                </p>

                                <p class="mb-25">
                                    {{ $plan->description ?: 'Get access to all premium articles and subscriber-only content.' }}
                                </p>

                                <ul class="mb-30" style="padding-left: 18px;">
                                    <li>Full article access</li>
                                    <li>Premium content visibility</li>
                                    <li>Subscriber-only reading experience</li>
                                </ul>

                                @auth
                                    @if($user && $user->role === 'admin')
                                        <span class="rs-btn rs-btn-secondary w-100 text-center"
                                            style="display:inline-block; opacity:0.85; cursor:default;">
                                            Admin Access Enabled
                                        </span>
                                    @elseif($activeSubscription && $activeSubscription->subscription_plan_id == $plan->id)
                                        <span class="rs-btn rs-btn-secondary w-100 text-center"
                                            style="display:inline-block; opacity:0.85; cursor:default;">
                                            Current Plan
                                        </span>
                                    @else
                                        <a href="{{ route('plans.subscribe.show', $plan->slug) }}"
                                            class="rs-btn w-100 text-center">
                                            {{ $activeSubscription ? 'Change Plan' : 'Subscribe Now' }}
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ route('plans.subscribe.show', $plan->slug) }}" class="rs-btn w-100 text-center">
                                        Subscribe Now
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p>No subscription plans available right now.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection