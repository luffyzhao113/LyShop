<?php

use Illuminate\Support\Facades\Route;

Route::resource('category', 'CategoryController', [
    'names' => [
        'create' => 'category.store',
        'edit' => 'category.update',
    ]
])->except(['show']);

Route::resource('spec', 'SpecController', [
    'names' => [
        'edit' => 'spec.update',
    ]
])->except(['show', 'create']);


Route::resource('goods', 'GoodsController', [
    'names' => [
        'edit' => 'goods.update',
        'create' => 'goods.store',
    ]
])->except(['show']);