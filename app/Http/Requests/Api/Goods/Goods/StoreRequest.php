<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/7
 * Time: 18:49
 */

namespace App\Http\Requests\Api\Goods\Goods;


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
            'name' => ['required', 'min:2', 'max:100'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer'],
            'weight' => ['required', 'integer'],
            'type' => ['required', 'in:normal,group,seckill'],
            'status' => ['required', 'in:undercarriage,grounding'],
            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'string'],
            'file' => ['required', 'max:255'],
            'galleries' => ['required', 'array'],
            'galleries.*' => ['required', 'array', 'size:1'],
            'galleries.*.file' => ['required', 'max:255'],
            'attributes' => ['nullable', 'array'],
            'attributes.*.name' => ['nullable', 'string'],
            'attributes.*.values' => ['nullable', 'array'],
            'attributes.*.values.*' => ['nullable', 'string'],
            'detail.describe' => ['nullable', 'string', 'max:2000'],
            'detail.unit' => ['required', 'string', 'max:10'],
            'specs' => ['nullable', 'array'],
            'specs.*' => ['array', 'size:3'],
            'specs.*.items' => ['array'],
            'specs.*.items.*' => ['array', 'size:2'],
            'specs.*.items.*.name' => ['string'],
            'specs.*.items.*.value' => ['string'],
            'specs.*.price' => ['integer'],
            'specs.*.stock' => ['integer'],
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
            'name' => '商品名称',
            'price' => '商品价格',
            'stock' => '商品库存',
            'weight' => '商品重量',
            'type' => '商品单位',
            'status' => '商品类型',
            'categories' => '商品分类',
            'categories.*' => '商品分类',
            'file' => '商品主图',
            'galleries' => '商品组图',
            'galleries.*' => '商品组图',
            'galleries.*.file' => '商品组图',
            'attributes' => '商品属性',
            'attributes.*.name' => '商品属性',
            'attributes.*.values' => '商品属性',
            'attributes.*.values.*' => '商品属性',
            'detail.describe' => '商品描述',
            'detail.unit' => '商品单位',
            'specs' => '商品规格',
            'specs.*' => '商品规格',
            'specs.*.items' => '商品规格',
            'specs.*.items.*.name' => '商品规格',
            'specs.*.items.*.value' => '商品规格',
            'specs.*.price' => '商品规格',
            'specs.*.stock' => '商品规格',
        ];
    }
}