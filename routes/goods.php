<?php

use Illuminate\Support\Facades\Route;

Route::resource('category', 'CategoryController', [
    'names' => [
        'create' => 'category.store',
        'edit' => 'category.update',
    ]
])->except(['show']);

Route::resource('attribute', 'AttributeController', [
    'names' => [
        'edit' => 'category.update',
    ]
])->except(['show', 'create']);