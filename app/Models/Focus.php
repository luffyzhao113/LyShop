<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/24
 * Time: 19:14
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Focus extends Model
{
    use SoftDeletes;

    protected $table = 'focus';

    protected $fillable = ['position_id', 'name', 'file', 'description', 'sort', 'status'];

}