<?php


namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class Member extends RepositoryAbstract
{
    public function __construct(\App\Models\Member $model)
    {
        $this->model = $model;
    }
}