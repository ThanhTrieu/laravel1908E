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

// truyen tham so len router
Route::get('/product/{name}/{id}', function ($name, $id) {
    echo "san pham {$name} - ma san pham {$id}";
    // :name - :id tham so bat buoc truyen len url
});
// tham so khong bat buoc
Route::get('/watch-film/{name?}', function ($nameFilm = null) {
   echo "Ban dang xem phim : {$nameFilm}";
});

// quy dinh logic tham so
Route::get('/product-detail/{name}/{id}', function ($name, $id) {
   echo "ma san pham phai la so - {$id} / ten san pham: {$name}";
})->where(['id' => '\d+', 'name' => '[A-Za-z]+']);

// name router
Route::get('/profile-detail/{id}', function ($id){
    echo "thong tin nhan vien co ma : {$id}";
})->where('id', '\d+')->name('profile.detail');

// group router
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.' // tien to name cua router
], function (){
    Route::get('/product',function (){
        echo "product - admin";
    })->name('product');
    Route::get('/order', function () {
        echo "order - admin";
    })->name('order');
});

// router mac dinh khi truy cap router ko ton tai
Route::fallback(function (){
    // hien thi trang 404
    // abort();
    echo "khong tim thay yeu cau";
});

// view Router - truc tiep goi thang vao 1 view
Route::view('view-html', 'test-view');

// middleware - router
Route::get('xem-phim/{nameFilm}/{age}', function ($name, $age) {
    echo "Ban dang xem phim {$name} - vi ban tren {$age} tuoi";
    // su dung middleware
})
->middleware('check.age')
->name('phim');

Route::get('/khong-duoc-xem-phim', function (){
   echo "Ban chua dc xem phim do";
})->name('khong-duoc-xem');

Route::get('/check-number/{number}', function ($number) {
    /////
   return redirect(route('sochan',['num' => $number]));
})->middleware('check.number');

Route::get('/so-chan/{num}', function ($num){
    return "Ban vua kiem tra so chan {$num}";
})->name('sochan');

Route::get('/so-le/{num}', function ($num){
    return "Ban vua kiem tra so le {$num}";
})->name('sole');

// truyen tham so vao middleware
Route::get('view-profile', function () {
   // yeu cau quyen phai la admin
    return "ban dc phep xem all profile cua nhan vien";
    // :admin - tham so truyen vao middleware
})->middleware('check.role.user:admin');

Route::get('/not-access', function (){
   return "Ban ban khong co quyen xem";
})->name('permit');

/****** Router Controller *********/
Route::get('test-controller', 'TestController@index')->name('test.index');
Route::get('test-demo', 'TestController@demo')->name('test.demo');
Route::get('test-abc/{name}/{id}', 'TestController@abc')->name('test.abc');
Route::get('/login', 'TestController@showFormLogin')->name('test.login');
Route::post('/handle-login', 'TestController@handleLogin')->name('test.handle.login');

/****** Test Admin group **********/
Route::group([
    'prefix' => '/test/admin',
    'as' => 'test.',
    'namespace' => 'Test'
], function (){
    Route::get('/dashboard','DashboardController@index')->name('admin.home');
    Route::get('/contact', 'ContactController@index')->name('admin.contact');
});

/***** Test query builder *****/
Route::group([
    'prefix' => 'query/builder',
    'namespace' => 'query'
], function (){
    Route::get('test', 'QueryBuilderController@index')->name('test.query');
});
