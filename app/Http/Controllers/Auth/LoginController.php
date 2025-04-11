<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



  

    protected function authenticated(Request $request, $user)
    {
        
    

    if ($request->expectsJson()) {
        if ($user->user_type == 'super-admin') {
             $this->sendOtp($user); 
            return response()->json(['redirect' => route('admin.otp')]);
        }

        
        return response()->json(['redirect' => $this->redirectTo]);
    }

   
    if ($user->user_type == 'super-admin') {
        return redirect()->route('admin.otp');
    }

    return redirect($this->redirectTo);
    }

    // Send OTP to admin
    protected function sendOtp($admin)
    {
        // Generate a random OTP
        $otp = Str::random(6);
        $admin->otp = $otp;
        $admin->otp_expiry = Carbon::now()->addMinutes(10); 
        $admin->save();

        // Send OTP email
        Mail::to('jessetheofficial@icloud.com')->send(new OtpMail($otp));
        
    }


              


}

