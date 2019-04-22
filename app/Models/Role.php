<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 10:41
 */

namespace App\Models;


use Illuminate\Cache\TaggableStore;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:41
     */
    public function authorities()
    {
        return $this->belongsToMany(Authority::class, 'role_authority', 'role_id', 'authority_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 16:41
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'role_menu', 'role_id', 'menu_id');
    }


    /**
     * clearCache
     * @author luffyzhao@vip.126.com
     * @static       * @return bool
     */
    public static function clearCache()
    {
        if (Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('authorities.role_menus_table'))->flush();
            Cache::tags(Config::get('authorities.role_authorities_table'))->flush();
        }
        return true;
    }

    /**
     * boot
     * @author luffyzhao@vip.126.com
     * @static
     */
    public static function boot()
    {
        parent::boot();
        static::saved([static::class, 'clearCache']);
        static::deleted([static::class, 'clearCache']);
        static::addGlobalScope('sort', function(Builder $builder) {
            $builder->orderByDesc('id');
        });
    }



    /**
     * 缓存用户组菜单
     * cachedMenus
     * @author luffyzhao@vip.126.com
     * @return Collection
     */
    public function cachedMenus(): Collection
    {
        $rolePrimaryKey = $this->primaryKey;
        $cacheKey = 'authorities:role_menus:' . $this->$rolePrimaryKey;
        if (Cache::getStore() instanceof TaggableStore) {
            return Cache::tags(Config::get('authorities.role_menus_table'))->remember($cacheKey, Config::get('cache.ttl', 2678400), function () {
                return $this->menus()->orderBy('sort')->get(['id', 'name', 'parent_id', 'url as link']);
            });
        } else return $this->menus()->orderBy('sort')->get(['id', 'name', 'parent_id', 'url as link']);
    }

    /**
     * 缓存用户组权限
     * cachedAuthorities
     * @author luffyzhao@vip.126.com
     * @return Collection
     */
    public function cachedAuthorities(): Collection
    {
        $rolePrimaryKey = $this->primaryKey;
        $cacheKey = 'authorities:role_authorities:' . $this->$rolePrimaryKey;
        if (Cache::getStore() instanceof TaggableStore) {
            return Cache::tags(Config::get('authorities.role_authorities_table'))->remember($cacheKey, Config::get('cache.ttl', 2678400), function () {
                return $this->authorities()->get();
            });
        } else return $this->authorities()->get();
    }

    /**
     * 是否有这个权限
     * hasPermission
     * @param string $name
     * @author luffyzhao@vip.126.com
     * @return bool
     */
    public function hasPermission(string $name): bool
    {
        foreach ($this->cachedAuthorities() as $permission) {
            if ($permission->uri == $name) {
                return true;
            }
        }
        return false;
    }
}