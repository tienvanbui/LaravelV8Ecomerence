<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class CheckBlocked
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
        if (auth()->check() && auth()->user()->status ) 
        {
          $banned = Auth::user()->status == "1";
          Auth::logout();
          if($banned == 1){
                $message = 'Your account is banned.Please contact with supporter';
          }
            return redirect()->route('login')->with('status',$message)->withErrors(['email'=>'Your account is banned.Please contact with supporter']);
        }
        return $next($request);
    }
}
