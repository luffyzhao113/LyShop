<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/6
 * Time: 16:17
 */

namespace App\Http\Controllers\Api\Goods;


use App\Http\Controllers\Controller;
use App\Repositories\Category;
use App\Repositories\Goods;
use App\Repositories\Spec;

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

    public function index(){

    }

    /**
     * create
     * @param Category $category
     * @param Spec $spec
     * @return \Illuminate\Http\JsonResponse
     * @author luffyzhao@vip.126.com
     */
    public function create(Category $category, Spec $spec){
        $specs = $spec->get(['id', 'name', 'values', 'type'])->groupBy('type');

        return $this->response([
            'categories' => $category->get(['id', 'name as title', 'parent_id']),
            'specs' => $specs['spec'],
            'attributes' => $specs['attr'],
            'units' => ['个', '箱', '袋'],
            'config' => [
                'default_gallery' => '/vendor/images/profile.jpeg'
            ]
        ]);
    }
}