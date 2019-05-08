<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/8
 * Time: 19:07
 */

namespace App\Http\Requests\Api\Goods;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CategoryRequest extends FormRequest
{
    /**
     * rules
     * @author luffyzhao@vip.126.com
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:50'],
            'sort' => ['required', 'integer'],
            'description' => ['nullable'],
            'status' => ['required', 'in:on,off'],
            'search_filters' => ['nullable', 'array'],
            'search_filters.*.name' => ['required', 'max:10'],
            'search_filters.*.values' => ['required', 'array'],
            'search_filters.*.values.*' => ['required', 'max:10'],
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
            'name' => '类目',
            'sort' => '排序',
            'description' => '说明',
            'status' => '状态',
            'parent_id' => '上级类目',
            'search_filters' => '搜索属性',
            'search_filters.*.name' => '搜索属性',
            'search_filters.*.values' => '搜索属性',
            'search_filters.*.values.*' => '搜索属性',
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
        if ($this->route()->getName() === 'category.store') {
            $validator->addRules([
                'parent_id' => ['required', 'max:252']
            ]);
        }
    }
}