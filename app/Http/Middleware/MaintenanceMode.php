<?php 


namespace App\Http\Middleware;

use Closure;

class MaintenanceMode
{
    public function handle($request, Closure $next)
    {
        if (file_exists(storage_path('framework/down'))) {
            return response()->view('maintenance',[],503);
        }

        return $next($request);
    }
}

 ?>