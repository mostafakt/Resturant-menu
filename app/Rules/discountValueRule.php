<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class discountValueRule implements Rule
{

    protected $type;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->type == 1) {
            return is_numeric($value);
        }

        if ($this->type == 2) {
            $isNumeric = is_numeric($value);
            $max = $value <= 100;
            return $isNumeric && $max;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if ($this->type == 1) {
            return 'discountValue must be a numeric.';
        }

        if ($this->type == 2) {
            return 'discountValue must be a numeric and small than 100.';
        }
    }
}
