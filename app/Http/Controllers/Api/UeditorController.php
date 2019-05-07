<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/7
 * Time: 10:10
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Plugins\Uploader\Ueditor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UeditorController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function index(Request $request)
    {
        $action = htmlspecialchars($request->input('action'));

        switch ($action) {
            // 获取配置
            case 'config':
                $result = config('ueditor');
                break;
            // 列出图片
            case 'listimage':
                // 列出文件
            case 'listfile':
                $result = $this->show($request, $action);
                break;
            // 抓取远程文件
            case 'catchimage':
                $result = $this->catchImage($request);
                break;
            // 文件上传
            default:
                $result = $this->uploader($action);
        }
        return $result;
    }

    /**
     * uploader
     * @param $action
     * @return array
     * @author luffyzhao@vip.126.com
     */
    private function uploader($action)
    {
        $config = $this->getConfig($action);
        return (new Ueditor($config, $action))->getFileInfo();
    }

    /**
     * list
     * @param Request $request
     * @param $action
     * @author luffyzhao@vip.126.com
     * @return array
     */
    private function show(Request $request, $action)
    {
        $config = $this->getConfig($action);

        /* 获取参数 */
        $size = $request->input('size', $config['listSize']);
        $start = $request->input('start', 0);
        $end = $start + $size;

        $files = Storage::allFiles($config['path']);

        foreach ($files as $file) {
            if (preg_match("/\.(" . $config['allowFiles'] . ")$/i", $file)) {
                $files[] = [
                    'url' => Storage::url($file),
                    'mtime' => Storage::lastModified($file),
                ];
            }
        }

        if (count($files) === 0) {
            return [
                "state" => "no match file",
                "list" => array(),
                "start" => $start,
                "total" => count($files),
            ];
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--) {
            $list[] = $files[$i];
        }
        return [
            "state" => "SUCCESS",
            "list" => $list,
            "start" => $start,
            "total" => count($files),
        ];
    }


    /**
     * @param Request $request
     * @return array
     */
    private function catchImage(Request $request)
    {
        /* 上传配置 */
        $config = $this->getConfig('remote');
        /* 抓取远程图片 */
        $list = [];
        $source = $request->input($config['fieldName']);
        foreach ($source as $imgUrl) {
            $config['fieldName'] = $imgUrl;
            $item = new Ueditor($config, "remote");
            $info = $item->getFileInfo();
            array_push(
                $list,
                [
                    "state" => $info["state"],
                    "url" => $info["url"],
                    "size" => $info["size"],
                    "title" => htmlspecialchars($info["title"]),
                    "original" => htmlspecialchars($info["original"]),
                    "source" => htmlspecialchars($imgUrl),
                ]
            );
        }
        return [
            'state' => count($list) ? 'SUCCESS' : 'ERROR',
            'list' => $list,
        ];
    }

    /**
     * getConfig
     * @param string $type
     * @author luffyzhao@vip.126.com
     * @return array
     */
    private function getConfig($type = 'remote')
    {
        $config = config('ueditor');
        switch ($type) {
            // 抓取远程文件
            case 'remote':
                $config = [
                    "pathFormat" => $config['catcherPathFormat'],
                    "maxSize" => $config['catcherMaxSize'],
                    "allowFiles" => $config['catcherAllowFiles'],
                    "oriName" => "remote.png",
                    'fieldName' => $config['catcherFieldName']
                ];
                break;
            // 上传图片
            case 'uploadimage':
                $config = [
                    "pathFormat" => $config['imagePathFormat'],
                    "maxSize" => $config['imageMaxSize'],
                    "allowFiles" => $config['imageAllowFiles'],
                    'fieldName' => $config['imageFieldName']
                ];
                break;
            // 上传涂鸦
            case 'uploadscrawl':
                $config = [
                    "pathFormat" => $config['scrawlPathFormat'],
                    "maxSize" => $config['scrawlMaxSize'],
                    "allowFiles" => $config['scrawlAllowFiles'],
                    "oriName" => "scrawl.png",
                    'fieldName' => $config['scrawlFieldName'],
                ];
                break;
            // 上传视频
            case 'uploadvideo':
                $config = [
                    "pathFormat" => $config['videoPathFormat'],
                    "maxSize" => $config['videoMaxSize'],
                    "allowFiles" => $config['videoAllowFiles'],
                    'fieldName' => $config['videoFieldName'],
                ];
                break;
            // 上传文件
            case 'uploadfile':
                $config = [
                    "pathFormat" => $config['filePathFormat'],
                    "maxSize" => $config['fileMaxSize'],
                    "allowFiles" => $config['fileAllowFiles'],
                    'fieldName' => $config['fileFieldName'],
                ];
                break;
            // 列出已上传的图片
            case 'listimage':
                $config = [
                    'allowFiles' => substr(str_replace(".", "|", join("", $config['imageManagerAllowFiles'])), 1),
                    'listSize' => $config['imageManagerListSize'],
                    'path' => $config['imageManagerListPath']
                ];
                break;
            // 列出已上传的图片
            case 'listfile':
                $config = [
                    'allowFiles' => substr(str_replace(".", "|", join("", $config['fileManagerAllowFiles'])), 1),
                    'listSize' => $config['fileManagerListSize'],
                    'path' => $config['fileManagerListPath']
                ];
                break;
        }
        return $config;
    }
}