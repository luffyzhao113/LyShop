<?php


namespace App\Plugins\UEditor;


use Illuminate\Http\Request;

class Uploadimage extends Uploadfile implements Contracts\UEditor
{
    /**
     * Uploadimage constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->config = [
            "path" => config('ueditor.imagePathFormat'),
            "size" => config('ueditor.imageMaxSize'),
            "allow" => config('ueditor.imageAllowFiles'),
            'name' => config('ueditor.imageFieldName'),
        ];
    }
}