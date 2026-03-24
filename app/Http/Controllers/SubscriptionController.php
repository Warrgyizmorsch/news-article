<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = SubscriptionPlan::where('status', 1)
            ->orderBy('sort_order')
            ->get();

        $activeSubscription = null;
        $user = auth()->user();

        if ($user && $user->role !== 'admin') {
            $activeSubscription = $user->subscriptions()
                ->with('plan')
                ->where('status', 'active')
                ->whereDate('end_date', '>=', now())
                ->latest()
                ->first();
        }

        return view('subscription.index', compact('plans', 'activeSubscription', 'user'));
    }

    public function showSubscribe($slug)
    {
        $plan = SubscriptionPlan::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $user = auth()->user();

        if ($user->role === 'admin') {
            return redirect()->route('frontend.plans.index')
                ->with('error', 'Admin accounts already have full access.');
        }

        if ($user->hasActiveSubscription()) {
            return redirect()->route('frontend.plans.index')
                ->with('error', 'You already have an active subscription.');
        }

        return view('subscription.confirm', compact('plan'));
    }

    public function subscribe($slug)
    {
        $plan = SubscriptionPlan::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $user = auth()->user();

        if ($user->subscriptions()->where('status', 'pending')->exists()) {
            return redirect()->route('frontend.plans.index')
                ->with('error', 'You already have a pending subscription request.');
        }

        if ($user->role === 'admin') {
            return redirect()->route('frontend.plans.index')
                ->with('error', 'Admin accounts already have full access.');
        }

        if ($user->hasActiveSubscription()) {
            return redirect()->route('frontend.plans.index')
                ->with('error', 'You already have an active subscription.');
        }

        UserSubscription::create([
            'user_id' => $user->id,
            'subscription_plan_id' => $plan->id,
            'start_date' => now()->toDateString(),
            'end_date' => now()->addDays($plan->duration_days)->toDateString(),
            'status' => 'pending',
            'payment_status' => 'pending',
            'payment_reference' => null,
        ]);

        return redirect()->route('profile.edit')
            ->with('success', 'Your subscription request has been submitted. It will be activated after admin approval.');
    }
}