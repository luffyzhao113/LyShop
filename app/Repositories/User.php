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
     * @return bool|Model
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 15:30
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);

        if (isset($attributes['roles'])) {
            $model->roles()->attach($attributes['roles']);
        }

        return $model;
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
        $model = $this->find($id);
        $model->fill($values)->saveOrFail();
        $model->roles()->sync($values['roles'] ?? []);
        return $model;
    }

}