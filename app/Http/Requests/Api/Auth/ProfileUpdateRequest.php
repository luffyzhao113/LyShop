<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/17
 * Time: 15:54
 */

namespace App\Http\Requests\Api\Auth;


use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * rules
     * @author luffyzhao@vip.126.com
     * @return array
     */
    public function rules(): array
    {
        return [
            'phone' => ['required', 'regex:/^1[34578]\d{9}$/'],
            'birthday' => ['date_format:Y-m-d'],
            'sex' => ['required', 'in:women,man'],
            'password' => ['nullable', 'min:6', 'max:20', 'confirmed'],
            'password_confirmation' => ['nullable',]
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
            'phone' => '手机号码',
            'birthday' => '出生日期',
            'sex' => '性别',
            'password' => '密码',
            'password_confirmation' => '确认密码',
        ];
    }

    /**
     * withValidator
     * @param Validator $validator
     * @author luffyzhao@vip.126.com
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            if (!$this->passwordOriginal()) {
                $validator->errors()->add('password_original', '原始密码不正确！');
            }
        });
    }

    /**
     * passwordOriginal
     * @author luffyzhao@vip.126.com
     * @return bool
     */
    protected function passwordOriginal()
    {
        return app('hash')->driver('bcrypt')->check($this->get('password_original'), $this->user('api')->getAuthPassword());
    }
}