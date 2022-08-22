<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Dcat\Admin\Support\Helper;
use Illuminate\Http\Request;

class Permission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        
        if (! $user->allPermissions()->first(function ($permission) use ($request) {
            return $permission->shouldPassThrough($request);
        })) {
            abort(403);
        }

        return $next($request);
    }

    

    
}
