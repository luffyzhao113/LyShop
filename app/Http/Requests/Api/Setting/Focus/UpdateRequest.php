<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/25
 * Time: 19:42
 */

namespace App\Http\Requests\Api\Setting\Focus;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'url' => ['required', 'min:2', 'max:255'],
            'file' => ['required', 'max:255'],
            'sort' => ['required', 'integer', 'min:0', 'max:99'],
            'status' => ['required', 'in:on,off'],
            'position_id' => ['required', Rule::exists('focus_positions', 'id')],
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
            'name' => '标题',
            'url' => '跳转链接',
            'file' => '图片',
            'sort' => '排序',
            'status' => '状态',
            'position_id' => '位置',
            'description' => '说明',
        ];
    }
}