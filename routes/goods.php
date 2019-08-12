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
Route::get('goods/view', 'GoodsController@view')->name('goods.index');
Route::put('goods/{goods}/edit', 'GoodsController@modify')->name('goods.update');
Route::get('goods/recycle', 'GoodsController@recycle')->name('recycle.index');
Route::put('goods/{goods}/recycle', 'GoodsController@recovery')->name('recycle.recovery');
Route::get('goods/{goods}/express', 'GoodsController@express')->name('recycle.recovery');
Route::delete('goods/{goods}/recycle', 'GoodsController@recycleDestroy')->name('recycle.destroy');
Route::resource('goods', 'GoodsController', [
    'names' => [
        'edit' => 'goods.update',
        'create' => 'goods.store',
    ]
]);