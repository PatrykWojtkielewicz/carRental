<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    private function UniqueTags($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start_year = 1970;
        for($i=0; $i<10; $i++){
            $ut = $this->UniqueTags(1,10,3);
            Car::create([
                'brand_id' => $ut[0],
                'model' => 'model'.($i+1),
                'year' => $start_year,
                'mileage' => rand(100000, 200000),
            ]);
            Car::create([
                'brand_id' => $ut[1],
                'model' => 'model'.($i+1),
                'year' => ($start_year+1),
                'mileage' => rand(100000, 200000),
            ]);
            Car::create([
                'brand_id' => $ut[2],
                'model' => 'model'.($i+1),
                'year' => ($start_year+2),
                'mileage' => rand(100000, 200000),
            ]);
            $start_year+=3;
        }
    }
}
