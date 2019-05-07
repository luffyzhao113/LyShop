<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/7
 * Time: 19:33
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GoodsDetail extends Model
{
    protected $fillable = ['goods_id', 'describe', 'unit'];
}