<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
class CheckEducationLevel
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Only apply for 'student' type users
        if ($user->user_type === 'student') {
            if (empty($user->education_level) && !$request->routeIs('basic-info-profile')) {
               Alert::toast('Please select Education Level','error');
                return redirect()->route('basic-info-profile');
            }
        }

        return $next($request);
    }
}
?>