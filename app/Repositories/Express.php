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


    public function paginate(array $attributes, int $perPage = null, array $columns = ['*'], $pageName = 'page', int $page = null)
    {
        return $this->model->with(['company'])->where(
            $attributes
        )->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * create
     * @param array $attributes
     * @author luffyzhao@vip.126.com
     * @return \App\Models\Express|bool|\Illuminate\Database\Eloquent\Model
     */
    public function create(array $attributes = [])
    {
        /**
         * @var $model \App\Models\Express
         */
        $model = parent::create($attributes);
        foreach ($attributes['details'] as $detail){
            /**
             * @var $app ExpressDetail
             */
            $detail['express_id'] = $model->getKey();
            $app = app(ExpressDetail::class);
            $app->create($detail, $attributes['type']);
        }

        return $model;
    }

    /**
     * update
     * @param $id
     * @param array $values
     * @author luffyzhao@vip.126.com
     * @return \App\Models\Express|bool|\Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function update($id, array $values)
    {
        /**
         * @var $model \App\Models\Express
         */
        $model = $this->find($id);
        $model->fill($values)->saveOrFail();
        $model->details()->delete();
        foreach ($values['details'] as $detail){
            /**
             * @var $app ExpressDetail
             */
            $detail['express_id'] = $model->getKey();
            $app = app(ExpressDetail::class);
            $app->create($detail, $values['type']);
        }

        return $model;
    }

    /**
     * editFind
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \App\Models\Express|\App\Models\Express[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function editFind($id){
        $row = $this->model->with(['details.areas:id'])->findOrFail($id)->toArray();
        $row['details'] = collect($row['details'])->map(function ($item){
            $item['areas'] = collect($item['areas'])->pluck('id');
            return $item;
        });
        return $row;
    }

}