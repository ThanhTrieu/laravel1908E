<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use voku\helper\AntiXSS;

class TestController extends Controller
{
    public function __construct()
    {
        // goi middleware o day
        // tac dong vao moi phuong thuc trong controller
        // vi __construct la thang chay dau tien
        // $this->middleware('check.role.user:normal')->only(['demo', 'test']);
    }

    public function index()
    {
        return "This is " . __FUNCTION__ . ' of class ' . __CLASS__;
    }

    public function demo()
    {
        return "This is " . __FUNCTION__ . ' - of class - ' . __CLASS__;
    }

    public function test()
    {
        return "This is " . __FUNCTION__ . ' - of class - ' . __CLASS__;
    }

    public function abc(Request $request)
    {
        $name = $request->name;
        $id = $request->id;
        // tham so truyen len url theo kieu query string
        $age = $request->query('age'); //$request->age;
        $add = $request->query('add'); //$request->add;
        $queryString = $request->getQueryString();

        return "Name : {$name} - Id : {$id} - Age : {$age} - Add : {$add} - Query : {$queryString}";
    }

    public function showFormLogin()
    {
        // Responses ve 1 view
        // nap vao 1 view - load vao 1 view
        return view('login/login_view');
    }

    public function handleLogin(Request $request, AntiXSS $xss)
    {
        // dd($request->all());
        // hien thi thong tin va dung chuong trinh
        // gan giong nhu su ket hop cua var_dump + die php thuan
        $user = $request->user;
        //$user = strip_tags($user);
        $user = $xss->xss_clean($user);

        $pass = $request->pass;
        $pass = $xss->xss_clean($pass);

        if($pass === '123' && $user === 'admin'){
            // login thanh cong
            return redirect(route('test.admin.home'));
        } else {
            // quay lai form giao dien
            return redirect(route('test.login',['state' => 'fail']));
        }
    }
}