<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        if ($user && $user->role === 'admin') {
            return redirect()->route('frontend.plans.index')
                ->with('error', 'Admin accounts already have full access.');
        }

        if ($user && $user->hasActiveSubscription()) {
            return redirect()->route('frontend.plans.index')
                ->with('error', 'You already have an active subscription.');
        }

        if ($user && $user->subscriptions()->where('status', 'pending')->exists()) {
            return redirect()->route('frontend.plans.index')
                ->with('error', 'You already have a pending subscription request.');
        }

        return view('subscription.confirm', compact('plan', 'user'));
    }

    public function subscribe(Request $request, $slug)
    {
        $plan = SubscriptionPlan::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $authUser = auth()->user();

        if ($authUser) {
            if ($authUser->role === 'admin') {
                return redirect()->route('frontend.plans.index')
                    ->with('error', 'Admin accounts already have full access.');
            }

            if ($authUser->hasActiveSubscription()) {
                return redirect()->route('frontend.plans.index')
                    ->with('error', 'You already have an active subscription.');
            }

            if ($authUser->subscriptions()->where('status', 'pending')->exists()) {
                return redirect()->route('frontend.plans.index')
                    ->with('error', 'You already have a pending subscription request.');
            }

            $user = $authUser;
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'email', 'max:255'],
                'phone' => ['required', 'string', 'max:20'],
            ]);

            $user = User::where('email', $request->email)->first();

            if ($user) {
                if ($user->role === 'admin') {
                    return redirect()->route('frontend.plans.index')
                        ->with('error', 'This email belongs to an admin account and cannot be used for subscription.');
                }

                if ($user->hasActiveSubscription()) {
                    return redirect()->route('frontend.plans.index')
                        ->with('error', 'This email already has an active subscription.');
                }

                if ($user->subscriptions()->where('status', 'pending')->exists()) {
                    return redirect()->route('frontend.plans.index')
                        ->with('error', 'A pending subscription request already exists for this email.');
                }

                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->save();
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make(Str::random(16)),
                    'role' => 'user',
                ]);
            }
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

        return redirect()->route('frontend.plans.index')
            ->with('success', 'Your subscription request has been submitted. It will be activated after admin approval.');
    }
}