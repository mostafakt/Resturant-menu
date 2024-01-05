<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueNameCombinationRule implements Rule
{

    protected string $firstName;
    protected string $lastName;
    protected int|null $currentUserId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($firstName, $lastName,$currentUserId = null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->currentUserId = $currentUserId;
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
        // Check the uniqueness in the database table
        $query = DB::table('users')
            ->where('first_name', $this->firstName)
            ->where('last_name', $this->lastName)
            ->whereNull('deleted_at');
        // If a current user ID is provided, exclude that user
        if ($this->currentUserId !== null) {
            $query->where('id', '!=', $this->currentUserId);
        }

        $count = $query->count();

        return $count === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The combination of first name and last name is not unique.';
    }
}
