<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\User;
use App\Models\Activity;
use Carbon\Carbon;
use App\Models\investmentplan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    // Store a newly created plan in the database
    public function store(Request $request)
    {
        $request->validate([
            'plan_name' => 'required|string|max:255',
            'plan_amount_min' => 'required|numeric',
            'plan_amount_max' => 'required|numeric',
            'plan_duration' => 'required|integer',
            'plan_roi' => 'required|numeric',
        ]);

        Plan::create([
            'name' => $request->plan_name,
            'min_amount' => $request->plan_amount_min,
            'max_amount' => $request->plan_amount_max,
            'duration' => $request->plan_duration,
            'roi' => $request->plan_roi,
        ]);

        return redirect()->back()->with('admin.plans.index')->with('success', 'Plan created successfully!');
    }

    // Delete a plan
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->back()->with('success', 'Plan deleted successfully!');
    }

    public function subscribe(Request $request, $id)

    {
        $plan = Plan::findOrFail($id);
        $user = auth()->user();

        // Validate the request
        $request->validate([
            'amount' => "required|numeric|min:{$plan->min_amount}|max:{$plan->max_amount}",
        ]);

        $investmentAmount = $request->amount;
        $profit = $plan->roi * $investmentAmount;

        // Check if user has sufficient balance
        $minAmount = $plan->min_amount;

        if ($user->walletbalance < $minAmount) {
            return redirect()->back()->withErrors(['message' => 'Insufficient wallet balance!']);
        }

        // Deduct the investment amount from wallet balance
        $user->walletbalance -= $investmentAmount;
        $user->save();

        // Create a new subscription
        $startDate = Carbon::now();
        investmentplan::create([
            'fullname' => $user->fullname,
            'email' => $user->email,
            'amount' => $investmentAmount,
            'profit' => $profit,
            'plan' => $plan->name,
            'transid' => Str::uuid()->toString(),
            'Withdrawaldate' => Carbon::now()->addDays($plan->duration), // Set withdrawal date
            'dateadd' => $startDate,
        ]);

        Activity::create([
            'email' => $user->email,
            'activity_type' => 'plan',
            'status' => 'success',
            'amount' => $investmentAmount,
            'profit' => $profit,
            'title' => 'Subscription successful',
        ]);




        return redirect()->back()->with('success', 'You have successfully subscribed to the plan!');
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);
        return view('Adminview.editplans', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        // Find the plan by ID or fail (404 if not found)
        $plan = Plan::findOrFail($id);

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'min_amount' => 'required|numeric|min:0',  // Assuming minimum amount should be non-negative
            'max_amount' => 'required|numeric|min:0',  // Assuming maximum amount should be non-negative
            'duration' => 'required|integer|min:1',    // Assuming duration should be at least 1 day
            'roi' => 'required|numeric|min:0',         // Assuming ROI should be non-negative
        ]);

        // Update the plan with the validated data
        $plan->update([
            'name' => $request->input('name'),
            'min_amount' => $request->input('min_amount'),
            'max_amount' => $request->input('max_amount'),
            'duration' => $request->input('duration'),
            'roi' => $request->input('roi'),
        ]);

        // Redirect to the plans index page with a success message
        return redirect()->route('plan_settings')->with('success', 'Plan updated successfully!');
    }
}
