<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 10:00
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['parent_id', 'name', 'url', 'sort', 'description'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('sort', function(Builder $builder) {
            $builder->orderBy('sort');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 16:36
     */
    public function parent()
    {
        return $this->hasOne(get_class($this), $this->getKeyName(), 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/27 16:36
     */
    public function children()
    {
        return $this->hasMany(get_class($this), 'parent_id', $this->getKeyName());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:41
     */
    public function authorities(){
        return $this->belongsToMany(Authority::class, 'menu_authority', 'menu_id', 'authority_id');
    }
}