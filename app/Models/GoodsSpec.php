<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/7
 * Time: 19:25
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GoodsSpec extends Model
{
    protected $fillable = ['goods_id', 'price', 'stock', 'file'];

    /**
     * items
     * @author luffyzhao@vip.126.com
     */
    public function items(){
        return $this->hasMany(GoodsSpecItem::class, 'goods_spec_id', 'id');
    }
}