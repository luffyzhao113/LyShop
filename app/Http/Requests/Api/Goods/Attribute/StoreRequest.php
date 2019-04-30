<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/30
 * Time: 10:25
 */

namespace App\Http\Requests\Api\Goods\Attribute;


use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * rules
     * @author luffyzhao@vip.126.com
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:20'],
            'type' => ['required', 'in:attr,spec'],
            'values' => ['required', 'array'],
            'values.*' => ['required', 'max:10'],
            'description' => ['nullable', 'max:255']
        ];
    }

    /**
     * attributes
     * @author luffyzhao@vip.126.com
     * @return array
     */
    public function attributes(): array
    {
        return [
            'name' => '名称',
            'type' => '类型',
            'values' => '值',
            'description' => '描述'
        ];
    }

}