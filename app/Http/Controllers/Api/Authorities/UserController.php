<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 11:19
 */

namespace App\Http\Controllers\Api\Authorities;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Authorities\UserRequest;
use App\Http\Requests\Api\Authorities\UserStatusRequest;
use App\Http\Searchs\Api\Authorities\UserSearch;
use App\Repositories\Role;
use App\Repositories\User;

class UserController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @param UserSearch $search
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 18:06
     */
    public function index(UserSearch $search)
    {
        return $this->response(
            $this->user->paginate($search->toArray())
        );
    }

    /**
     * @param Role $role
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 15:39
     */
    public function create(Role $role)
    {
        return $this->response(
            $role->get(['id', 'name'])
        );
    }

    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 15:28
     */
    public function store(UserRequest $request)
    {
        return $this->response(
            $this->user->create($request->only([
                'name', 'email', 'phone', 'birthday', 'sex', 'entryday', 'role_id', 'password', 'status'
            ]))
        );
    }

    /**
     * @param UserStatusRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 18:40
     * @throws \Throwable
     */
    public function status(UserStatusRequest $request, $id)
    {
        return $this->response(
            $this->user->status(
                $id,
                $request->only(['status'])
            )
        );
    }

    /**
     * @param Role $role
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 19:13
     */
    public function edit(Role $role, $id)
    {
        return $this->response([
            'roles' => $role->get(['id', 'name']),
            'row' => $this->user->find($id)
        ]);
    }

    /**
     * @param UserRequest $request
     * @param $id
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 19:39
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function update(UserRequest $request, $id){
        return $this->response(
            $this->user->update($id, $request->only([
                'name', 'email', 'phone', 'birthday', 'sex', 'entryday', 'role_id', 'password', 'roles', 'status'
            ]))
        );
    }
}