<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/6
 * Time: 16:18
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Goods extends RepositoryAbstract
{
    public function __construct(\App\Models\Goods $model)
    {
        $this->model = $model;
    }
}