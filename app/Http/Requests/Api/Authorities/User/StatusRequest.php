<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/29 18:35
 */

namespace App\Http\Requests\Api\Authorities\User;


use Illuminate\Foundation\Http\FormRequest;

class StatusRequest extends FormRequest
{
    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 15:27
     */
    public function rules(): array
    {
        return [
            'status' => ['required', 'in:on,off']
        ];
    }

    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 15:27
     */
    public function attributes(): array
    {
        return [
            'status' => '状态',
        ];
    }
}