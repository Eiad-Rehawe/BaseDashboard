<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $socialMedia = [
            ['name' => 'Facebook', 'code' => 'fab fa-facebook'],
            ['name' => 'Twitter', 'code' => 'fab fa-twitter'],
            ['name' => 'Instagram', 'code' => 'fab fa-instagram'],
            ['name' => 'LinkedIn', 'code' => 'fab fa-linkedin'],
            ['name' => 'GitHub', 'code' => 'fab fa-github'],
            ['name' => 'YouTube', 'code' => 'fab fa-youtube'],
            ['name' => 'Phone', 'code' => 'fas fa-phone'],
            ['name' => 'Email', 'code' => 'fas fa-envelope'],
            ['name' => 'WWhatsapp', 'code' => 'fas fa-whatsapp'],
        ];

        DB::table('icons')->insert($socialMedia);
    }
}
