<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 9:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Express extends Model
{
    protected $table = 'express';

    protected $fillable = ['name', 'description', 'type', 'status', 'company_id'];
}