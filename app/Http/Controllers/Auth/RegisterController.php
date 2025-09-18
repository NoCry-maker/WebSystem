<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Mail\SendRegisterOtpMail;
use App\Models\RegisterEmailOtp;
use App\Http\Controllers\Auth\OtpController;
use Illuminate\Http\Request;
use Carbon\Carbon;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         // 'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         // 'mobile' => ['required', 'digits:11', 'unique:users'],
    //         'password' => ['required', 'string', 'min:8',],
    //     ]);
    // }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'mobile' => ['required', 'regex:/^(09\d{9}|\+639\d{9})$/', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',],
        ],[
        'password.regex' => 'At least 8 characters long, contain at least one letter and one number.',
    ]);
    }

        public function register(Request $request)
    {
        // validate
        $this->validator($request->all())->validate();

        // fire registered event
        // event(new Registered((object) $request->all()));

        // generate OTP (instead of saving user)
        $otp = rand(100000, 999999);

        RegisterEmailOtp::updateOrCreate(
            ['email' => $request->email],
            [
                'otp' => $otp,
                'expired_at' => Carbon::now()->addMinutes(20),
            ]
        );

        // send OTP mail
        Mail::to($request->email)->send(new SendRegisterOtpMail($otp));

        // save temporary data in session
        session([
            'otp_email'    => $request->email,
            // 'otp_name'     => $request->name,
               'otp_name'     => 'user_' . Str::random(6),
            // 'otp_mobile'   => $request->mobile,
            'otp_password' => Hash::make($request->password),
        ]);

    // activate OTP for 60 seconds
    session([
        'otp_active'     => true,
        'otp_expires_at' => now()->addSeconds(60),
    ]);

        // redirect to OTP verify page
        return redirect()->route('otp.verify.page');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' =>'user_'. Str::random(6),
    //         'email' => $data['email'],
    //         // 'mobile' => $data['mobile'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }
        public function createUserAfterOtp()
    {
        $user = User::create([
            'name'     => session('otp_name'),
            'email'    => session('otp_email'),
            // 'mobile'   => session('otp_mobile'),
            'password' => session('otp_password'),
        ]);

        // clear temp session
        session()->forget(['otp_email','otp_name','otp_password']);

        return $user;
    }
}
