<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/6
 * Time: 16:18
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Goods extends RepositoryAbstract
{
    public function __construct(\App\Models\Goods $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes = [])
    {
        /**
         * @var $model \App\Models\Goods
         */
        $model = parent::create($attributes);

        $model->categories()->attach($attributes['categories']);

        $model->galleries()->createMany($attributes['galleries']);

        $model->detail()->create($attributes['detail']);

        if (array_key_exists('attributes', $attributes)) {
            $model->attributes()->createMany($attributes['attributes']);
        }

        if (array_key_exists('specs', $attributes)) {
            foreach ($attributes['specs'] as $spec) {
                /**
                 * @var $specModel \App\Models\GoodsSpec
                 */
                $specModel = $model->specs()->create($spec);
                foreach ($spec['items'] as $item){
                    $specModel->items()->create($item + ['goods_id' =>$model->getAttribute('id')]);
                }
            }
        }


        return $model;

    }
}