<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/25
 * Time: 19:56
 */

namespace App\Http\Searchs\Api\Setting;


use LTools\Searchs\SearchAbstract;

class FocusPositionSearch extends SearchAbstract
{

    /**
     * 关系映射.
     *
     * @return array
     */
    protected function relationship(): array
    {
        return [
            'name' => 'like'
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