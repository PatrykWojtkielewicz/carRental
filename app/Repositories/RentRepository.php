<?php

namespace App\Repositories;

use App\Http\Requests\RentRequest;
use App\Interfaces\RentInterface;
use Illuminate\Support\Facades\Auth;
use App\Models\Rent;
use App\Models\Car;

class RentRepository implements RentInterface
{
    public function notRented(){
        // Displays not rented cars with their name, instead of id
        $cars = Car::select('cars.id', 'brands.name', 'cars.model', 'cars.year', 'cars.mileage')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->whereNotIn('cars.id', function($query){
                $query->select('car_id')->from('rents');
            })
            ->get();
        
        return ["Available cars for rent", "false", $cars, 200];
    }

    public function storeRent(RentRequest $request){
        $exists = Rent::where('car_id', '=', $request->car_id)->exists();
        if(!$exists){
            $rent = Rent::create([
                'user_id' => auth()->user()->id,
                'car_id' => $request->car_id,
                'rental_date' => $request->rental_date,
                'return_date' => $request->return_date,
            ]);
            return ["Car has been rented", "false", $rent, 200];
        }
        else{
            return ["Car is already rented", "true", null, 403];
        }
    }
}