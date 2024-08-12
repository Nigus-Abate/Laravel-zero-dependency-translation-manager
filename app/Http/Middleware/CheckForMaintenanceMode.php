<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
namespace App\Http\Middleware;
use Closure;


class CheckForMaintenanceMode
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [
       '/index*',
       '/admin*',
       '/login',
       '/logout'
   ];
   protected $exemptedRoutes = [
    'admin/login',
    'admin/logout',
    'admin/home',
    'admin/settings/general',
];

protected $exemptedDirectories = [
    'admin',
];

public function handle($request, Closure $next)
{
    if ($this->shouldBypassMaintenance($request)) {
        return $next($request);
    }

    if (setting('enable_maintenance_mode') == 'yes') {
        return response()->view('frontend.maintenance', [], 503);
    }

    return $next($request);
}

protected function shouldBypassMaintenance($request)
{
    $currentPath = $request->path();

    foreach ($this->exemptedRoutes as $route) {
        if (str_starts_with($currentPath, $route)) {
            return true;
        }
    }

    foreach ($this->exemptedDirectories as $directory) {
        if (str_starts_with($currentPath, $directory)) {
            return true;
        }
    }

    return false;
}

}



