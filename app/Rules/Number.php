<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Number implements Rule
{
    private $floatLength;

    /**
     * Create a new rule instance.
     *
     * @param int $floatLength 小数位数
     */
    public function __construct(int $floatLength = 0)
    {
        $this->floatLength = $floatLength;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $temp = explode('.', $value);

        $count = 0;
        if(count($temp) === 2){
            $count = strlen(end($temp));
        }else if(count($temp) > 2){
            return false;
        }

        return $count <= $this->floatLength;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute 最多只能' . $this->floatLength . '位小数';
    }
}
