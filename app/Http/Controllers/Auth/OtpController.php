<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;

class OtpController extends Controller
{
     protected $redirectTo = '/dashboard/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('signed')->only('verify');
        // $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


          public function showOtpForm()
                {
                     

                    return view('login.otp'); 
                }

                public function verifyOtp(Request $request)
                {
                    $admin = Auth::user(); 
                   
                    if ($admin->otp === $request->otp && Carbon::now()->lessThan($admin->otp_expiry)) {

                       Auth::user()->update(['otp_verified' => '1']);
                        return redirect($this->redirectTo); 
                    }
                
                    return back()->withErrors(['otp' => 'Invalid or expired OTP.']); 
                }

}
