<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/8
 * Time: 19:05
 */

namespace App\Http\Requests\Api\Goods;


use Illuminate\Foundation\Http\FormRequest;

class SpecRequest extends FormRequest
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
            'values' => ['required', 'array'],
            'type' => ['required', 'in:attr,spec'],
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
            'values' => '值',
            'type' => '类型',
            'description' => '描述'
        ];
    }
}