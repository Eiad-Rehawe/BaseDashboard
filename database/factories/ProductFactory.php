<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\WeightMeasurement;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'wight'=>fake()->numberBetween(5,10),
            'weight_measurement_id'=>WeightMeasurement::select('id')->inRandomOrder()->first()->id,
            'category_id'=>Category::select('id')->inRandomOrder()->first()->id,
            'status'=>rand(0,1),
            'purchasing_price'=>fake()->numberBetween($min = 5000, $max = 100000),
            'selling_price'=>fake()->numberBetween($min = 6000, $max = 100000),
            'new_selling_price'=>fake()->numberBetween($min = 1000, $max = 10000),
            'quantity'=>fake()->numberBetween(10,20),
            'descrption_ar'=>fake()->paragraph(),
            'descrption_en'=>fake()->paragraph()
        ];
    }
}
