<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/8
 * Time: 19:22
 */

namespace App\Http\Requests\Api\Authorities;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class MenuRequest extends FormRequest
{
    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 16:02
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:20'],
            'url' => ['required', 'min:2', 'max:50'],
            'sort' => ['required', 'integer'],
            'authorities' => ['nullable', 'array'],
            'authorities.*' => ['integer'],
        ];
    }

    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 16:01
     */
    public function attributes(): array
    {
        return [
            'parent_id' => '所属上级',
            'name' => '菜单名称',
            'url' => 'route name',
            'sort' => '排序',
            'authorities' => '权限'
        ];
    }

    /**
     * 配置验证器实例.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        if ($this->route()->getName() === 'menu.store') {
            $validator->addRules([
                'parent_id' => ['required', 'integer']
            ]);
        }
    }
}