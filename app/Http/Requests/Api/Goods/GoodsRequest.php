<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/8
 * Time: 16:40
 */

namespace App\Http\Requests\Api\Goods;


use App\Rules\FileUrl;
use App\Rules\Number;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class GoodsRequest extends FormRequest
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
            'price' => ['required', 'numeric', new Number(2)],
            'stock' => ['required', 'integer'],
            'weight' => ['required', 'numeric', new Number(3)],
            'type' => ['required', 'in:normal,group,seckill'],
            'status' => ['required', 'in:undercarriage,grounding'],
            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'string', Rule::exists('categories', 'id')],
            'file' => ['required', 'max:255', new FileUrl(['jpg', 'png', 'jpeg'])],
            'galleries' => ['required', 'array'],
            'galleries.*' => ['required', 'array', 'size:2'],
            'galleries.*.file' => ['required', 'max:255', new FileUrl(['jpg', 'png', 'jpeg'])],
            'galleries.*.sort' => ['required', 'integer'],
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
            'specs.*.price' => [new Number(2)],
            'specs.*.stock' => [new Number(2)],
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

    /**
     * 配置验证器实例.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        if (!$this->stock()) {
            $validator->errors()->add('stock', '商品总库存不正确');
        }
    }

    /**
     * stock
     * @author luffyzhao@vip.126.com
     * @return bool
     */
    protected function stock()
    {
        $specs = $this->get('specs', []);
        if (!empty($specs)) {
            return $this->get('stock', 0) === collect($specs)->sum('stock');
        }
        return true;
    }
}