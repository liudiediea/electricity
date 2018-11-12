<?php

namespace App\Http\Middleware\home;

use Closure;

class Login
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        
        if(!session('id')){
            
            return redirect()->route('home_login');
        }
        return $next($request);
    }
}
