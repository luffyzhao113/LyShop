<?php


namespace App\Plugins\UEditor;


use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Uploadfile extends Base implements Contracts\UEditor
{

    /**
     * Uploadfile constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->config = [
            "path" => config('ueditor.filePathFormat'),
            "size" => config('ueditor.fileMaxSize'),
            "allow" => config('ueditor.fileAllowFiles'),
            'name' => config('ueditor.fileFieldName'),
        ];
    }

    /**
     * @return array
     * @throws FileExistsException
     */
    public function handle(): array
    {
        $file = $this->request->file($this->config['name']);

        $this->check($file);

        $dirname = $this->getFullPath($this->config['path']);

        if ($this->checkDir($dirname)) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_CREATE_DIR")
            );
        }
        //移动文件
        if (!$newFile = $file->storeAs($dirname, $this->getFileName($file->getClientOriginalName()))) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_FILE_MOVE")
            );
        }
        return [
            'state' => 'SUCCESS',
            'url' => Storage::url($newFile)
        ];
    }

    /**
     * @param UploadedFile $file
     * @throws FileExistsException
     */
    public function check(UploadedFile $file)
    {
        if (empty($file) || $file->getError()) {
            throw new FileExistsException(
                empty($file) ? $this->getStateInfo("ERROR_FILE_NOT_FOUND") : $file->getError()
            );
        }

        if (!file_exists($file->getPathname())) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_TMP_FILE_NOT_FOUND")
            );
        }

        if (!is_uploaded_file($file->getPathname())) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_TMPFILE")
            );
        }

        //检查文件大小是否超出限制
        if (!$this->checkSize($file)) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_SIZE_EXCEED")
            );
        }
        //检查是否不允许的文件格式
        if (!$this->checkTypeAllow($file->getClientOriginalName())) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_TYPE_NOT_ALLOWED")
            );
        }
    }
}