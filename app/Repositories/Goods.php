<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/6
 * Time: 16:18
 */

namespace App\Repositories;


use Illuminate\Support\Facades\DB;
use LTools\Repositories\RepositoryAbstract;

class Goods extends RepositoryAbstract
{
    public function __construct(\App\Models\Goods $model)
    {
        $this->model = $model;
    }

    /**
     * paginate
     * @param array $attributes
     * @param int|null $perPage
     * @param array $columns
     * @param string $pageName
     * @param int|null $page
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginate(array $attributes, int $perPage = null, array $columns = ['*'], $pageName = 'page', int $page = null)
    {
        return $this->model->with(['categories:id,name'])->where(
            $attributes
        )->paginate($perPage, $columns, $pageName, $page);
    }

    /**
     * create
     * @param array $attributes
     * @author luffyzhao@vip.126.com
     * @return \App\Models\Goods|bool|\Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function create(array $attributes = [])
    {
        try{
            DB::beginTransaction();
            /**
             * @var $model \App\Models\Goods
             */
            $model = parent::create($attributes);

            $model->categories()->attach($attributes['categories']);

            $model->galleries()->createMany($attributes['galleries']);

            $model->detail()->create($attributes['detail']);

            if (array_key_exists('attributes', $attributes)) {
                $model->attributes()->createMany($attributes['attributes']);
            }

            if (array_key_exists('specs', $attributes)) {
                foreach ($attributes['specs'] as $spec) {
                    /**
                     * @var $specModel \App\Models\GoodsSpec
                     */
                    $specModel = $model->specs()->create($spec);
                    foreach ($spec['items'] as $item){
                        $specModel->items()->create($item + ['goods_id' =>$model->getAttribute('id')]);
                    }
                }
            }

            DB::commit();
            return $model;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }


    /**
     * editFind
     * @param $id
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Support\Collection
     */
    public function editFind($id){
        $row = $this->model->with([
            'categories:id',
            'detail:goods_id,describe,unit',
            'galleries:goods_id,file,sort',
            'attributes:goods_id,name,values',
            'specs:price,stock,goods_id,id',
            'specs.items:name,value,goods_spec_id'
        ])->findOrFail($id)->toArray();

        return collect($row)->map(function ($item, $key){
            if($key === 'categories'){
                return collect($item)->pluck('id');
            }
            if($key === 'detail'){
                unset($item['goods_id']);
            }
            if($key === 'galleries' || $key === 'attributes'){
                return collect($item)->map(function ($value){
                    unset($value['goods_id']);
                    return $value;
                });
            }
            if($key === 'specs'){
                return collect($item)->map(function ($value){
                    unset($value['goods_id']);
                    unset($value['id']);
                    $value['items'] = collect($value['items'])->map(function ($value){
                        unset($value['goods_spec_id']);
                        return $value;
                    });
                    return $value;
                });
            }
            return $item;
        });
    }

    /**
     * update
     * @param $id
     * @param array $values
     * @author luffyzhao@vip.126.com
     * @return bool|\Illuminate\Database\Eloquent\Model
     * @throws \Throwable
     */
    public function update($id, array $values)
    {
        try {
            DB::beginTransaction();
            /**
             * @var $model \App\Models\Goods
             */
            $model = $this->find($id);
            $model->fill($values)->saveOrFail();

            $model->categories()->sync($values['categories']);

            $model->galleries()->delete();
            $model->detail()->delete();
            $model->attributes()->delete();
            $model->specs()->delete();
            $model->specItems()->delete();

            $model->galleries()->createMany($values['galleries']);

            $model->detail()->create($values['detail']);

            if (array_key_exists('attributes', $values)) {
                $model->attributes()->createMany($values['attributes']);
            }

            if (array_key_exists('specs', $values)) {
                foreach ($values['specs'] as $spec) {
                    /**
                     * @var $specModel \App\Models\GoodsSpec
                     */
                    $specModel = $model->specs()->create($spec);
                    foreach ($spec['items'] as $item){
                        $specModel->items()->create($item + ['goods_id' =>$model->getAttribute('id')]);
                    }
                }
            }

            DB::commit();

            return true;
        }catch (\Exception $exception){
            DB::rollBack();
            throw $exception;
        }
    }
}