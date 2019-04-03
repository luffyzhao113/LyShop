<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 10:13
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Authority extends Model
{
    protected $fillable = ['name', 'uri', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:41
     */
    public function menus(){
        return $this->belongsToMany(Menu::class, 'menu_authority', 'authority_id', 'menu_id');
    }
}