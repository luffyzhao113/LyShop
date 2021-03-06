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
            'type' => ['nullable', 'in:normal,group,seckill'],
            'status' => ['nullable', 'in:undercarriage,grounding'],
            'categories' => ['nullable', 'string']
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
            'type' => '商品类型',
            'status' => '商品状态',
            'categories' => '商品分类',
        ];
    }
}