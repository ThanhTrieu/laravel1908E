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
    Route::post('brand/delete-brand', 'BrandController@deleteBrand')->name('delete.brand');
    Route::get('/brand/{slug}~{id}','BrandController@editBrand')->name('edit.brand');
    Route::post('/brand/update-brand','BrandController@handleUpdate')->name('update.brand');




    Route::get('category/category-tree-view','TestController@manageCategory')->name('category-tree-view');
    Route::post('category/add-category','TestController@addCategory')->name('add.category');
});
