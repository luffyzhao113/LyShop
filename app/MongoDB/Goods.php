<?php

namespace App\MongoDB;

use App\Models\Goods as GoodsModel;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $connection = 'mongodb';
    protected $collection = 'goods';

    protected $fillable = ['id', 'name', 'price', 'stock', 'weight', 'type', 'status', 'file', 'view', 'sales', 'collect', 'categories', 'spec_items', 'attributes', 'deleted_at', 'updated_at', 'created_at'];

    /**
     * @param GoodsModel $goods
     * @return mixed
     */
    public static function cr(GoodsModel $goods){
        $goods->loadMissing(['categories', 'attributes', 'specItems']);
        return self::create($goods->toArray());
    }

    /**
 * @param GoodsModel $goods
 * @return mixed
 * @author luffyzhao@vip.126.com
 */
    public static function up(GoodsModel $goods){
        $goods->loadMissing(['categories', 'attributes', 'specItems']);
        return self::where('id', $goods->getKey())->withTrashed()->first()->fill($goods->toArray())->save();
    }

    /**
     * setPriceAttribute
     * @param $value
     * @author luffyzhao@vip.126.com
     */
    protected function setPriceAttribute($value)
    {
        $this->attributes['price'] = (int)$value * 100;
    }

    /**
     * getPriceAttribute
     * @param $value
     * @author luffyzhao@vip.126.com
     * @return float|int
     */
    protected function getPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * setWeightAttribute
     * @param $value
     * @author luffyzhao@vip.126.com
     */
    protected function setWeightAttribute($value)
    {
        $this->attributes['weight'] = (int)$value * 1000;
    }

    /**
     * getWeightAttribute
     * @param $value
     * @author luffyzhao@vip.126.com
     * @return float|int
     */
    protected function getWeightAttribute($value)
    {
        return (int)$value / 1000;
    }
}