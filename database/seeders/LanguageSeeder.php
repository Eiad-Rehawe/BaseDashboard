<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arr = [
            ['short_name' => 'ar',
                'name' => 'Arabic',
                'direction' => 'rtl',
            ],
            ['short_name' => 'en',
                'name' => 'English',
                'direction' => 'ltr',
            ],
        ];
        foreach($arr as $a){
            Language::create($a);
        }
        
    }
}
