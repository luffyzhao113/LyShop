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