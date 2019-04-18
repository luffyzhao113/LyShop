<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/4/3 16:12
 */

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\ProfileUpdateRequest;
use App\Repositories\User;
use Illuminate\Auth\AuthenticationException;

class AuthController extends Controller
{
    /**
     * login
     * @param LoginRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthenticationException
     */
    public function login(LoginRequest $request)
    {
        $token = auth('api')->attempt($request->only([
            'email', 'password'
        ]));

        if (!$token) {
            throw new AuthenticationException('Unauthorized');
        }

        $menus = auth('api')->user()->role->cachedMenus();

        return $this->response([
            'token' => (string)$token,
            'menus' => $menus
        ]);
    }

    /**
     * logout
     * @author luffyzhao@vip.126.com
     */
    public function logout()
    {
        return $this->response(auth('api')->logout());
    }

    /**
     * refresh
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->response((string)auth('api')->refresh());
    }

    /**
     * profile
     * @author luffyzhao@vip.126.com
     */
    public function profile()
    {
        $user = auth('api')->user();
        $user->load(['role']);
        return $this->response($user);
    }

    /**
     * profileUpdate
     * @param User $user
     * @param ProfileUpdateRequest $request
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function profileUpdate(User $user, ProfileUpdateRequest $request)
    {
        return $this->response(
            $user->profileUpdate(
                auth('api')->user(),
                $request->only([
                    'phone', 'birthday', 'sex', 'password', 'password_confirmation'
                ])
            )
        );
    }
}