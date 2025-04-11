namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::user();

        if (!$user || !$user->status || !$user->role || !$user->role->permissions->contains('name', $permission)) {
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
