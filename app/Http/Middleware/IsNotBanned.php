<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsNotBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user()->banned){
            abort(403, 'Banned user is not permitted for this action!');
        }
        return $next($request);
    }
}
