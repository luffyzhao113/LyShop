<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 10:46
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Authority extends RepositoryAbstract
{
    /**
     * @var \App\Models\Authority
     */
    protected $model;

    /**
     * RepositoryAbstract constructor.
     *
     * @param \App\Models\Authority $model
     */
    public function __construct(\App\Models\Authority $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return bool|\Illuminate\Database\Eloquent\Model
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 15:40
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);
        if(isset($attributes['menus'])){
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
     * @datetime: 2019/4/1 15:49
     */
    public function update($id, array $values)
    {
        $model = $this->find($id);
        $model->fill($values)->saveOrFail();
        return $model->menus()->sync($values['menus']??[]);
    }
}