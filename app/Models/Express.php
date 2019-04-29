<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/22
 * Time: 9:15
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Express extends Model
{
    use SoftDeletes;

    protected $table = 'express';

    protected $fillable = ['name', 'description', 'type', 'status', 'company_id'];

    /**
     * details
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details(){
        return $this->hasMany(ExpressDetail::class, 'express_id', 'id');
    }

    /**
     * company
     * @author luffyzhao@vip.126.com
     */
    public function company(){
        return $this->belongsTo(ExpressCompany::class, 'company_id', 'id');
    }
}