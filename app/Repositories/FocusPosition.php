<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/24
 * Time: 19:16
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class FocusPosition extends RepositoryAbstract
{
    public function __construct(\App\Models\FocusPosition $model)
    {
        $this->model = $model;
    }

    public function delete($id)
    {
        /**
         * @var \App\Models\FocusPosition $model
         */
        $model = $this->find($id);
        $model->focus()->delete();
        return $model->delete();
    }
}