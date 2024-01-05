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

            'name' =>    fake()->name(),


            'order'=>fake()->numberBetween(1,10),
            'parent_id' => fake()->randomElement(Category::query()
                ->pluck('id')->toArray()),
            'image_id' => Medium::factory(),
            'main_image_id' => Medium::factory(),
        ];
    }
}
