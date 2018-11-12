<?php

namespace App\Http\Middleware\Admin;

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
            
            return redirect()->route('login');
        }
        if(session('root')==true){
            
        }else{

            $path = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'],'/') :'index';
            $whitelist = ['index','/','home'];
          
            if(!in_array($path,array_merge($whitelist,session('url_path')))){
                die('无权访问！');
            }
        }

        return $next($request);
    }
}
