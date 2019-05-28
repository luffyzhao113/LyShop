<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/6
 * Time: 16:18
 */

namespace App\Repositories;


use App\MongoDB\Goods as GoodsMongodb;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
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
     * @param int $perPage
     * @param array $columns
     * @param string $pageName
     * @param int $page
     * @return LengthAwarePaginator
     * @author luffyzhao@vip.126.com
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
     * @return \App\Models\Goods|bool|Model
     * @throws \Exception
     * @author luffyzhao@vip.126.com
     */
    public function create(array $attributes = [])
    {
        try {
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
                    foreach ($spec['items'] as $item) {
                        $specModel->items()->create($item + ['goods_id' => $model->getAttribute('id')]);
                    }
                }
            }
            // 更新mongodb
            GoodsMongodb::cr($model);

            DB::commit();
            return $model;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }



    /**
     * editFind
     * @param $id
     * @return Collection
     * @author luffyzhao@vip.126.com
     */
    public function editFind($id)
    {
        $row = $this->model->with([
            'categories:id',
            'detail:goods_id,describe,unit',
            'galleries:goods_id,file,sort',
            'attributes:goods_id,name,values',
            'specs:price,stock,goods_id,id',
            'specs.items:name,value,goods_spec_id'
        ])->findOrFail($id)->toArray();

        return collect($row)->map(function ($item, $key) {
            if ($key === 'categories') {
                return collect($item)->pluck('id');
            }
            if ($key === 'detail') {
                unset($item['goods_id']);
            }
            if ($key === 'galleries' || $key === 'attributes') {
                return collect($item)->map(function ($value) {
                    unset($value['goods_id']);
                    return $value;
                });
            }
            if ($key === 'specs') {
                return collect($item)->map(function ($value) {
                    unset($value['goods_id']);
                    unset($value['id']);
                    $value['items'] = collect($value['items'])->map(function ($value) {
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
     * @return bool|Model
     * @throws \Throwable
     * @author luffyzhao@vip.126.com
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
                    foreach ($spec['items'] as $item) {
                        $specModel->items()->create($item + ['goods_id' => $model->getAttribute('id')]);
                    }
                }
            }
            // 更新mongodb
            GoodsMongodb::up($model);

            DB::commit();

            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param $id
     * @param array $values
     * @throws \Exception
     * @throws \Throwable
     * @author luffyzhao@vip.126.com
     */
    public function simpleUpdate($id, array $values)
    {
        try {
            DB::beginTransaction();
            $model = $this->find($id);
            $model->fill($values)->saveOrFail();
            // 更新mongodb
            GoodsMongodb::up($model);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param $id
     * @return bool|mixed
     * @throws \Exception
     * @author luffyzhao@vip.126.com
     */
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            parent::delete($id);
            GoodsMongodb::where('id', (int)$id)->first()->delete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return true;
    }

    /**
     * 恢复
     * @param $id
     * @throws \Exception
     * @author luffyzhao@vip.126.com
     */
    public function recovery($id)
    {
        /**
         * @var $model \App\Models\Goods
         */
        $model = $this->model->onlyTrashed()->findOrFail($id, ['*']);
        DB::beginTransaction();
        try {
            $model->setAttribute('status', 'undercarriage');
            $model->restore();
            GoodsMongodb::up($model);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * @param $id
     * @throws \Exception
     * @author luffyzhao@vip.126.com
     */
    public function recycleDestroy($id){
        /**
         * @var $model \App\Models\Goods
         */
        $model = $this->model->onlyTrashed()->findOrFail($id, ['*']);
        DB::beginTransaction();
        try {
            $model->forceDelete();
            GoodsMongodb::where('id', $model->getKey())->onlyTrashed()->first()->forceDelete();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }
}