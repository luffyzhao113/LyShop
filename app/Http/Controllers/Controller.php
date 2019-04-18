<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 19:14
     */
    public function response($data)
    {
        if (is_bool($data)) {
            $data = $data ? ['msg' => '成功'] : ['msg' => '失败'];
        }

        if(is_string($data)){
            $data = [
                'data' => $data
            ];
        }

        return response($data);
    }
}
