<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PasswordChangeFlag
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


//        if (Auth::user()->user_status_id == 3) {
//            Auth::logout();
//            $massage_logout = 'This user has been suspended';
//            $request->session()->flush(['massage_logout' => $massage_logout]);
//
//        }
        if (Auth::user()->pass_change_flag == 0) {

            return redirect()->route('permission.user.createChangePassword');
        }

        return $next($request);
    }
}
