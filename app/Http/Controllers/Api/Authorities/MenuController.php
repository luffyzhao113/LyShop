<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 11:04
 */

namespace App\Http\Controllers\Api\Authorities;

use App\Http\Requests\Api\Authorities\MenuRequest;
use App\Repositories\Authority;
use App\Repositories\Menu;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * @var Menu
     */
    private $menu;

    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * 列表
     * @return \Illuminate\Database\Eloquent\Collection
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/26 14:32
     */
    public function index()
    {
        return $this->menu->get(['*']);
    }

    /**
     * @param Authority $authority
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 14:59
     */
    public function create(Authority $authority){
        return $this->response(
            $authority->get(['id as key', 'name as label'])
        );
    }

    /**
     * @param MenuRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/26 15:16
     */
    public function store(MenuRequest $request)
    {
        return $this->response(
            $this->menu->create(
                $request->only([
                    'parent_id', 'name', 'url', 'sort', 'description', 'authorities'
                ])
            )
        );
    }

    /**
     * @param Authority $authority
     * @param $id
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 15:14
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Authority $authority, $id){
        return $this->response([
            'authorities' => $authority->get(['id as key', 'name as label']),
            'row' => $this->menu->editFind($id)
        ]);
    }


    /**
     * @param MenuRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 19:03
     */
    public function update(MenuRequest $request, $id)
    {
        return $this->response(
            $this->menu->update($id, $request->only([
                'name', 'url', 'sort', 'description', 'authorities'
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
            $this->menu->delete($id)
        );
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 15:56
     */
    public function authority(Request $request){
        return $this->response(
            $this->menu->finds(
                $request->only(['ids'])
            )
        );
    }
}