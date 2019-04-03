<?php

use Illuminate\Support\Facades\Route;

Route::get('authorities/menu/authority', 'Authorities\MenuController@authority');

Route::resource('authorities/role', 'Authorities\RoleController', [
    'names' => [
        'create' => 'role.store',
        'edit' => 'role.update',
    ]
])->except(['show']);

Route::put('authorities/user/{user}/status', 'Authorities\UserController@status')->name('user.update');
Route::resource('authorities/user', 'Authorities\UserController', [
    'names' => [
        'create' => 'user.store',
        'edit' => 'user.update',
    ]
])->except(['show', 'destroy']);


Route::resource('authorities/menu', 'Authorities\MenuController', [
    'names' => [
        'create' => 'menu.store',
        'edit' => 'menu.update',
    ]
])->except(['show']);

Route::resource('authorities/authority', 'Authorities\AuthorityController', [
    'names' => [
        'create' => 'authority.store',
        'edit' => 'authority.update',
    ]
])->except(['show']);

