<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 9:15
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Express extends RepositoryAbstract
{
    public function __construct(\App\Models\Express $express)
    {
        $this->model = $express;
    }

}