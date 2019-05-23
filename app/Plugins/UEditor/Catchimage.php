<?php


namespace App\Plugins\UEditor;


use Illuminate\Contracts\Filesystem\FileExistsException;
use Illuminate\Http\Request;

class Catchimage extends Base implements Contracts\UEditor
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->config = [
            "path" => config('ueditor.catcherPathFormat'),
            "size" => config('ueditor.catcherMaxSize'),
            "allow" => config('ueditor.catcherAllowFiles'),
            "oriName" => "remote.png",
            'name' => config('ueditor.catcherFieldName')
        ];
    }

    /**
     * @return array
     * @throws FileExistsException
     */
    public function handle(): array
    {
        $url = str_replace("&amp;", "&", htmlspecialchars($this->request->get($this->config['name'])));

        $this->check($url);

        //打开输出缓冲区并获取远程图片
        ob_start();
        $context = stream_context_create(
            array(
                'http' => array(
                    'follow_location' => false // don't follow redirects
                ),
            )
        );
        readfile($url, false, $context);
        $img = ob_get_contents();
        ob_end_clean();
        preg_match("/[\/]([^\/]*)[\.]?[^\.\/]*$/", $url, $m);
        $this->config['oriName'] = $m ? $m[1] : $this->config['oriName'];

        return $this->saveContent($img);
    }

    /**
     * @param string $url
     * @throws FileExistsException
     */
    protected function check(string $url)
    {
        //http开头验证
        if (strpos($url, "http") !== 0) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_HTTP_LINK")
            );
        }

        preg_match('/(^https*:\/\/[^:\/]+)/', $url, $matches);
        $host_with_protocol = count($matches) > 1 ? $matches[1] : '';
        // 判断是否是合法 url
        if (!filter_var($host_with_protocol, FILTER_VALIDATE_URL)) {
            throw new FileExistsException(
                $this->getStateInfo("INVALID_URL")
            );
        }
        preg_match('/^https*:\/\/(.+)/', $host_with_protocol, $matches);
        $host_without_protocol = count($matches) > 1 ? $matches[1] : '';
        // 此时提取出来的可能是 ip 也有可能是域名，先获取 ip
        $ip = gethostbyname($host_without_protocol);
        // 判断是否是私有 ip
        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE)) {
            throw new FileExistsException(
                $this->getStateInfo("INVALID_IP")
            );
        }
        //获取请求头并检测死链
        $heads = get_headers($url, 1);
        if (!(stristr($heads[0], "200") && stristr($heads[0], "OK"))) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_DEAD_LINK")
            );
        }
        //格式验证(扩展名验证和Content-Type验证)
        $fileType = strtolower(strrchr($url, '.'));
        if (!in_array($fileType, $this->config['allow']) || !isset($heads['Content-Type']) || !stristr(
                $heads['Content-Type'],
                "image"
            )) {
            throw new FileExistsException(
                $this->getStateInfo("ERROR_HTTP_CONTENTTYPE")
            );
        }
    }
}