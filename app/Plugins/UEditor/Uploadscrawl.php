<?php


namespace App\Plugins\UEditor;


use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Uploadscrawl extends Base implements Contracts\UEditor
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->config = [
            "path" => config('ueditor.scrawlPathFormat'),
            "size" => config('ueditor.scrawlMaxSize'),
            "allow" => config('ueditor.scrawlAllowFiles'),
            "oriName" => "scrawl.png",
            'name' => config('ueditor.scrawlFieldName')
        ];
    }

    /**
     * @return array
     * @throws FileExistsException
     */
    public function handle(): array
    {
        $img = base64_decode($this->request->get($this->config['name']));
        return $this->saveContent($img);
    }

}