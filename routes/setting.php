<?php

use Illuminate\Support\Facades\Route;

Route::resource('express/template', 'ExpressTemplateController');
Route::resource('express/company', 'ExpressCompanyController', [
    'names' => [
        'edit' => 'company.update'
    ]
])->except(['show', 'create']);;