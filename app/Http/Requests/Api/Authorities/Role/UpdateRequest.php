<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/28 17:13
 */

namespace App\Http\Requests\Api\Authorities\Role;


use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => '部门',
            'description' => '部门描述',
            'authorities' => '权限列表',
        ];
    }
}