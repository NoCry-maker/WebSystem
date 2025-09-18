<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Mail\SendForgotPasswordEmailOtp;
use App\Mail\SendRegisterOtpMail;
use App\Models\ForgotPasswordEmailOtp;
use App\Models\RegisterEmailOtp;
use App\Models\User;
use Carbon\Carbon;

class ForgotPasswordController extends Controller
{
    //
      public function showEmailForm()
    {
        return view('auth.password.email'); // View: enter email
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $otp = rand(100000, 999999);
        ForgotPasswordEmailOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expired_at' => Carbon::now()->addMinutes(20),
            ]
        );

        Session::put('reset_email', $request->email);
         // Reactivate OTP
Session::put('otp_active', true);
Session::put('otp_expires_at', now()->addSeconds(60));

        Mail::to($request->email)->send(new forgotpassword_mail($otp));

        return redirect()->route('otp.verify.form')->with('status', 'Your verification code is sent to your email.');
    }

    public function showOtpForm()
    {
        return view('auth.password.otp_verification'); // View: enter OTP
    }

    public function verifyOtp(Request $request)
{
    $request->validate([
        'otp_digit' => 'required|array|size:6',
        'otp_digit.*' => 'required|digits:1'
    ]);

    // Combine the digits into one string
    $otp = implode('', $request->input('otp_digit'));

    $email = Session::get('reset_email');
     $otpActive = Session::get('otp_active', false); // check if OTP is activated
     $otpExpiresAt = Session::get('otp_expires_at');

    $otpRecord = ForgotPasswordEmailOtp::where('email', $email)
        ->where('otp', $otp)
        ->first();

        if (!$otpRecord) {
    return back()->withErrors(['otp' => 'Invalid OTP. Please check and try again.']);
}
    if (!$otpActive || now()->gt(Carbon::parse($otpExpiresAt))) {
    Session::put('otp_active', false);
    return back()->withErrors(['otp' => 'OTP is invalid or has expired. Please click Resend to use it again.']);
}

if (Carbon::now()->gt(Carbon::parse($otpRecord->expired_at))) {
    return back()->withErrors(['otp' => 'OTP code has expired. Please click Resend.']);
}
Session::forget('otp_active');
Session::forget('otp_expires_at');
    Session::put('otp_verified', true);

    return redirect()->route('otp.reset.form')->with('status', 'OTP verified. You may now reset your password.');
}

    public function showResetForm()
    {
        if (!Session::get('otp_verified')) {
            return redirect()->route('otp.password.request')->withErrors(['otp' => 'Please verify your OTP first.']);
        }

        return view('auth.password.set_password'); // View: enter new password
    }

    public function resetPassword(Request $request)
    {
        if (!Session::get('otp_verified')) {
            return redirect()->route('otp.password.request')->withErrors(['otp' => 'OTP verification required.']);
        }

        $request->validate([
            'password' => 'required|min:8'
        ]);

        $user = User::where('email', Session::get('reset_email'))->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Clear session and OTP record
        ForgotPasswordEmailOtp::where('email', $user->email)->delete();
        Session::forget(['otp_verified', 'reset_email']);

        return redirect()->route('login')->with('status', 'Password has been reset successfully.');
    }

public function resendOtp(Request $request)
{
    $email = Session::get('reset_email');

    if (!$email) {
        return redirect()->back()->with('status', 'Unable to resend OTP. Please start over.');
    }

    $record = ForgotPasswordEmailOtp::where('email', $email)->first();

    if (!$record) {
        return redirect()->back()->with('status', 'No OTP found for this email.');
    }

    if (Carbon::now()->gt($record->expired_at)) {
        return redirect()->back()->with('status', 'Code has expired. Please request a new one.');
    }

    // Activate the OTP in session
    Session::put('otp_active', true);
    Session::put('otp_expires_at', now()->addSeconds(60));

    Mail::to($email)->send(new forgotpassword_mail($record->otp));

    return redirect()->back()->with('status', 'Code resent and is now active.');
}
}
