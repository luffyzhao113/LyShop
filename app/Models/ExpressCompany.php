<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 14:01
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ExpressCompany extends Model
{
    protected $fillable = ['name', 'code', 'view', 'description'];
}