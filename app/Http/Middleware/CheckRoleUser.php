<?php

namespace App\Http\Middleware;

use Closure;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $params = null)
    {
        if($params !== 'admin'){
            return redirect(route('permit'));
        }
        return $next($request);
    }
}
