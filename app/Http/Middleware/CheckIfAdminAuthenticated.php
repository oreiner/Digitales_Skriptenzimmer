<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $auth=Auth::guard('admins');
        if (!$auth->check()) {
            return redirect('/admin/login');
        }

//        echo '<pre>';
//        print_r(Auth::guard('admins')->user());
//        die;
       return $next($request);
    }
}