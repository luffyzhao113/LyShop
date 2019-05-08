<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/26
 * Time: 13:35
 */

namespace App\Http\Controllers\Api\Goods;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Goods\CategoryRequest;
use App\Repositories\Category;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * index
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->response(
            $this->category->get(['*'])
        );
    }

    /**
     * store
     * @param CategoryRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        return $this->response(
            $this->category->create(
                $request->only([
                    'name', 'parent_id', 'sort', 'description', 'status', 'search_filters'
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
    public function edit($id)
    {
        return $this->response([
            'row' => $this->category->find($id)
        ]);
    }

    /**
     * update
     * @param CategoryRequest $request
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(CategoryRequest $request, $id)
    {
        return $this->response(
            $this->category->update($id,
                $request->only([
                    'name', 'sort', 'description', 'status', 'search_filters'
                ])
            )
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
            $this->category->delete($id)
        );
    }
}