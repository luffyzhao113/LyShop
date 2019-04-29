<?php

use Illuminate\Support\Facades\Route;

Route::get('express/template/view', 'ExpressTemplateController@view')->name('template.index');
Route::resource('express/template', 'ExpressTemplateController', [
    'names' => [
        'edit' => 'template.update',
        'create' => 'template.store',
    ]
])->except(['show']);

Route::resource('express/company', 'ExpressCompanyController', [
    'names' => [
        'edit' => 'company.update'
    ]
])->except(['show', 'create']);

Route::resource('focus/position', 'FocusPositionController', [
    'names' => [
        'edit' => 'company.update'
    ]
])->except(['show', 'create']);

Route::post('focus/file', 'FocusController@file')->name('focus.store');
Route::post('focus/file-edit', 'FocusController@file')->name('focus.update');
Route::get('focus/view', 'FocusController@view');
Route::resource('focus', 'FocusController', [
    'names' => [
        'edit' => 'focus.update',
        'create' => 'focus.store',
    ]
])->except(['show']);