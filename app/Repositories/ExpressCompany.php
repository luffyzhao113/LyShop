<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 14:02
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class ExpressCompany extends RepositoryAbstract
{
    public function __construct(\App\Models\ExpressCompany $model)
    {
        $this->model = $model;
    }
}