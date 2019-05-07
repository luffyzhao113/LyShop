<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/7
 * Time: 19:21
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GoodsGallery extends Model
{
    protected $fillable = ['file', 'goods_id', 'sort'];
}