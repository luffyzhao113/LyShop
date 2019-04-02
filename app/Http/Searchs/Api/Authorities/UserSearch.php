<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/29 18:09
 */

namespace App\Http\Searchs\Api\Authorities;


use LTools\Searchs\SearchAbstract;

class UserSearch extends SearchAbstract
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
            'email' => 'like',
            'phone' => 'like',
            'department_id' => '=',
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

    /**
     * @param $value
     * @return string
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 18:12
     */
    protected function getEmailAttribute($value){
        return '%' . $value . '%';
    }

    /**
     * @param $value
     * @return string
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 18:12
     */
    protected function getPhoneAttribute($value){
        return '%' . $value . '%';
    }
}