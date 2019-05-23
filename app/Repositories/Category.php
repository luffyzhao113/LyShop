<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/26
 * Time: 9:44
 */

namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder as BuilderAlias;
use Illuminate\Database\Eloquent\Collection;
use LTools\Repositories\RepositoryAbstract;

class Category extends RepositoryAbstract
{
    public function __construct(\App\Models\Category $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @param array $withs
     * @return Collection
     */
    public function getWith(array $columns, array $withs)
    {
        return $this->model->newQuery()->with($withs)->get($columns);
    }

    /**
     * @param array $columns
     * @param array $scopes
     * @return BuilderAlias[]|Collection|mixed[]
     */
    public function getScope(array $columns, array $scopes){
        return $this->model->newQuery()->scopes($scopes)->get($columns);
    }

    /**
     * @param $id
     * @return bool|mixed
     * @throws \Exception
     */
    public function delete($id){
        return parent::delete($id);
    }
}