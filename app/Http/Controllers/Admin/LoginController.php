<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginPost;
use voku\helper\AntiXSS;
use App\Model\Admin;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['message'] = $request->session()->get('session_login');
        // $data['message'] = $_SESSION['session_login'] ?? '';
        return view('admin/login/index', $data);
    }

    public function handleLogin(
        LoginPost $request,
        AntiXSS $antiXSS,
        Admin $admin
    ) {
        $username = $request->username;
        $username = $antiXSS->xss_clean($username);

        $password = $request->password;
        $password = $antiXSS->xss_clean($password);

        $infoAdmin = $admin->checkAdminLogin($username, $password);
        if($infoAdmin){
            // luu thong tin cua user vao session, de tien cho cac cong viec xu ly sau nay
            $request->session()->put('username', $infoAdmin['username']);
            // $_SESSION['username'] = $infoAdmin['username']
            $request->session()->put('id', $infoAdmin['id']);
            $request->session()->put('email', $infoAdmin['email']);
            $request->session()->put('role', $infoAdmin['role']);

            // cap nhat lai last_login trong db
            $admin->updateLastLogin($infoAdmin['id']);
            // cho vao trang dashboard
            return redirect(route('admin.dashboard'));
        } else {
            // tao ra session flash de thong bao loi
            // quay ve lai trang login
            $request->session()->flash('session_login', 'Username hoac mat khau khong dung');
            return redirect(route('admin.formLogin'));
        }

    }

    public function logout(Request $request)
    {
        // xoa het session
        // quay ve form login
        $request->session()->forget('username');
        $request->session()->forget('id');
        // unset($_SESSION['id']);
        $request->session()->forget('email');
        $request->session()->forget('role');
        return redirect(route('admin.formLogin'));
    }
}
