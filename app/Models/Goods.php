<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/6
 * Time: 16:17
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table = 'goods';

    protected $fillable = ['name', 'price', 'stock', 'weight', 'type', 'status', 'file', 'view', 'sales', 'collect'];

    /**
     * categories
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(){
        return $this->belongsToMany(Category::class, 'goods_categories', 'goods_id', 'category_id');
    }

    /**
     * galleries
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function galleries(){
        return $this->hasMany(GoodsGallery::class, 'goods_id', 'id');
    }

    /**
     * attributes
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes(){
        return $this->hasMany(GoodsAttribute::class, 'goods_id', 'id');
    }

    /**
     * detail
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail(){
        return $this->hasOne(GoodsDetail::class, 'goods_id', 'id');
    }

    /**
     * attributes
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function specs(){
        return $this->hasMany(GoodsSpec::class, 'goods_id', 'id');
    }

}