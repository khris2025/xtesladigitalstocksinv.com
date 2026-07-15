<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Activity;
use Illuminate\Support\Str;

class MembershipController extends Controller
{
    public function subscribe(Request $request){

        $request->validate([
            'membership_name' => 'required|string',
            'amount' => 'required|numeric',
            'duration_days' => 'required|integer',
        ]);


        $user = auth()->user();

        // Check for an existing active membership
        $activeMembership = Membership::where('email', $user->email)
            ->where('status', 'active')
            ->where('expiry_date', '>', now())
            ->first();

        if ($activeMembership) {
            return back()->withErrors(['message' => 'You already have an active membership.']); 
        }


        

        if ($user->walletbalance < $request->amount) {
            return back()->withErrors(['message' => 'Insufficient Wallet Balance']); 
        }

        //membership ID
        $membershipID = 'MEM-'.Str::upper(Str::random(10));

        // Deduct wallet
        $user->walletbalance -= $request->amount;
        $user->membership = $request->membership_name;
        $user->membership_id = $membershipID;
        $user->save();

        // Create membership
        Membership::create([
            'email' => $user->email,
            'membership_name' => $request->membership_name,
            'amount' => $request->amount,
            'membership_id' => $membershipID,
            'purchase_date' => now(),
            'expiry_date' => now()->addDays($request->duration_days),
            'duration_days' => $request->duration_days,
            'status' => 'active',
        ]);

        // Activity Log
        Activity::create([
            'email' => $user->email,
            'activity_type' => 'membership',
            'status' => 'success',
            'amount' => $request->amount,
            'title' => 'Purchased Apex Access membership',
        ]);

        return back()->with('success', 'Membership activated successfully.');


    }
}
