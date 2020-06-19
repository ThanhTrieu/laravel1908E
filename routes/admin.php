<?php
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'
],function (){
    Route::get('login', 'LoginController@index')->name('formLogin');
    Route::post('handle-login','LoginController@handleLogin')->name('handleLogin');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'
],function (){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
});
