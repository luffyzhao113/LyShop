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

Route::post('goods/file', 'GoodsController@file')->name('goods.store');
Route::post('goods/file-edit', 'GoodsController@file')->name('goods.update');
Route::resource('goods', 'GoodsController', [
    'names' => [
        'edit' => 'goods.update',
        'create' => 'goods.store',
    ]
])->except(['show']);