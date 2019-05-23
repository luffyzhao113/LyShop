<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/7
 * Time: 10:10
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Plugins\UEditor\Contracts\UEditor as UeditorContracts;
use Illuminate\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UeditorController extends Controller
{
    /**
     * @param Request $request
     * @return Repository|mixed|string
     */
    public function index(Request $request)
    {
        $action = htmlspecialchars($request->input('action'));

        $class = '\\App\\Plugins\\UEditor\\' . Str::camel($action);

        $response = ['state' => 'ERROR', 'msg' => '动作不存在'];

        if(class_exists($class)){
            $uEditor = app($class);
            if($uEditor instanceof UeditorContracts){
                try{
                    return $uEditor->handle();
                }catch (\Exception $exception){
                    $response['msg'] = $exception->getMessage();
                }
            }
        }
        return $response;
    }
}