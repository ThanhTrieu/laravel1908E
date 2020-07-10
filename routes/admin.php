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

    /* brand */
    Route::get('brand', 'BrandController@index')->name('brands');
    Route::get('brand/add-brand', 'BrandController@addBrand')->name('add.brand');
    Route::post('brand/handle-add', 'BrandController@handleAddBrand')->name('brand.handle.add');
    Route::post('brand/delete-brand', 'BrandController@deleteBrand')->name('delete.brand');
    Route::get('/brand/{slug}~{id}','BrandController@editBrand')->name('edit.brand');
    Route::post('/brand/update-brand','BrandController@handleUpdate')->name('update.brand');

    /* category */
    Route::get('/category','CategoryController@index')->name('category');
    Route::post('/add-category','CategoryController@addCategory')->name('add.category');
    Route::get('/category/{slug}~{id}','CategoryController@editCategory')->name('edit.category');
    Route::post('/update-category/{id}', 'CategoryController@handleUpdateCategory')->name('handle.update.category');

    /*Product*/
    Route::get('/shoes-product','ProductController@index')->name('shoes.product');
    Route::get('/add-shoes-product', 'ProductController@addShoes')->name('add.shoes');
    Route::post('add-shoes', 'ProductController@handleAddShoes')->name('handle.add.shoes');
});
