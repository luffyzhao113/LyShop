<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    protected $fillable = ['express_no', 'status', 'express_id'];

    /**
     * @return HasOne
     * @author luffyzhao@vip.126.com
     */
    public function address()
    {
        return $this->hasOne(OrderAddress::class, 'order_id', 'id');
    }

    /**
     * @return HasMany
     * @author luffyzhao@vip.126.com
     */
    public function goods()
    {
        return $this->hasMany(OrderGoods::class, 'order_id', 'id');
    }

    /**
     * @return HasMany
     * @author luffyzhao@vip.126.com
     */
    public function notes()
    {
        return $this->hasMany(OrderNote::class, 'order_id', 'id');
    }

    /**
     * @return BelongsTo
     * @author luffyzhao@vip.126.com
     */
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}