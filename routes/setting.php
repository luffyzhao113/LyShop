<?php

use Illuminate\Support\Facades\Route;

Route::get('express/template/view', 'TemplateController@view')->name('template.index');
Route::resource('express/template', 'TemplateController', [
    'names' => [
        'edit' => 'template.update',
        'create' => 'template.store',
    ]
])->except(['show']);

Route::resource('express/company', 'CompanyController', [
    'names' => [
        'edit' => 'company.update'
    ]
])->except(['show', 'create']);

Route::resource('focus/position', 'PositionController', [
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