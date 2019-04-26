<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/26
 * Time: 9:44
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Category extends RepositoryAbstract
{
    public function __construct(\App\Models\Category $model)
    {
        $this->model = $model;
    }

    public function delete($id){
        return parent::delete($id);
    }
}