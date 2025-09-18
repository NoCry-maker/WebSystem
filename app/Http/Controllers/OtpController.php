<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisterEmailOtp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRegisterOtpMail;
use Illuminate\Support\Facades\Hash;


class OtpController extends Controller
{
    public function showVerifyRegisterForm()
    {
        return view('auth.verify-otp');
    }

    public function verifyRegisterOtp(Request $request)
    {
       $otp_digit = implode('', $request->otp_digit ?? []);

     $request->merge(['otp' => $otp_digit]);
    $request->validate([
            'otp' => 'required|digits:6',
        ]);

        // Get temp session data
        $name     = session('otp_name');
        $email    = session('otp_email');
        // $mobile   = session('otp_mobile');
        $password = session('otp_password');

        if (!$email) {
            return redirect()->route('register')->with('error', 'Session expired. Please register again.');
        }


        // Check OTP in DB
        $otpRecord = RegisterEmailOtp::where('email', $email)
            ->where('otp', $request->otp)
            ->first();

            if (!$otpRecord) {
    return back()->withErrors(['otp' => 'OTP does not match.']);
}
        // Check if OTP is active in session
        $otpActive    = Session::get('otp_active', false);
        $otpExpiresAt = Session::get('otp_expires_at');

if (!$otpActive || now()->gt($otpExpiresAt)) {
    Session::put('otp_active', false);
    return back()->withErrors(['otp' => 'OTP is invalid. Please click Resend to use it again.']);
}

        // OTP is valid → deactivate it
        Session::forget('otp_active');
        Session::forget('otp_expires_at');

        // Create user after OTP
        $user = User::create([
            'name'     => $name,
            'email'    => $email,
            // 'mobile'   => $mobile,
            'password' => Hash::make($password),
        ]);

        // Delete OTP record
        $otpRecord->delete();

        // Clear session
        session()->forget(['otp_name','otp_email','otp_password']);

        //  Log user in
        Auth::login($user);

        return redirect('/')->with('success', 'OTP verified! Welcome.');
    }

      public function resendRegisterOtp(Request $request)
    {
        $email = Session::get('otp_email');

        if (!$email) {
            return redirect()->back()->with('status', 'Unable to resend OTP. Please start over.');
        }

        $otpRecord = RegisterEmailOtp::where('email', $email)->first();

        if (!$otpRecord) {
             return redirect()->back()->with('status', 'No OTP found for this email.');
        }

        // Reactivate OTP for 60s countdown
        Session::put('otp_active', true);
        Session::put('otp_expires_at', now()->addSeconds(60));

        // Resend same OTP via email
        Mail::to($email)->send(new SendRegisterOtpMail($otpRecord->otp));

        return redirect()->back()->with('status', 'Code resent and is now active.');
    }
}
