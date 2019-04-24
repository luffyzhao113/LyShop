<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 14:20
 */

namespace App\Http\Requests\Api\Setting\Express\Template;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:50'],
            'type' => ['required', 'in:piece,weigh'],
            'status' => ['required', 'in:on,off'],
            'company_id' => ['required',
                Rule::exists('express_companies', 'id'),
                // Rule::unique('express_details', 'company_id')->where('type', $this->input('type')) // 相同快递公司每个类型只能添加一条先不加上。
            ],
            'details' => ['required', 'array', 'min:1'],
            'details.*.areas' => ['required', 'array', 'min:1'],
            'details.*.areas.*' => ['required', 'integer'],
            'details.*.continue' => ['required', 'integer', 'between:0,99999999'],
            'details.*.continue_fee' => ['required', 'integer', 'between:0,99999999'],
            'details.*.first' => ['required', 'integer', 'between:0,99999999'],
            'details.*.first_fee' => ['required', 'integer', 'between:0,99999999'],
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