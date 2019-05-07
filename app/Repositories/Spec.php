<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/30
 * Time: 9:40
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Spec extends RepositoryAbstract
{
    public function __construct(\App\Models\Spec $model)
    {
        $this->model = $model;
    }
}