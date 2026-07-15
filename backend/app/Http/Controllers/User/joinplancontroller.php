<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\investmentplan;
use App\Models\Activity;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class joinplancontroller extends Controller
{
    //

    public function submitInvestment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric', // Add any other validation rules you need
        ]);
        $currentDate = Carbon::now();
        $user = Auth::user();
        $amount = $request->input('amount');
        $userbalance = $user->walletbalance;

        if ($amount > $userbalance) {
            return redirect()->back()->withErrors(['message' => 'Insufficient wallet balance.']);
        }

        $transactionId = Str::uuid()->toString();
        $selectedPlan = null;


        if ($request->has('Basic')) {
            $intrest = 3;
            $selectedPlan = 'Basic';
            $withdrawal_date_forplan = $currentDate->addDays(7);
        } elseif ($request->has('Silver')) {
            $selectedPlan = 'Silver';
            $intrest = 5;
            $withdrawal_date_forplan = $currentDate->addDays(10);
        } elseif ($request->has('Gold')) {
            $selectedPlan = 'Gold';
            $intrest = 10;
            $withdrawal_date_forplan = $currentDate->addDays(15);
        }



        if ($selectedPlan) {
            $profit = $amount * ($intrest / 100) * 3;
            $withdrawal_date = Carbon::parse($withdrawal_date_forplan); // Convert to Carbon instance
            $currentDate = Carbon::now();

            investmentplan::create([
                'user_id' => $user->id,
                'fullname' => $user->fullname,
                'email' => $user->email,
                'Withdrawaldate' => $withdrawal_date,
                'amount' => $amount,
                'profit' => $profit,
                'plan' => $selectedPlan,
                'transid' => $transactionId,
                'dateadd' => $currentDate,
                // Add other relevant fields
            ]);



            $user->walletbalance -= $amount;
            $user->save();

           

            return redirect()->back()->with('success', 'Investment Plan selected successfully.');
        } else {
            return redirect()->back()->withErrors(['message' => 'Invalid investment plan.']);
        }
    }
}
