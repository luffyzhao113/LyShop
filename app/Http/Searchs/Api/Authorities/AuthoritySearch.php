<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/28 13:52
 */

namespace App\Http\Searchs\Api\Authorities;


use LTools\Searchs\SearchAbstract;

class AuthoritySearch extends SearchAbstract
{

    /**
     * 关系映射.
     *
     * @return array
     */
    public function relationship(): array
    {
        return [
            'name' => 'like',
            'uri' => 'like',
        ];
    }

    /**
     * @param string $value
     * @return string
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:05
     */
    protected function getNameAttribute(string $value): string
    {
        return '%' . $value . '%';
    }

    /**
     * @param string $value
     * @return string
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:05
     */
    protected function getUriAttribute(string $value): string
    {
        return '%' . $value . '%';
    }
}