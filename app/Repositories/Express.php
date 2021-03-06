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
     * @return \App\Models\Express|bool|\Illuminate\Database\Eloquent\Model
     * @author luffyzhao@vip.126.com
     */
    public function create(array $attributes = [])
    {
        /**
         * @var $model \App\Models\Express
         */
        $model = parent::create($attributes);
        foreach ($attributes['details'] as $detail) {
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
     * @return \App\Models\Express|bool|\Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     * @author luffyzhao@vip.126.com
     */
    public function update($id, array $values)
    {
        /**
         * @var $model \App\Models\Express
         */
        $model = $this->find($id);
        $model->fill($values)->saveOrFail();
        $model->details()->delete();
        foreach ($values['details'] as $detail) {
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
     * @return \App\Models\Express|\App\Models\Express[]|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     * @author luffyzhao@vip.126.com
     */
    public function editFind($id)
    {
        $row = $this->model->with(['details.areas:areas.area_code'])->findOrFail($id)->toArray();
        return collect($row)->map(function ($item, $key) {
            if ($key === 'details') {
                return collect($item)->map(function ($val) {
                    $val['areas'] = collect($val['areas'])->pluck('area_code');
                    return $val;
                });
            }
            return $item;
        });
    }
    
    /**
     * @param array $attributes
     * @param array $columns
     * @return mixed
     * @author luffyzhao@vip.126.com
     */
    public function getWhere(array $attributes, array $columns = ['*'])
    {
        return $this->model->where($attributes)->get($columns);
    }
}