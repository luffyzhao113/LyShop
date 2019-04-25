<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/24
 * Time: 19:04
 */

namespace App\Http\Controllers\Api\Setting;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\Focus\Position\StoreRequest;
use App\Http\Requests\Api\Setting\Focus\Position\UpdateRequest;
use App\Http\Searchs\Api\Setting\FocusPositionSearch;
use App\Repositories\FocusPosition;

class FocusPositionController extends Controller
{
    /**
     * @var FocusPosition
     */
    private $position;

    public function __construct(FocusPosition $position)
    {
        $this->position = $position;
    }

    /**
     * index
     * @author luffyzhao@vip.126.com
     * @param FocusPositionSearch $search
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(FocusPositionSearch $search)
    {
        return $this->response(
            $this->position->paginate($search->toArray())
        );
    }

    /**
     * store
     * @param StoreRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        return $this->response(
            $this->position->create($request->only(['name', 'description']))
        );
    }

    /**
     * edit
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id)
    {
        return $this->response(
            $this->position->find($id)
        );
    }

    /**
     * update
     * @param UpdateRequest $request
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(UpdateRequest $request, $id)
    {
        return $this->response(
            $this->position->update($id, $request->only(['name', 'description']))
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
            $this->position->delete($id)
        );
    }
}