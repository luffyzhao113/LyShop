<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 9:15
 */

namespace App\Repositories;


use LTools\Repositories\RepositoryAbstract;

class ExpressDetail extends RepositoryAbstract
{
    public function __construct(\App\Models\ExpressDetail $express)
    {
        $this->model = $express;
    }

    /**
     * create
     * @param array $attributes
     * @param string $type
     * @author luffyzhao@vip.126.com
     * @return \App\Models\ExpressDetail|bool|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes = [], $type = 'piece')
    {
        /**
         * @var $model \App\Models\ExpressDetail
         */
        $model = parent::create($attributes);

        $model->areas()->attach($attributes['areas'], ['type' => $type]);

        return $model;
    }

}