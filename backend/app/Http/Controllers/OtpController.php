<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OtpController extends Controller
{
    //
    public function otp()
    {
        return view('unauth.otp');
    }


    // Verify OTP
    public function verifyOtp(Request $request)
    {
        // Validate OTP input
        $request->validate([
            'otp' => 'required|numeric|digits:6', // Ensure it's a 6-digit number
        ]);

        $email = session('email'); // Assuming the email is stored in the session during registration

        // Find OTP entry in the database by email
        $otpRecord = DB::table('otp_verifications')
            ->where('email', $email)
            ->where('otp', $request->otp)
            ->where('expires_at', '>', now()) // Check if OTP is still valid (not expired)
            ->first();

        if ($otpRecord) {
            // OTP is valid, proceed with actions like verifying email or logging the user in
            // Update the otp_verify field in the users table to 'yes'
            DB::table('users')
                ->where('email', $email)  // Find the user by email
                ->update(['otp_verify' => 'yes']);  // Set otp_verify to 'yes'

            return redirect()->route('login')->with('success', 'OTP verified successfully.');
        } else {
            // OTP is invalid or expired
            return back()->withErrors(['otp' => 'Invalid OTP or OTP has expired.']);
        }
    }

    // Resend OTP
    public function resendOtp(Request $request)
    {
        $email = session('email'); // Retrieve email from session

        $otp = rand(100000, 999999); // Generate a new 6-digit OTP

        // Update or insert the OTP record in the database
        DB::table('otp_verifications')->updateOrInsert(
            ['email' => $email],
            ['otp' => $otp, 'expires_at' => now()->addMinutes(10)]
        );

        // Send the OTP via email
        $user = DB::table('users')->where('email', $email)->first(); // Retrieve user by email

        Mail::send('emails.resend_otp', ['user' => $user, 'otp' => $otp], function ($message) use ($user) {
            $message->to($user->email)->subject('Account Created');
        });

        return back()->with('success', 'A new OTP has been sent to your email.');
    }
}
