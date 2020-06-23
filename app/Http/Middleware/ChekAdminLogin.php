<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class ChekAdminLogin
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
        $route = Route::currentRouteName();
        if($route === 'admin.formLogin'){
            if($this->checkSessionAdmin()){
                // vao trang dashboard luon - vi dang nhap roi
                return redirect(route('admin.dashboard'));
            }
        } else {
            if(!$this->checkSessionAdmin()){
                // quay lai trang login
                return redirect(route('admin.formLogin'));
            }
        }
        return $next($request);
    }

    // kiem tra session admin co ton tai hay ko?
    private function checkSessionAdmin()
    {
        $idSession = Session::get('id');
        $username = Session::get('username');
        if(is_numeric($idSession) && !empty($username)){
            return true;
        }
        return false;
    }
}
