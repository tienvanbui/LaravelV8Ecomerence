<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,...$role)
    {   
        $RoleOfUser =  auth()->user()->role->role_name;
        if(!in_array($RoleOfUser,$role)){
           abort(403);
        }
        return $next($request);
    }
}
