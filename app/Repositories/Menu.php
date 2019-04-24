<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 10:09
 */

namespace App\Repositories;

use App\Exceptions\PrintMessageException;
use LTools\Repositories\RepositoryAbstract;

class Menu extends RepositoryAbstract
{

    /**
     * RepositoryAbstract constructor.
     *
     * @param \App\Models\Menu $model
     */
    public function __construct(\App\Models\Menu $model)
    {
        $this->model = $model;
    }

    /**
     * @param int|string $id
     * @param array $columns
     * @return \Illuminate\Database\Eloquent\Model
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 16:34
     */
    public function find($id, array $columns = ['*'])
    {
        $model = parent::find($id, $columns);
        $model->load(['parent', 'children']);
        return $model;
    }

    /**
     * @param $id
     * @param array $values
     * @return bool|\Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 15:26
     */
    public function update($id, array $values)
    {
        $model = $this->find($id);
        $model->fill($values)->saveOrFail();
        return $model->authorities()->sync($values['authorities']??[]);
    }

    /**
     * @param array $attributes
     * @return bool|\Illuminate\Database\Eloquent\Model
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 15:12
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);
        if (isset($attributes['authorities'])) {
            $model->authorities()->attach($attributes['authorities']);
        }
        return $model;
    }

    /**
     * @param $id
     * @return bool|mixed|null
     * @throws PrintMessageException
     * @throws \Exception
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 19:27
     */
    public function delete($id){
        $model = parent::find($id);
        if($model->children()->count()){
            throw new PrintMessageException('该菜单还有子菜单，不可删除！');
        }
        return $model->delete();
    }

    /**
     * @param array $data
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/4/1 16:00
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function finds(array $data){
        $model = $this->model->findMany($data['ids']??[]);
        return $model->load('authorities');
    }

    public function editFind($id){
        $row = $this->model->with(['authorities:id', 'parent'])->findOrFail($id)->toArray();

        return collect($row)->map(function ($item){
            $item['authorities'] = collect($item['authorities'])->pluck('id');
            return $item;
        });
    }
}