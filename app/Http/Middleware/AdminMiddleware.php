<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        dd('middleware admin exécuté');
        
       if(!empty(Auth::check())){
            if (Auth::user()->role == 1){
                return $next($request);
            }else{
                Auth::logout();
                return redirect(url(''));
            }
           
        }else{
            Auth::logout();
            return redirect(url(''));
        }

    // if (Auth::user()->role != 1 && Auth::user()->role != '1') {
    //     return redirect(url(''));
    // }
    // return $next($request);
  
    
    }
    
}
