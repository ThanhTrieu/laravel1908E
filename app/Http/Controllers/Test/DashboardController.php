<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['lstUsers'] = [
            [
                'id' => 1,
                'username' => '<h1>admin</h1>',
                'email' => 'admin@gmail.com',
                'gender' => 1, // 1: nam - 0 : nu
                'money' => 121232
            ],
            [
                'id' => 2,
                'username' => '<h1>test</h1>',
                'email' => 'test@gmail.com',
                'gender' => 0, // 1: nam - 0 : nu
                'money' => 11111
            ],
            [
                'id' => 3,
                'username' => '<h1>demo</h1>',
                'email' => 'demo@gmail.com',
                'gender' => 1, // 1: nam - 0 : nu
                'money' => 1223
            ]
        ];
        $data['fullname'] = 'Thanh Trieu';
        $data['age'] = 20;
        // truyen nhieu du lieu ra ngoai view

        return view('test/dashboard/dashboard_view',$data);
    }
}
