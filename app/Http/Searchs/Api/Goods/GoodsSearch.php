<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/8
 * Time: 10:58
 */

namespace App\Http\Searchs\Api\Goods;


use App\Http\Requests\Api\Goods\IndexRequest;
use LTools\Searchs\SearchAbstract;
use MongoDB\BSON\Regex;

class GoodsSearch extends SearchAbstract
{

    /**
     * GoodsSearch constructor.
     * @param IndexRequest $attributes
     */
    public function __construct(IndexRequest $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * 关系映射.
     *
     * @return array
     */
    protected function relationship(): array
    {
        return [
            'name' => 'closure',
            'type' => '=',
            'status' => '=',
            'categories' => 'closure'
        ];
    }

    /**
     * @param $value
     * @return \Closure
     */
    public function getNameAttribute($value)
    {
        return function ($query) use ($value) {
            $query->where('name', 'regex', new Regex($value));
        };
    }

    /**
     * @param $value
     * @return \Closure
     */
    public function getCategoriesAttribute($value)
    {
        return function ($query) use ($value) {
            $query->where('categories.id', 'regex', new Regex('^' . $value));
        };
    }
}