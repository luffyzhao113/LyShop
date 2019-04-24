<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/24
 * Time: 19:16
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Focus extends RepositoryAbstract
{
    public function __construct(\App\Models\Focus $model)
    {
        $this->model = $model;
    }
}