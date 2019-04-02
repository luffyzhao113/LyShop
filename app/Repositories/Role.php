<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 10:50
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Role extends RepositoryAbstract
{
    /**
     * @var \App\Models\Role
     */
    protected $model;

    /**
     * RepositoryAbstract constructor.
     *
     * @param \App\Models\Role $model
     */
    public function __construct(\App\Models\Role $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return bool|\Illuminate\Database\Eloquent\Model
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:42
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);
        if (isset($attributes['authorities'])) {
            $model->authorities()->attach($attributes['authorities']);
        }
        if (isset($attributes['menus'])) {
            $model->menus()->attach($attributes['menus']);
        }
        return $model;
    }

    /**
     * @param $id
     * @param array $values
     * @return bool|\Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 17:17
     */
    public function update($id, array $values)
    {
        $model = $this->find($id);
        $model->fill($values)->saveOrFail();
        $model->authorities()->sync($values['authorities'] ?? []);
        $model->menus()->sync($values['menus'] ?? []);
        return $model;
    }
}