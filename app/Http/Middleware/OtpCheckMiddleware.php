<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class OtpCheckMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->otp_verified == false) {
            return redirect()->route('admin.otp')->with('error', 'You must verify OTP first.');
        }

        return $next($request);
    }
}

?>