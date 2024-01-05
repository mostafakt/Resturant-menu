<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueProductIds implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // Ensure the value is an array
        if (!is_array($value)) {
            return false;
        }

        // Get the unique product IDs
        $uniqueProductIds = array_unique(array_column($value, 'id'));

        // Check if the count of unique product IDs is the same as the total count
        return count($uniqueProductIds) === count($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The product IDs in the orderProducts array must be unique.';
    }
}
