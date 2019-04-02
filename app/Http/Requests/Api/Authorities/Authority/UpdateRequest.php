<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/28 15:18
 */

namespace App\Http\Requests\Api\Authorities\Authority;


use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:01
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:20'],
            'uri' => ['required', 'min:2', 'max:20'],
            'method' => ['required', 'in:GET,POST,,PUT,DELETE'],
            'description' => ['nullable', 'max:255'],
            'menus' => ['nullable', 'array'],
            'menus.*' => ['integer'],
        ];
    }

    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:01
     */
    public function attributes(): array
    {
        return [
            'name' => '权限名称',
            'uri' => '权限URI',
            'method' => '请求方式',
            'description' => '请求描述',
            'menus' => '所属菜单'
        ];
    }
}