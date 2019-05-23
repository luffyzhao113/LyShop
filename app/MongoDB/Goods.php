<?php

namespace App\MongoDB;

use App\Models\Goods as GoodsModel;
use Jenssegers\Mongodb\Eloquent\Model;

class Goods extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'goods';
    protected $primaryKey = 'id';

    protected $fillable = ['id', 'name', 'price', 'stock', 'weight', 'type', 'status', 'file', 'view', 'sales', 'collect', 'categories', 'spec_items', 'attributes'];

    /**
     * @param GoodsModel $goods
     * @return mixed
     */
    public static function up(GoodsModel $goods){
        $goods->with(['categories', 'attributes', 'specItems']);
        return self::create($goods->toArray());
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