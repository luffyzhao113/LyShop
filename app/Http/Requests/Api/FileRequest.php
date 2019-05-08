<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/25
 * Time: 15:36
 */

namespace App\Http\Requests\Api;


use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    /**
     * rules
     * @author luffyzhao@vip.126.com
     * @return array
     */
    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'image']
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
            'file' => '图片'
        ];
    }
}