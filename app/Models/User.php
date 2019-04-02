<?php
/**
 *
 * Author: luffyzhao@vip.126.com
 * DateTime: 2019/3/26 10:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['department_id', 'name', 'phone', 'email', 'password', 'birthday', 'entryday', 'sex', 'status'];

    protected $hidden = [
        'password'
    ];

    protected $attributes = [
        'birthday' => '1970-01-01',
        'entryday' => '1970-01-01',
        'sex' => 'women',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/28 19:51
     */
    public function roles(){
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    /**
     * @param $value
     * @author: luffyzhao@vip.126.com
     * @datetime: 2019/3/29 19:48
     */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}