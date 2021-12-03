<?php

namespace App\Repositories;

use App\Http\Requests\RentRequest;
use App\Interfaces\RentInterface;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Models\Rent;
use App\Models\Car;

class RentRepository implements RentInterface
{
    use ResponseTrait;

    public function notRented(){
        try{
            // Displays not rented cars with their name, instead of id
            $cars = Car::select('cars.id', 'brands.name', 'cars.model', 'cars.year', 'cars.mileage')
                ->join('brands', 'cars.brand_id', '=', 'brands.id')
                ->whereNotIn('cars.id', function($query){
                    $query->select('car_id')->from('rents');
                })
                ->get();
            
            return $this->success("Available cars", $cars);
        }
        catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }

    public function storeRent(RentRequest $request){
        try{
            $exists = Rent::where('car_id', '=', $request->car_id)->exists();
            if(!$exists){
                $rent = Rent::create([
                    'user_id' => auth()->user()->id,
                    'car_id' => $request->car_id,
                    'rental_date' => $request->rental_date,
                    'return_date' => $request->return_date,
                ]);
                return $this->success("Car rented", $rent);
            }
            else{
                return $this->error("Car is already rented", 403);
            }
        }
        catch(\Exception $e){
            return $this->error($e->getMessage(), $e->getCode());
        }
    }
}