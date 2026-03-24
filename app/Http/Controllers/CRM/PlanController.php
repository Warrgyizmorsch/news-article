<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;
use Illuminate\Support\Str;

class PlanController extends Controller
{
    public function index()
    {
        $query = SubscriptionPlan::query();

        if (request('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        if (request('status') !== null && request('status') !== '') {
            $query->where('status', request('status'));
        }

        $plans = $query->orderBy('sort_order')->latest()->paginate(10);

        return view('crm.plans.index', compact('plans'));
    }

    public function create()
    {
        return view('crm.plans.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:subscription_plans,slug',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        SubscriptionPlan::create($data);

        return redirect()->route('plans.index')
            ->with('success', 'Plan created successfully.');
    }

    public function edit($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);

        return view('crm.plans.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $plan = SubscriptionPlan::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:subscription_plans,slug,' . $plan->id,
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $plan->update($data);

        return redirect()->route('plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    public function destroy($id)
    {
        $plan = SubscriptionPlan::findOrFail($id);

        if (UserSubscription::where('subscription_plan_id', $plan->id)->exists()) {
            return redirect()->route('plans.index')
                ->with('error', 'This plan is already assigned to users and cannot be deleted.');
        }

        $plan->delete();

        return redirect()->route('plans.index')
            ->with('success', 'Plan deleted successfully.');
    }
}