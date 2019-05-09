<?php

use Illuminate\Support\Facades\Route;

// 不登录也可以进入
Route::group(['middleware' => 'guest'], function () {
    Route::post('login', 'AuthController@login');
    Route::put('refresh', 'AuthController@refresh');
});


// 登录才可以进入
Route::group(['middleware' => 'auth'], function () {
    Route::delete('logout', 'AuthController@logout');
    Route::get('profile', 'AuthController@profile');
    Route::put('profile', 'AuthController@profileUpdate');
});

// 要验证权限
Route::group(['middleware' => 'rbac', 'prefix' => 'authorities'], function () {
    Route::get('menu/authority', 'Authorities\MenuController@authority')->name('role.menu_authority');

    Route::resource('role', 'Authorities\RoleController', [
        'names' => [
            'create' => 'role.store',
            'edit' => 'role.update',
        ]
    ])->except(['show']);

    Route::put('user/{user}/status', 'Authorities\UserController@status')->name('user.update');
    Route::resource('user', 'Authorities\UserController', [
        'names' => [
            'create' => 'user.store',
            'edit' => 'user.update',
        ]
    ])->except(['show', 'destroy']);


    Route::resource('menu', 'Authorities\MenuController', [
        'names' => [
            'create' => 'menu.store',
            'edit' => 'menu.update',
        ]
    ])->except(['show']);

    Route::resource('authority', 'Authorities\AuthorityController', [
        'names' => [
            'create' => 'authority.store',
            'edit' => 'authority.update',
        ]
    ])->except(['show']);
});

