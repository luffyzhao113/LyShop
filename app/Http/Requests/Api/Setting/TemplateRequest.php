<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/8
 * Time: 19:31
 */

namespace App\Http\Requests\Api\Setting;


use App\Rules\Number;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TemplateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:50'],
            'type' => ['required', 'in:piece,weigh'],
            'status' => ['required', 'in:on,off'],
            'company_id' => ['required',
                Rule::exists('express_companies', 'id')
            ],
            'details' => ['required', 'array', 'min:1'],
            'details.*.areas' => ['required', 'array', 'min:1'],
            'details.*.areas.*' => ['required', 'string'/*, Rule::exists('areas', 'area_code')*/],
            'details.*.continue' => ['required', 'numeric', new Number(3)],
            'details.*.continue_fee' => ['required', 'numeric', new Number(2)],
            'details.*.first' => ['required', 'numeric', new Number(3)],
            'details.*.first_fee' => ['required', 'numeric', new Number(2)],
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
            'name' => '模板名称',
            'type' => '模板类型',
            'status' => '模板状态',
            'company_id' => '快递公司名称',
            'details' => '模板配置',
            'details.*.areas' => '可配送城市',
            'details.*.areas.*' => '可配送城市',
            'details.*.continue' => '续重(件)',
            'details.*.continue_fee' => '续重(件)费用',
            'details.*.first' => '首重(件)',
            'details.*.first_fee' => '首重(件)费用',
        ];
    }
}