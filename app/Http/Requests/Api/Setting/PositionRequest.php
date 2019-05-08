<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/8
 * Time: 19:36
 */

namespace App\Http\Requests\Api\Setting;


use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            'description' => ['nullable', 'max:255'],
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
            'name' => '位置名称',
            'description' => '位置说明',
        ];
    }
}