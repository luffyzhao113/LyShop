<?php


namespace App\Plugins\UEditor;


use Illuminate\Http\Request;

class Uploadvideo extends Uploadfile implements Contracts\UEditor
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->config = [
            "path" => config('ueditor.videoPathFormat'),
            "size" => config('ueditor.videoMaxSize'),
            "allow" => config('ueditor.videoAllowFiles'),
            'name' => config('ueditor.videoFieldName'),
        ];
    }
}