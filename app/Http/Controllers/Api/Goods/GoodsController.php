<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/6
 * Time: 16:17
 */

namespace App\Http\Controllers\Api\Goods;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FileRequest;
use App\Http\Requests\Api\Goods\GoodsRequest;
use App\Http\Requests\Api\Goods\ModifyRequest;
use App\Http\Searchs\Api\Goods\GoodsSearch;
use App\MongoDB\Goods as GoodsMongoDB;
use App\Repositories\Category;
use App\Repositories\Goods;
use App\Repositories\Spec;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class GoodsController extends Controller
{
    /**
     * @var Goods
     */
    private $goods;

    public function __construct(Goods $goods)
    {
        $this->goods = $goods;
    }

    /**
     * view
     * @param Category $category
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function view(Category $category)
    {
        return $this->response([
            'categories' => $category->getScope(['id', 'name', 'parent_id'], ['status' => 'on']),
        ]);
    }

    /**
 * index
 * @param GoodsSearch $search
 * @return JsonResponse
 * @author luffyzhao@vip.126.com
 */
    public function index(GoodsSearch $search)
    {
        return $this->response(
            GoodsMongoDB::where($search->toArray())->paginate()
        );
    }

    /**
     * index
     * @param GoodsSearch $search
     * @return JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function recycle(GoodsSearch $search)
    {
        return $this->response(
            GoodsMongoDB::onlyTrashed()->where($search->toArray())->paginate()
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws \Exception
     * @author luffyzhao@vip.126.com
     */
    public function recovery($id){
        return $this->response(
            $this->goods->recovery($id)
        );
    }

    public function recycleDestroy($id){
        return $this->response(
            $this->goods->recycleDestroy($id)
        );
    }
    /**
     * create
     * @param Category $category
     * @param Spec $spec
     * @return JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function create(Category $category, Spec $spec)
    {
        $specs = $spec->get(['id', 'name', 'values', 'type'])->groupBy('type');

        return $this->response([
            'categories' => $category->getScope(['id', 'name as title', 'parent_id'], ['status' => 'on']),
            'specs' => $specs['spec'],
            'attributes' => $specs['attr'],
            'units' => ['个', '箱', '袋'],
            'config' => [
                'default_gallery' => '/vendor/images/profile.jpeg',
                'max_specs' => 3,
            ]
        ]);
    }

    /**
     * file
     * @param FileRequest $request
     * @return JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function file(FileRequest $request)
    {
        if ($file = $request->file('file')->store('goods')) {
            return $this->response([
                'url' => Storage::url($file),
                'path' => $file
            ]);
        } else {
            throw new FileException('文件上传失败');
        }
    }

    /**
     * store
     * @param GoodsRequest $request
     * @return JsonResponse
     * @throws \Exception
     * @author luffyzhao@vip.126.com
     */
    public function store(GoodsRequest $request)
    {
        return $this->response(
            $this->goods->create(
                $request->only([
                    'name', 'price', 'stock', 'weight', 'type', 'status', 'categories', 'file', 'galleries', 'attributes', 'detail', 'specs'
                ])
            )
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function show($id){
        return $this->response([
            'row' => $this->goods->findWith($id, [
                'categories',
                'detail',
                'galleries',
                'attributes',
                'specs',
                'specs.items'
            ])
        ]);
    }

    /**
     * edit
     * @param Category $category
     * @param Spec $spec
     * @param $id
     * @return JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function edit(Category $category, Spec $spec, $id)
    {
        $specs = $spec->get(['id', 'name', 'values', 'type'])->groupBy('type');
        return $this->response([
            'row' => $this->goods->editFind($id),
            'categories' => $category->getScope(['id', 'name as title', 'parent_id'], ['status' => 'on']),
            'units' => ['个', '箱', '袋'],
            'specs' => $specs['spec'],
            'attributes' => $specs['attr'],
            'config' => [
                'default_gallery' => '/vendor/images/profile.jpeg',
                'max_specs' => 3,
            ]
        ]);
    }

    /**
     * update
     * @param GoodsRequest $request
     * @param $id
     * @return JsonResponse
     * @throws \Throwable
     * @author luffyzhao@vip.126.com
     */
    public function update(GoodsRequest $request, $id)
    {
        return $this->response(
            $this->goods->update(
                $id,
                $request->only([
                    'name', 'price', 'stock', 'weight', 'type', 'status', 'categories', 'file', 'galleries', 'attributes', 'detail', 'specs'
                ])
            )
        );
    }

    /**
     * @param ModifyRequest $request
     * @param $id
     * @return JsonResponse
     * @throws \Throwable
     * @author luffyzhao@vip.126.com
     */
    public function modify(ModifyRequest $request, $id)
    {
        return $this->response(
            $this->goods->simpleUpdate(
                $id,
                $request->only(['name', 'status', 'type', 'weight'])
            )
        );
    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 19:21
     */
    public function destroy($id)
    {
        return $this->response(
            $this->goods->delete($id)
        );
    }
}