<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 10:50
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;
use LTools\Repositories\RepositoryAbstract;

class User extends RepositoryAbstract
{
    /**
     * @var \App\Models\User|Model
     */
    protected $model;

    /**
     * RepositoryAbstract constructor.
     *
     * @param \App\Models\User $model
     */
    public function __construct(\App\Models\User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @param int|null $perPage
     * @param array $columns
     * @param string $pageName
     * @param int|null $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/3 15:40
     */
    public function paginate(array $attributes, int $perPage = null, array $columns = ['*'], $pageName = 'page', int $page = null)
    {
        return $this->model->with(['role'])->where(
            $attributes
        )->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * @param $id
     * @param array $values
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 18:54
     * @return bool|Model
     * @throws \Throwable
     */
    public function status($id, array $values = []){
        return parent::update($id, $values);
    }

    /**
     * @param $id
     * @param array $values
     * @return bool|Model
     * @throws \Throwable
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 19:43
     */
    public function update($id, array $values)
    {
        if(empty($values['password'])){
            unset($values['password']);
        }
        return parent::update($id, $values);
    }

}