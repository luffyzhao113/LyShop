<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/5/7
 * Time: 19:28
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GoodsAttribute extends Model
{
    protected $fillable = ['goods_id', 'name', 'values'];

    /**
     * setValuesAttribute
     * @param array $values
     * @author luffyzhao@vip.126.com
     */
    protected function setValuesAttribute(array $values)
    {
        $this->attributes['values'] = implode(',', $values);
    }

    /**
     * getValuesAttribute
     * @author luffyzhao@vip.126.com
     * @return array
     */
    protected function getValuesAttribute(){
        return explode(',', $this->attributes['values']);
    }
}