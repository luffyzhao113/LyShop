<?php

namespace App\Http\Requests\Api\Authorities\Menu;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 16:02
     */
    public function rules(): array
    {
        return [
            'parent_id' => ['required', 'integer'],
            'name' => ['required', 'min:2', 'max:20'],
            'url' => ['required', 'min:2', 'max:20'],
            'sort' => ['required', 'integer'],
            'authorities' => ['nullable', 'array'],
            'authorities.*' => ['integer'],
        ];
    }

    /**
     * @return array
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 16:01
     */
    public function attributes(): array
    {
        return [
            'parent_id' => '所属上级',
            'name' => '菜单名称',
            'url' => 'route name',
            'sort' => '排序',
            'authorities' => '权限'
        ];
    }
}
