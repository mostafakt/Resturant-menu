<?php

namespace App\Rules;

use App\Enums\Language\Language;
use Illuminate\Contracts\Validation\Rule;

class TranslationValidator implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!is_array($value)) {
            return false;
        }

        $validLanguages = Language::values();
        $languages = array_keys($value);

        if (count($validLanguages) != count($languages) || array_diff($validLanguages, $languages))
            return false;

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Invalid language code');
    }
}
