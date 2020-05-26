<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    //return "welcome laravel";
});

Route::get('/hello-word', function () {
   return "Hello word";
});

Route::post('/api/demo-post', function () {
   return "This is method post";
});

Route::post('/tao-user', function () {
    return "This is method post - tao user";
});

Route::match(['get', 'post'], '/get-or-post', function () {
    return "get-or-post";
});

Route::any('/access-any', function () {
    return "access-any";
});
