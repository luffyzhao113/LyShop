<?php


namespace App\Http\Requests\Api\Goods;


use App\Rules\Number;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    /**
     * rules
     * @author luffyzhao@vip.126.com
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:100'],
            'price' => ['nullable', 'numeric', new Number(2)],
            'stock' => ['nullable', 'integer'],
            'weight' => ['nullable', 'numeric', new Number(3)],
            'type' => ['nullable', 'in:normal,group,seckill'],
            'status' => ['nullable', 'in:undercarriage,grounding'],
            'categories' => ['nullable', 'string'],
            'attributes' => ['nullable', 'array'],
            'attributes.*.name' => ['required'],
            'attributes.*.value' => ['required'],
            'specs' => ['nullable', 'array'],
            'specs.*.name' => ['required'],
            'specs.*.value' => ['required'],
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
            'attributes' => '商品属性',
            'specs' => '商品规格',
        ];
    }
}