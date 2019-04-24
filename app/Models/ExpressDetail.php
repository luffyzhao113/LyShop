<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/23
 * Time: 14:00
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ExpressDetail extends Model
{
    protected $fillable = ['express_id', 'first', 'first_fee', 'continue', 'continue_fee'];

    /**
     * areas
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function areas(){
        return $this->belongsToMany(Areas::class, 'express_detail_areas', 'express_detail_id', 'area_id');
    }
}