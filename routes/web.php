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

Route::get('/',function(){
    return view('welcome');
});

Route::group(['prefix' => 'admin','as'=>'admin.'], function () {
    Route::get('welcome', ['uses'=>'Admin\IndexController@welcome','as'=>'welcome']);
    Route::get('/', ['uses'=>'Admin\IndexController@index','as'=>'/']);
    Route::get('index', ['uses'=>'Admin\IndexController@index','as'=>'index']);
    Route::get('login', ['uses'=>'Admin\LoginController@showLogin','as'=>'login']);
    Route::post('login', ['uses'=>'Admin\LoginController@login','as'=>'postLogin']);
    Route::get('logout', ['uses'=>'Admin\LoginController@logout','as'=>'logout']);

    Route::get('config/edit', ['uses'=>'Admin\ConfigController@edit','as'=>'config.edit']);
    Route::post('config/save', ['uses'=>'Admin\ConfigController@save','as'=>'config.save']);


    Route::get('good/index', ['uses'=>'Admin\GoodController@index','as'=>'good.index']);
    Route::get('good/edit/{id}', ['uses'=>'Admin\GoodController@edit','as'=>'good.edit']);
    Route::get('good/create', ['uses'=>'Admin\GoodController@create','as'=>'good.create']);
    Route::post('good/save', ['uses'=>'Admin\GoodController@save','as'=>'good.save']);
    Route::post('good/ajax', ['uses'=>'Admin\GoodController@ajax','as'=>'good.ajax']);

    //宠物管理路由
    Route::get('pet/index', ['uses'=>'Admin\PetController@index','as'=>'pet.index']);
    Route::get('pet/edit/{id}', ['uses'=>'Admin\PetController@edit','as'=>'pet.edit']);
    Route::get('pet/create', ['uses'=>'Admin\PetController@create','as'=>'pet.create']);
    Route::post('pet/save', ['uses'=>'Admin\PetController@save','as'=>'pet.save']);
    Route::post('pet/ajax', ['uses'=>'Admin\PetController@ajax','as'=>'pet.ajax']);

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

