<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/30
 * Time: 9:45
 */

namespace App\Http\Searchs\Api\Goods;


use LTools\Searchs\SearchAbstract;

class AttributeSearch extends SearchAbstract
{

    /**
     * 关系映射.
     *
     * @return array
     */
    protected function relationship(): array
    {
        return [
            'name' => 'like',
            'type' => '='
        ];
    }

    /**
     * @param $value
     * @return string
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 18:12
     */
    protected function getNameAttribute($value){
        return '%' . $value . '%';
    }
}