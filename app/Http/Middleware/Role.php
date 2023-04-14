<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        if(! Auth::user())
            return redirect()->back();
        // dd(Auth::user()->role);
        foreach($roles as $role) {
            if(Auth::user()->role === $role){
                // dump($role);
                return $next($request);
             }
        }
        return redirect()->back(); 
    }
}
