<?php

use Illuminate\Support\Facades\Route;


Route::resource('authorities/role', 'Authorities\RoleController');

Route::put('authorities/user/{user}/status', 'Authorities\UserController@status');
Route::resource('authorities/user', 'Authorities\UserController');

Route::get('authorities/menu/authority', 'Authorities\MenuController@authority');
Route::resource('authorities/menu', 'Authorities\MenuController');

Route::resource('authorities/authority', 'Authorities\AuthorityController');

