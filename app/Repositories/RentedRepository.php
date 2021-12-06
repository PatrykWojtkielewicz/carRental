<?php

namespace App\Repositories;

use App\Http\Requests\RentedRequest;
use App\Interfaces\RentedInterface;
use App\Models\Rent;
use App\Models\Brand;
use App\Models\Car;
use App\Models\User;

class RentedRepository implements RentedInterface
{

    public function getRentals(){
        //select `cars`.`id` as car_id, `users`.`name` as username, `brands`.`name`, `cars`.`model`, `rents`.`rental_date`, `rents`.`return_date` from `rents` inner join `users` on `rents`.`user_id` = `users`.`id` inner join `cars` on `rents`.`car_id` = `cars`.`id` inner join `brands` on `cars`.`brand_id` = `brands`.`id`;
        $rented = Rent::select('cars.id as car_id', 'users.name as username', 'users.id as user_id', 'brands.name', 'cars.model', 'rents.rental_date', 'rents.return_date')
            ->join('users', 'rents.user_id', '=', 'users.id')
            ->join('cars', 'rents.car_id', '=', 'cars.id')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->get();
        return $rented;
    }

    public function updateRental(RentedRequest $request, Rent $rent){
        $carInUse = Rent::where('car_id', '=', $request->car_id)->exists();

        if(!$carInUse){
            $updated = $rent->update([
                'user_id' => $request->user_id,
                'car_id' => $request->car_id,
                'rental_date' => $request->rental_date,
                'return_date' => $request->return_date,
            ]);
            return $updated;
        }
    }

    public function destroyRental(Rent $rent){
        return $rent->delete();
    }
}