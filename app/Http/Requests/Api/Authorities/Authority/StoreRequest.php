<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/28 13:23
 */

namespace App\Http\Requests\Api\Authorities\Authority;


use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 13:26
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:20'],
            'uri' => ['required', 'min:2', 'max:50'],
            'description' => ['nullable', 'max:255'],
            'menus' => ['nullable', 'array'],
            'menus.*' => ['integer'],
        ];
    }

    /**\
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 13:26
     */
    public function attributes(): array
    {
        return [
            'name' => '权限名称',
            'uri' => '权限URI',
            'description' => '请求描述',
            'menus' => '所属菜单'
        ];
    }
}