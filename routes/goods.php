<?php

use Illuminate\Support\Facades\Route;

Route::resource('category', 'CategoryController', [
    'names' => [
        'create' => 'category.store',
        'edit' => 'category.update',
    ]
])->except(['show']);