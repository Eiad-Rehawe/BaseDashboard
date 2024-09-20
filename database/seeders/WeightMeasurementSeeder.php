<?php

namespace Database\Seeders;

use App\Models\WeightMeasurement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeightMeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $array=[
            [
            'name_en'=>'Kg',
            'name_ar'=>'كيلو جرام',
            ],
          
            [
            'name_en'=>'Gram',
            'name_ar'=>'جرام',
             ],
           
            ];
            foreach( $array as $arr){
                WeightMeasurement::create($arr);
            }
       
    }
}
