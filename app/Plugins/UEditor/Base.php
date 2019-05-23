<?php


namespace App\Plugins\UEditor;


use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

abstract class Base
{
    protected $stateMap = [
        "SUCCESS", //上传成功标记，在UEditor中内不可改变，否则flash判断会出错
        "文件大小超出 upload_max_filesize 限制",
        "文件大小超出 MAX_FILE_SIZE 限制",
        "文件未被完整上传",
        "没有文件被上传",
        "上传文件为空",
        "ERROR_TMP_FILE" => "临时文件错误",
        "ERROR_TMP_FILE_NOT_FOUND" => "找不到临时文件",
        "ERROR_SIZE_EXCEED" => "文件大小超出网站限制",
        "ERROR_TYPE_NOT_ALLOWED" => "文件类型不允许",
        "ERROR_CREATE_DIR" => "目录创建失败",
        "ERROR_DIR_NOT_WRITEABLE" => "目录没有写权限",
        "ERROR_FILE_MOVE" => "文件保存时出错",
        "ERROR_FILE_NOT_FOUND" => "找不到上传文件",
        "ERROR_WRITE_CONTENT" => "写入文件内容错误",
        "ERROR_UNKNOWN" => "未知错误",
        "ERROR_DEAD_LINK" => "链接不可用",
        "ERROR_HTTP_LINK" => "链接不是http链接",
        "ERROR_HTTP_CONTENTTYPE" => "链接contentType不正确",
        "INVALID_URL" => "非法 URL",
        "INVALID_IP" => "非法 IP",
    ];
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $config = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * 保存文字
     * @param $img
     * @return array
     * @throws FileExistsException
     */
    protected function saveContent($img){
        $dirname = $this->getFullPath($this->config['path']);
        $filePath = $dirname . DIRECTORY_SEPARATOR . $this->getFileName($this->config['oriName']);

        //检查文件大小是否超出限制
        if (!$this->checkFileSize(strlen($img))) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_SIZE_EXCEED")
            );
        }

        if ($this->checkDir($dirname)) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_CREATE_DIR")
            );
        }

        //移动文件
        if (!Storage::disk()->put($filePath, $img)) { //移动失败
            throw new FileExistsException(
                $this->getStateInfo("ERROR_WRITE_CONTENT")
            );
        }

        return [
            'state' => 'SUCCESS',
            'url' => Storage::url($filePath)
        ];
    }
    /**
     * 上传错误检查
     * @param $errCode
     * @return string
     */
    protected function getStateInfo($errCode): string
    {
        return !$this->stateMap[$errCode] ? $this->stateMap["ERROR_UNKNOWN"] : $this->stateMap[$errCode];
    }

    /**
     * 文件大小检测
     * @param UploadedFile $file
     * @return bool
     */
    protected function checkSize(UploadedFile $file): bool
    {
        return $file->getSize() <= ($this->config["size"]);
    }

    /**
     * 文件类型检测
     * @param string $file
     * @return bool
     */
    protected function checkTypeAllow(string $file): bool
    {
        return in_array($this->getFileExt($file), $this->config["allow"]);
    }

    /**
     * 获取文件扩展名
     * @param string $file
     * @return string
     */
    protected function getFileExt(string $file): string
    {
        return strtolower(strrchr($file, '.'));
    }

    /**
     * @param string $oriName
     * @return string
     */
    protected function getFileName(string $oriName): string
    {
        return Str::uuid()->toString() . $this->getFileExt($oriName);
    }

    /**
     * @param string $dirname
     * @return bool
     */
    protected function checkDir(string $dirname): bool
    {
        return (!file_exists($dirname) && !mkdir($dirname, 0777, true)) || !is_writeable($dirname);
    }

    /**
     * 重命名文件
     * @param string $format
     * @return string
     */
    protected function getFullPath(string $format)
    {
        $t = time();
        $d = explode('-', date("Y-y-m-d-H-i-s"));
        $format = str_replace("{yyyy}", $d[0], $format);
        $format = str_replace("{yy}", $d[1], $format);
        $format = str_replace("{mm}", $d[2], $format);
        $format = str_replace("{dd}", $d[3], $format);
        $format = str_replace("{hh}", $d[4], $format);
        $format = str_replace("{ii}", $d[5], $format);
        $format = str_replace("{ss}", $d[6], $format);
        $format = str_replace("{time}", $t, $format);
        if (preg_match("/\{rand\:([\d]*)\}/i", $format, $matches)) {
            $format = preg_replace("/\{rand\:[\d]*\}/i", Str::random($matches[1]), $format);
        }
        return $format;
    }

    /**
     * @param int $size
     * @return bool
     */
    protected function checkFileSize(int $size){
        return $size <= ($this->config["size"]);
    }
}