<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class TypeCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check())
        {
            //check the admin
            if(Auth::user()->role==1)
            {
                    return $next($request);
            }
          
          //check the user
            if(Auth::user()->role==0)
            {
                return redirect('/users');
            }
              abort(403); // forbiden
        }
        abort(401);//access denie
        
    }
}