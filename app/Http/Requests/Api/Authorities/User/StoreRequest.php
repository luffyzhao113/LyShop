<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/29 15:04
 */

namespace App\Http\Requests\Api\Authorities\User;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 15:27
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:20'],
            'email' => ['required', 'email', Rule::unique('users')],
            'phone' => ['required', 'regex:/^1[34578]\d{9}$/'],
            'birthday' => ['date_format:Y-m-d'],
            'sex' => ['required', 'in:women,man'],
            'entryday' => ['date_format:Y-m-d'],
            'role_id' => ['required', Rule::exists('roles', 'id')],
            'password' => ['required', 'min:6', 'max:20', 'confirmed'],
            'password_confirmation' => ['required',],
            'roles' => ['array', 'nullable'],
            'roles.*' => ['integer'],
            'status' => ['required', 'in:on,off']
        ];
    }

    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 15:27
     */
    public function attributes(): array
    {
        return [
            'name' => '用户姓名',
            'email' => '用户邮箱',
            'phone' => '手机号码',
            'birthday' => '出生日期',
            'sex' => '性别',
            'entryday' => '入职日期',
            'role_id' => '所属部门',
            'password' => '密码',
            'password_confirmation' => '确认密码',
            'roles' => '部门',
            'status' => '状态',
        ];
    }
}