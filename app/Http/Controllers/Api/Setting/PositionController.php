<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/24
 * Time: 19:04
 */

namespace App\Http\Controllers\Api\Setting;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Setting\PositionRequest;
use App\Http\Searchs\Api\Setting\PositionSearch;
use App\Repositories\FocusPosition;

class PositionController extends Controller
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
     * @param PositionSearch $search
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(PositionSearch $search)
    {
        return $this->response(
            $this->position->paginate($search->toArray())
        );
    }

    /**
     * store
     * @param PositionRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PositionRequest $request)
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
     * @param PositionRequest $request
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(PositionRequest $request, $id)
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