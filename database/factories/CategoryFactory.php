<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Medium;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'name' => fake()->name(),
            'order' => 0,

            'image_id' => Medium::factory(),
            'discount_value' => fake()->numberBetween(0, 99),
            'main_image_id' => Medium::factory(),
        ];
    }
}
