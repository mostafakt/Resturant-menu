<?php

namespace Database\Factories;

use App\Enums\Client\Gender;
use App\Enums\User\UserStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'mobile' => fake()->phoneNumber,
            'phone' => fake()->phoneNumber,
            'gender' => fake()->randomElement(Gender::values()),
            'status' => fake()->randomElement(UserStatus::values()),
            'note' => [
                'en' => fake()->sentence,
                'ar' => fake()->sentence,
            ],
//            'image_id' => Medium::factory(),
            'email' => fake()->unique()->safeEmail(),
            'password' => 'password',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
