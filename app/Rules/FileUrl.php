<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileUrl implements Rule
{
    private $extensions;

    /**
     * Create a new rule instance.
     *
     * @param array $extensions
     */
    public function __construct(array $extensions)
    {
        $this->extensions = $extensions;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $extension = pathinfo($value, PATHINFO_EXTENSION);
        return in_array($extension, $this->extensions);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute 文件格式不正确,只支持' . implode(',', $this->extensions) . '格式';
    }
}
