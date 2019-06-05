<?php


namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Order extends RepositoryAbstract
{
    public function __construct(\App\Models\Order $model)
    {
        $this->model = $model;
    }
}