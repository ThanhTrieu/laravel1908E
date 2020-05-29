<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // before middleware
        $age = $request->age;
        if($age < 18){
            // quay ve trang khong dc xem
            return redirect(route('khong-duoc-xem'));
        }
        // tiep tuc thuc thi cac request tiep theo
        return $next($request);
    }
}
