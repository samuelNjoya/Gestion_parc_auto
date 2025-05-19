<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ConducteurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd('middleware admin exécuté');
       if(!empty(Auth::check())){
            if (Auth::user()->role == 4 ){
                return $next($request);
            }else{
                Auth::logout();
                return redirect(url(''));
            }
           
        }else{
            Auth::logout();
            return redirect(url(''));
        }
    }
}
