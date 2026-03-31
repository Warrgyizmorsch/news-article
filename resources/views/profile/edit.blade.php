@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <section class="rs-breadcrumb-area rs-breadcrumb-one p-relative">
        <div class="rs-breadcrumb-bg"
            style="background-image: url('{{ asset('assets/images/breadcrumb/breadcrumb-bg.jpg') }}');"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="rs-breadcrumb-content-wrapper text-center">
                        <div class="rs-breadcrumb-title-wrapper">
                            <h1 class="rs-breadcrumb-title">My Profile</h1>
                        </div>
                        <div class="rs-breadcrumb-menu">
                            <nav>
                                <ul>
                                    <li><span><a href="{{ route('home') }}">Home</a></span></li>
                                    <li><span>Profile</span></li>
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
                <div class="col-xl-10 col-lg-12">

                    @if (session('success'))
                        <div class="alert alert-success mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Subscription Card --}}
                    <!-- <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                        <div class="card-body p-4 p-md-5">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                                <div>
                                    <h3 class="mb-1">{{ $user->role === 'admin' ? 'Admin Access' : 'My Subscription' }}</h3>
                                    <p class="text-muted mb-0">
                                        @if($user->role === 'admin')
                                            You have full article access as an administrator.
                                        @else
                                            View your current plan and manage access to premium articles.
                                        @endif
                                    </p>
                                </div>

                                @if($user->role !== 'admin')
                                    <div>
                                        <a href="{{ route('frontend.plans.index') }}" class="rs-btn text-center">
                                            View Plans
                                        </a>
                                    </div>
                                @endif
                            </div>

                            @if($user->role === 'admin')
                                <div class="alert alert-success mb-0">
                                    Your account has administrator privileges, so premium article access is already enabled.
                                </div>

                            @elseif($currentSubscription)
                                <div class="row g-3">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <small class="text-muted d-block mb-1">
                                                {{ $currentSubscription->status === 'pending' ? 'Requested Plan' : 'Current Plan' }}
                                            </small>
                                            <strong>{{ $currentSubscription->plan?->name }}</strong>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <small class="text-muted d-block mb-1">Start Date</small>
                                            <strong>{{ \Carbon\Carbon::parse($currentSubscription->start_date)->format('d M Y') }}</strong>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <small class="text-muted d-block mb-1">Expiry Date</small>
                                            <strong>{{ \Carbon\Carbon::parse($currentSubscription->end_date)->format('d M Y') }}</strong>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6">
                                        <div class="border rounded p-3 h-100">
                                            <small class="text-muted d-block mb-1">Status</small>
                                            @if($currentSubscription->status === 'pending')
                                                <span class="badge bg-warning text-dark">Pending Approval</span>
                                            @else
                                                <span class="badge bg-success">Active</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if($currentSubscription->status === 'pending')
                                    <div class="alert alert-warning mt-4 mb-0">
                                        Your subscription request has been submitted and is awaiting admin approval.
                                    </div>
                                @endif

                            @else
                                <div class="alert alert-warning mb-0">
                                    You do not have any active or pending subscription right now.
                                    <a href="{{ route('frontend.plans.index') }}" class="ms-2">
                                        View available plans
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div> -->


                    {{-- Profile Info --}}
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                        <div class="card-body p-4 p-md-5">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    {{-- Password Update --}}
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                        <div class="card-body p-4 p-md-5">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    {{-- Delete Account --}}
                    <div class="card border-0 shadow-sm" style="border-radius: 16px;">
                        <div class="card-body p-4 p-md-5">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection