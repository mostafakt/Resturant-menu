<?php

namespace Database\Factories;

use App\Enums\Medium\MediumFor;
use App\Enums\Medium\MediumType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medium>
 */
class MediumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'path' => $this->faker->filePath(),
            'extension' => 'jpg',
            'type' => MediumType::Image,
            'for' => $this->faker->randomElement(MediumFor::values()),
        ];
    }
}
