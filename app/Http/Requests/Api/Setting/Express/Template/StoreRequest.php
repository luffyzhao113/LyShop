<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 9:48
 */

namespace App\Http\Requests\Api\Setting\Express\Template;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:2', 'max:50'],
            'type' => ['required', 'in:piece,weigh'],
            'status' => ['required', 'in:on,off'],
            'company_id' => ['required', Rule::exists('express_companies', 'id')],
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
        ];
    }
}