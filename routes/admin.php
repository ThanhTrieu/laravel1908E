<?php
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'
],function (){
    Route::get('login', 'LoginController@index')
        ->middleware('check.admin.login')
        ->name('formLogin');
    Route::post('handle-login','LoginController@handleLogin')->name('handleLogin');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['web','check.admin.login']
],function (){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('brand', 'BrandController@index')->name('brands');
    Route::get('brand/add-brand', 'BrandController@addBrand')->name('add.brand');
    Route::post('brand/handle-add', 'BrandController@handleAddBrand')->name('brand.handle.add');
});
