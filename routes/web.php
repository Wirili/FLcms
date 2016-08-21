<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['prefix' => 'admin','as'=>'admin.'], function () {
    Route::get('welcome', ['uses'=>'Admin\IndexController@welcome','as'=>'welcome']);
    Route::get('/', ['uses'=>'Admin\IndexController@index','as'=>'/']);
    Route::get('index', ['uses'=>'Admin\IndexController@index','as'=>'index']);
    Route::get('login', ['uses'=>'Admin\LoginController@showLogin','as'=>'login']);
    Route::post('login', ['uses'=>'Admin\LoginController@login','as'=>'postLogin']);
    Route::get('logout', ['uses'=>'Admin\LoginController@logout','as'=>'logout']);

    Route::get('good/index', ['uses'=>'Admin\GoodController@index','as'=>'good.index']);
    Route::get('good/edit/{id}', ['uses'=>'Admin\GoodController@edit','as'=>'good.edit']);
    Route::get('good/create', ['uses'=>'Admin\GoodController@create','as'=>'good.create']);
    Route::post('good/save', ['uses'=>'Admin\GoodController@save','as'=>'good.save']);
    Route::post('good/ajax', ['uses'=>'Admin\GoodController@ajax','as'=>'good.ajax']);

    Route::get('brand/index', ['uses'=>'Admin\BrandController@index','as'=>'brand.index']);
    Route::get('brand/edit/{id}', ['uses'=>'Admin\BrandController@edit','as'=>'brand.edit']);
    Route::get('brand/create', ['uses'=>'Admin\BrandController@create','as'=>'brand.create']);
    Route::get('brand/del/{id}', ['uses'=>'Admin\BrandController@del','as'=>'brand.del']);
    Route::post('brand/save', ['uses'=>'Admin\BrandController@save','as'=>'brand.save']);
    Route::post('brand/ajax', ['uses'=>'Admin\BrandController@ajax','as'=>'brand.ajax']);
    Route::post('brand/toggle_show', ['uses'=>'Admin\BrandController@toggle_show','as'=>'brand.toggle_show']);

    Route::get('category/index', ['uses'=>'Admin\CategoryController@index','as'=>'category.index']);
    Route::get('category/edit/{id}', ['uses'=>'Admin\CategoryController@edit','as'=>'category.edit']);
    Route::get('category/create', ['uses'=>'Admin\CategoryController@create','as'=>'category.create']);
    Route::get('category/del/{id}', ['uses'=>'Admin\CategoryController@del','as'=>'category.del']);
    Route::post('category/save', ['uses'=>'Admin\CategoryController@save','as'=>'category.save']);

    Route::get('suppliers/index', ['uses'=>'Admin\SupplierController@index','as'=>'suppliers.index']);
    Route::get('suppliers/edit/{id}', ['uses'=>'Admin\SupplierController@edit','as'=>'suppliers.edit']);
    Route::get('suppliers/create', ['uses'=>'Admin\SupplierController@create','as'=>'suppliers.create']);
    Route::get('suppliers/del/{id}', ['uses'=>'Admin\SupplierController@del','as'=>'suppliers.del']);
    Route::post('suppliers/save', ['uses'=>'Admin\SupplierController@save','as'=>'suppliers.save']);
    Route::post('suppliers/ajax', ['uses'=>'Admin\SupplierController@ajax','as'=>'suppliers.ajax']);

    //权限控制路由
    Route::get('role/index',['uses'=>'Admin\RoleController@index','as'=>'role.index']);
    Route::get('role/edit/{id}',['uses'=>'Admin\RoleController@edit','as'=>'role.edit']);
    Route::get('role/create',['uses'=>'Admin\RoleController@create','as'=>'role.create']);
    Route::post('role/save',['uses'=>'Admin\RoleController@save','as'=>'role.save']);
    Route::post('role/ajax', ['uses'=>'Admin\RoleController@ajax','as'=>'role.ajax']);
    Route::get('role/del/{id}', ['uses'=>'Admin\RoleController@del','as'=>'role.del']);

    //管理员路由
    Route::get('admin/index', ['uses'=>'Admin\AdminController@index','as'=>'admin.index']);
    Route::get('admin/edit/{id}',['uses'=>'Admin\AdminController@edit','as'=>'admin.edit']);
    Route::get('admin/create',['uses'=>'Admin\AdminController@create','as'=>'admin.create']);
    Route::post('admin/save',['uses'=>'Admin\AdminController@save','as'=>'admin.save']);
    Route::post('admin/ajax', ['uses'=>'Admin\AdminController@ajax','as'=>'admin.ajax']);

});

