<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/28 15:49
 */

namespace App\Http\Searchs\Api\Authorities;


use LTools\Searchs\SearchAbstract;

class RoleSearch extends SearchAbstract
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
     * @param string $value
     * @return string
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:06
     */
    protected function getNameAttribute(string $value): string
    {
        return '%' . $value . '%';
    }
}