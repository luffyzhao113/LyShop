<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/8
 * Time: 10:58
 */

namespace App\Http\Searchs\Api\Goods;


use LTools\Searchs\SearchAbstract;

class GoodsSearch extends SearchAbstract
{

    /**
     * 关系映射.
     *
     * @return array
     */
    protected function relationship(): array
    {
        return [];
    }
}