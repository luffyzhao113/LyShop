<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 10:41
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:41
     */
    public function authorities(){
        return $this->belongsToMany(Authority::class, 'role_authority', 'role_id', 'authority_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:41
     */
    public function menus(){
        return $this->belongsToMany(Menu::class, 'role_menu', 'role_id', 'menu_id');
    }
}