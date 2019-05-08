<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/26
 * Time: 9:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'parent_id', 'sort', 'description', 'status', 'search_filters'];

    protected $casts = [
        'search_filters' => 'array',
        'id' => 'string'
    ];
    /**
     * boot
     * @author luffyzhao@vip.126.com
     * @static
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function(Category $category){
            $parentId = $category->getAttribute('parent_id');
            $count = Category::withTrashed()->where('parent_id', '=', $parentId)->count();
            $id = str_pad(dechex($count+1), 3, '0', STR_PAD_LEFT);
            if($parentId !== '0'){
                $id = $parentId . $id;
            }
            $category->setAttribute('id', $id);
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
}