<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    // Pour verifier l'authentifiaction d'un membre user ou admin
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && !$request->user()->isAdmin()) {
            return response()->json(['error'=>'U are user'],201);
        }

        return $next($request);
    }
    // /**
    //  * Handle an incoming request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
    //  * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    //  */
    // public function handle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }
}
