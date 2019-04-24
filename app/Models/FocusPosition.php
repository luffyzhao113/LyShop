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

class FocusPosition extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description'];

    /**
     * focus
     * @author luffyzhao@vip.126.com
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function focus(){
        return $this->hasMany(Focus::class, 'position_id', 'id');
    }
}