<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Factories\CategoryFactory;
use Database\Factories\FileCategoryFactory;
use Database\Factories\FileProductFactory;
use Database\Factories\ProductFactory;
use Database\Seeders\AdminSeeder;
use Database\Seeders\IconsSeeder;
use Database\Seeders\WeightMeasurementSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();
        \App\Models\Category::factory(10)->create();
        \App\Models\File::factory(20)->create();
        \App\Models\Product::factory(20)->create();
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            PermessionSeeder::class,
            AdminSeeder::class,
            LanguageSeeder::class,
            IconsSeeder::class,
            WeightMeasurementSeeder::class
          
        ]);
    }
}
