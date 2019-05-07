<?php
/**
 * Created by PhpStorm.
 * User: luffy
 * Date: 2019/4/30
 * Time: 9:40
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    protected $fillable = ['name', 'values', 'description', 'type'];


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