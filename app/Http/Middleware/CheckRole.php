<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        $user = $request->user();
    
        if ($user == null) {
            abort(403, __('messages.guest_not_permitted_for_action'));
        }

        if($user->banned){
            abort(403, __('messages.user_banned'));
        }

        if (strpos($roles, $user->role) === false) {
            if($user->role == 'moderator'){
                abort(403, __('messages.moderator_not_permitted_for_action'));
            }
            if($user->role == 'user'){
                abort(403, __('messages.user_not_permitted_for_action'));
            }

            return abort(401, __('messages.unauthenticated'));
        }
        
        return $next($request);
    }
}
