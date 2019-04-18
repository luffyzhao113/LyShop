<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/17
 * Time: 16:51
 */

namespace App\Http\Middleware;


use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Middleware\Authenticate;

class RBAC extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string[] ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if ($request->route()->getName() !== null && $user = $this->auth->guard()->user()) {
            if (!$user->role->hasPermission($request->route()->getName())) {
                throw new AuthorizationException('没有相关权限，请联系管理员添加');
            }
        }

        return $next($request);
    }
}