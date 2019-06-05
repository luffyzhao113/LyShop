<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class OrderNote extends Model
{
    protected $fillable = ['order_id', 'type', 'remark'];
}