<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 14:05
 */

namespace App\Http\Requests\Api\Setting\Express\Company;


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
            'name' => ['required', 'min:2', 'max:50'],
            'view' => ['required', 'in:yes,no'],
            'code' => ['requiredif:view,yes', 'max:50'],
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
            'name' => '快递公司名称',
            'view' => '查看物流轨迹',
            'code' => '物流接口编号',
            'description' => '快递公司简介',
        ];
    }
}