<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 19:56
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Areas extends RepositoryAbstract
{
    public function __construct(\App\Models\Areas $model)
    {
        $this->model = $model;
    }

    /**
     * getByLevel
     * @param int $level
     * @param array $columns
     * @author luffyzhao@vip.126.com
     * @return mixed
     */
    public function getByLevel(int $level, array $columns = ['*'])
    {
        return $this->model->where('level', '=', $level)->get($columns);
    }
}