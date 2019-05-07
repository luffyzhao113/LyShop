<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/7
 * Time: 19:47
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GoodsSpecItem extends Model
{
    protected $fillable = ['goods_id', 'goods_spec_id', 'name', 'value'];

    public $timestamps = false;
}