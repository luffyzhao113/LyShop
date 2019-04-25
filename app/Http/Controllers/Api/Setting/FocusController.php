<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/25
 * Time: 15:34
 */

namespace App\Http\Controllers\Api\Setting;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\Focus\FileRequest;
use App\Http\Requests\Api\Setting\Focus\StoreRequest;
use App\Http\Requests\Api\Setting\Focus\UpdateRequest;
use App\Repositories\Focus;
use App\Repositories\FocusPosition;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FocusController extends Controller
{
    /**
     * @var Focus
     */
    private $focus;

    public function __construct(Focus $focus)
    {
        $this->focus = $focus;
    }

    /**
     * view
     * @param FocusPosition $position
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function view(FocusPosition $position){
        return $this->response([
            'positions' => $position->get(['id', 'name'])
        ]);
    }
    /**
     * index
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(
            $this->focus->paginate([])
        );
    }

    /**
     * create
     * @param FocusPosition $position
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(FocusPosition $position){
        return $this->response([
            'positions' => $position->get(['id', 'name'])
        ]);
    }

    /**
     * file
     * @param FileRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function file(FileRequest $request){
        if($file = $request->file('file')->store('focus')){
            return $this->response([
                'url' => Storage::url($file),
                'path' => $file
            ]);
        }else{
            throw new FileException('文件上传失败');
        }
    }

    /**
     * store
     * @param StoreRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request){
        return $this->response(
            $this->focus->create($request->only([
                'name', 'url', 'file', 'sort', 'status', 'description', 'position_id'
            ]))
        );
    }

    /**
     * edit
     * @param FocusPosition $position
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(FocusPosition $position, $id){
        return $this->response([
            'row' => $this->focus->find($id),
            'positions' => $position->get(['id', 'name'])
        ]);
    }

    /**
     * update
     * @param UpdateRequest $request
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $id){
        return $this->response(
            $this->focus->update($id, $request->only([
                'name', 'url', 'file', 'sort', 'status', 'description', 'position_id'
            ]))
        );
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 19:21
     * @throws \Exception
     */
    public function destroy($id){
        return $this->response(
            $this->focus->delete($id)
        );
    }
}