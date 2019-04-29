<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/24
 * Time: 9:42
 */

namespace App\Http\Searchs\Api\Setting;


use LTools\Searchs\SearchAbstract;

class TemplateSearch extends SearchAbstract
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
            'company_id' => '='
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