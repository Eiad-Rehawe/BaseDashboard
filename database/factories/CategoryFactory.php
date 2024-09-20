<?php

namespace Database\Factories;

use App\Models\Category;
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
    public function definition(): array
    {
        return [
            'name_ar'=>fake()->city(),
            'name_en'=>fake()->city(),
            'parent_id'=>Category::select('id')->inRandomOrder()->first()->id,
            'status'=>rand(0,1),
        ];
    }
}
