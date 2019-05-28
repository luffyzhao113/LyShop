<?php


namespace App\Http\Requests\Api\Goods;


use App\Rules\Number;
use Illuminate\Foundation\Http\FormRequest;

class ModifyRequest extends FormRequest
{
    /**
     * rules
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function rules(): array
    {
        return [
            'name' => ['nullable', 'max:100'],
            'type' => ['nullable', 'in:normal,group,seckill'],
            'status' => ['nullable', 'in:undercarriage,grounding'],
            'weight' => ['nullable', 'numeric', new Number(3)]
        ];
    }

    /**
     * attributes
     * @return array
     * @author luffyzhao@vip.126.com
     */
    public function attributes(): array
    {
        return [
            'name' => '商品名称',
            'weight' => '商品重量',
            'type' => '商品单位',
            'status' => '商品类型',
        ];
    }
}