<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/28 15:59
 */

namespace App\Http\Requests\Api\Authorities\Role;


use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:00
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:20'],
            'description' => ['required', 'max:254', 'nullable'],
            'authorities' => ['array', 'nullable'],
            'authorities.*' => ['integer'],
            'menus' => ['array', 'nullable'],
            'menus.*' => ['integer'],
        ];
    }

    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:00
     */
    public function attributes(): array
    {
        return [
            'name' => '权限组',
            'description' => '权限组描述',
            'authorities' => '权限列表',
            'menus' => '菜单列表',
        ];
    }
}