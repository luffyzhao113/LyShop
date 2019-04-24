<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 11:11
 */

namespace App\Http\Controllers\Api\Authorities;

use App\Http\Requests\Api\Authorities\Authority\StoreRequest;
use App\Http\Requests\Api\Authorities\Authority\UpdateRequest;
use App\Http\Searchs\Api\Authorities\AuthoritySearch;
use App\Repositories\Authority;
use App\Http\Controllers\Controller;
use App\Repositories\Menu;

class AuthorityController extends Controller
{
    /**
     * @var Authority
     */
    private $authority;

    public function __construct(Authority $authority)
    {
        $this->authority = $authority;
    }

    /**
     * @param AuthoritySearch $search
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 11:04
     */
    public function index(AuthoritySearch $search)
    {
        return $this->response(
            $this->authority->paginate($search->toArray())
        );
    }

    /**
     * @param StoreRequest $request
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 13:27
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        return $this->response(
            $this->authority->create(
                $request->only([
                    'name', 'uri', 'description', 'menus'
                ])
            )
        );
    }


    /**
     * @param Menu $menu
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 15:33
     */
    public function create(Menu $menu){
        return $this->response(
            $menu->get(['id', 'name as title', 'parent_id'])
        );
    }

    /**
     * @param Menu $menu
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 15:43
     */
    public function edit(Menu $menu, $id){
        return $this->response([
            'menus' => $menu->get(['id', 'name as title', 'parent_id']),
            'row' => $this->authority->editFind($id)
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 15:20
     */
    public function update(UpdateRequest $request, $id){
        return $this->response(
            $this->authority->update($id, $request->only([
                'name', 'uri', 'description', 'menus'
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
            $this->authority->delete($id)
        );
    }


}