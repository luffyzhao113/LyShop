<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/23
 * Time: 16:25
 */

namespace App\Http\Searchs\Api\Setting;


use LTools\Searchs\SearchAbstract;

class CompanySearch extends SearchAbstract
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
            'view' => '='
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