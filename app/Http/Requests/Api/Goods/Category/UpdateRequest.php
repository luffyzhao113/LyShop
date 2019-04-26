<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/26
 * Time: 14:38
 */

namespace App\Http\Requests\Api\Goods\Category;


use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'search_filters' => '搜索属性',
            'search_filters.*.name' => '搜索属性',
            'search_filters.*.values' => '搜索属性',
            'search_filters.*.values.*' => '搜索属性',
        ];
    }
}