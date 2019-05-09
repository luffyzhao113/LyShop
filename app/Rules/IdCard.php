<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IdCard implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $idcard
     * @return bool
     */
    public function passes($attribute, $idcard)
    {
        // 只能是18位
        if(strlen($idcard)!=18){
            return false;
        }

        $vCity = array(
            '11','12','13','14','15','21','22',
            '23','31','32','33','34','35','36',
            '37','41','42','43','44','45','46',
            '50','51','52','53','54','61','62',
            '63','64','65','71','81','82','91'
        );

        if (!preg_match('/^([\d]{17}[xX\d]|[\d]{15})$/', $idcard)) return false;

        if (!in_array(substr($idcard, 0, 2), $vCity)) return false;

        // 取出本体码
        $idcard_base = substr($idcard, 0, 17);

        // 取出校验码
        $verify_code = substr($idcard, 17, 1);

        // 加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);

        // 校验码对应值
        $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');

        // 根据前17位计算校验码
        $total = 0;
        for($i=0; $i<17; $i++){
            $total += substr($idcard_base, $i, 1)*$factor[$i];
        }

        // 取模
        $mod = $total % 11;

        // 比较校验码
        if($verify_code == $verify_code_list[$mod]){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '身份证号码格式不正确';
    }
}
