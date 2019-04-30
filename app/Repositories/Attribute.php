<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/30
 * Time: 9:40
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Attribute extends RepositoryAbstract
{
    public function __construct(\App\Models\Attribute $model)
    {
        $this->model = $model;
    }
}