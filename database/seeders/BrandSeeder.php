<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = ['Volkswagen','Skoda','BMW','Fiat','Chevrolet','Cadillac','Bugatti','Jaguar','Jeep','Kia'];
        for($i=0; $i<10; $i++){
            Brand::create([
                'name' => $brands[$i],
            ]);
        }
    }
}
