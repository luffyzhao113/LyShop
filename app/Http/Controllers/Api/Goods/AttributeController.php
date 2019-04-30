<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/30
 * Time: 9:44
 */

namespace App\Http\Controllers\Api\Goods;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Goods\Attribute\StoreRequest;
use App\Http\Requests\Api\Goods\Attribute\UpdateRequest;
use App\Http\Searchs\Api\Goods\AttributeSearch;
use App\Repositories\Attribute;

class AttributeController extends Controller
{
    /**
     * @var Attribute
     */
    private $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * index
     * @param AttributeSearch $search
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(AttributeSearch $search){
        return $this->response(
            $this->attribute->paginate($search->toArray())
        );
    }

    /**
     * store
     * @param StoreRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request){
        return $this->response(
            $this->attribute->create(
                $request->only([
                    'name', 'type', 'values', 'description'
                ])
            )
        );
    }

    /**
     * edit
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit($id){
        return $this->response([
            'row' => $this->attribute->find($id)
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
            $this->attribute->update(
                $id,
                $request->only([
                    'name', 'type', 'values', 'description'
                ])
            )
        );
    }

    /**
     * destroy
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id){
        return $this->response(
            $this->attribute->delete($id)
        );
    }
}