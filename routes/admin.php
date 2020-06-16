<?php
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin'
],function (){
    Route::get('login', 'LoginController@index')->name('formLogin');
});
