<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/8
 * Time: 18:55
 */

namespace App\Http\Requests\Api\Auth;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * rules
     * @author luffyzhao@vip.126.com
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6', 'max:20']
        ];
    }

    /**
     * attributes
     * @author luffyzhao@vip.126.com
     * @return array
     */
    public function attributes() : array
    {
        return [
            'email' => '登录邮箱',
            'password' => '密码'
        ];
    }

}