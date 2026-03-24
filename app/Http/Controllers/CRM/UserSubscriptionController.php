<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Http\Request;

class UserSubscriptionController extends Controller
{
    public function index()
    {
        $query = UserSubscription::with(['user', 'plan']);

        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('user')) {
            $query->whereHas('user', function ($q) {
                $q->where('name', 'like', '%' . request('user') . '%')
                    ->orWhere('email', 'like', '%' . request('user') . '%');
            });
        }

        $subscriptions = $query->latest()->paginate(10);

        return view('crm.user-subscriptions.index', compact('subscriptions'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $plans = SubscriptionPlan::where('status', 1)->orderBy('sort_order')->get();

        return view('crm.user-subscriptions.create', compact('users', 'plans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,cancelled,pending',
            'payment_status' => 'nullable|string|max:255',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        if ($data['status'] === 'active') {
            UserSubscription::where('user_id', $data['user_id'])
                ->where('status', 'active')
                ->update(['status' => 'expired']);
        }

        UserSubscription::create($data);

        return redirect()->route('user-subscriptions.index')
            ->with('success', 'User subscription created successfully.');
    }

    public function edit($id)
    {
        $subscription = UserSubscription::findOrFail($id);
        $users = User::orderBy('name')->get();
        $plans = SubscriptionPlan::where('status', 1)->orderBy('sort_order')->get();

        return view('crm.user-subscriptions.edit', compact('subscription', 'users', 'plans'));
    }

    public function update(Request $request, $id)
    {
        $subscription = UserSubscription::findOrFail($id);

        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:active,expired,cancelled,pending',
            'payment_status' => 'nullable|string|max:255',
            'payment_reference' => 'nullable|string|max:255',
        ]);

        if ($data['status'] === 'active') {
            UserSubscription::where('user_id', $data['user_id'])
                ->where('status', 'active')
                ->where('id', '!=', $subscription->id)
                ->update(['status' => 'expired']);
        }

        $subscription->update($data);

        return redirect()->route('user-subscriptions.index')
            ->with('success', 'User subscription updated successfully.');
    }

    public function destroy($id)
    {
        $subscription = UserSubscription::findOrFail($id);
        $subscription->delete();

        return redirect()->route('user-subscriptions.index')
            ->with('success', 'User subscription deleted successfully.');
    }

    public function approve($id)
    {
        $subscription = UserSubscription::findOrFail($id);

        // Expire old active subscriptions of this user
        UserSubscription::where('user_id', $subscription->user_id)
            ->where('status', 'active')
            ->update(['status' => 'expired']);

        $subscription->update([
            'status' => 'active',
            'payment_status' => 'approved',
        ]);

        return redirect()->back()->with('success', 'Subscription approved successfully.');
    }

    public function reject($id)
    {
        $subscription = UserSubscription::findOrFail($id);

        $subscription->update([
            'status' => 'cancelled',
            'payment_status' => 'rejected',
        ]);

        return redirect()->back()->with('success', 'Subscription rejected.');
    }
}