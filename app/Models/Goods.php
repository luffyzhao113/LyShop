<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/6
 * Time: 16:17
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Goods extends Model
{
    use SoftDeletes;

    protected $table = 'goods';

    protected $fillable = ['name', 'price', 'stock', 'weight', 'type', 'status', 'file', 'view', 'sales', 'collect'];

    protected $casts = [
        'view' => 'integer',
        'sales' => 'integer',
        'collect' => 'integer',
    ];

    protected $appends = ['view', 'sales', 'collect'];

    /**
 * getWeightAttribute
 * @param $value
 * @author luffyzhao@vip.126.com
 * @return float|int
 */
    protected function getViewAttribute($value)
    {
        return (int)$value;
    }

    /**
     * getWeightAttribute
     * @param $value
     * @author luffyzhao@vip.126.com
     * @return float|int
     */
    protected function getSalesAttribute($value)
    {
        return (int)$value;
    }

    /**
     * getWeightAttribute
     * @param $value
     * @author luffyzhao@vip.126.com
     * @return float|int
     */
    protected function getCollectAttribute($value)
    {
        return (int)$value;
    }

    /**
     * categories
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'goods_categories', 'goods_id', 'category_id')->withTrashed();
    }

    /**
     * galleries
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries()
    {
        return $this->hasMany(GoodsGallery::class, 'goods_id', 'id')->orderBy('sort');
    }

    /**
     * attributes
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(GoodsAttribute::class, 'goods_id', 'id');
    }

    /**
     * detail
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail()
    {
        return $this->hasOne(GoodsDetail::class, 'goods_id', 'id');
    }

    /**
     * attributes
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specs()
    {
        return $this->hasMany(GoodsSpec::class, 'goods_id', 'id');
    }

    /**
     * specItems
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specItems(){
        return $this->hasMany(GoodsSpecItem::class, 'goods_id', 'id');
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