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
use App\Http\Searchs\Api\Goods\GoodsSearch;
use App\Repositories\Category;
use App\Repositories\Goods;
use App\Repositories\Spec;
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
     * file
     * @param FileRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function file(FileRequest $request){
        if($file = $request->file('file')->store('goods')){
            return $this->response([
                'url' => Storage::url($file),
                'path' => $file
            ]);
        }else{
            throw new FileException('文件上传失败');
        }
    }

    /**
     * index
     * @param GoodsSearch $search
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(GoodsSearch $search)
    {
        return $this->response(
            $this->goods->paginate($search->toArray())
        );
    }

    /**
     * create
     * @param Category $category
     * @param Spec $spec
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function create(Category $category, Spec $spec)
    {
        $specs = $spec->get(['id', 'name', 'values', 'type'])->groupBy('type');

        return $this->response([
            'categories' => $category->get(['id', 'name as title', 'parent_id']),
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
     * store
     * @param GoodsRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
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
     * edit
     * @param Category $category
     * @param Spec $spec
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Category $category, Spec $spec, $id){
        $specs = $spec->get(['id', 'name', 'values', 'type'])->groupBy('type');
        return $this->response([
            'row' => $this->goods->editFind($id),
            'categories' => $category->get(['id', 'name as title', 'parent_id']),
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
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(GoodsRequest $request, $id){
        return $this->response(
            $this->goods->update(
                $id,
                $request->only([
                    'name', 'price', 'stock', 'weight', 'type', 'status', 'categories', 'file', 'galleries', 'attributes', 'detail', 'specs'
                ])
            )
        );
    }
}