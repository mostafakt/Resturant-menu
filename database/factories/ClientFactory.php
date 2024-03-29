<?php

namespace Database\Factories;

use App\Enums\Client\BloodType;
use App\Enums\Client\Gender;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'user_id' => User::factory(),
            'birth_date' => fake()->dateTime,

        ];
    }
}
