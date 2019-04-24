<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/24
 * Time: 19:45
 */

namespace App\Http\Requests\Api\Setting\Focus\Position;


use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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