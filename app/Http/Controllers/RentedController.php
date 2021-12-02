<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Brand;
use App\Models\Car;
use App\Http\Resources\RentedResource;


class RentedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display currently rented cars
        $rented = Rent::select('cars.id as car_id', 'users.name as username', 'brands.name', 'cars.model', 'rents.rental_date', 'rents.return_date')
            ->join('users', 'rents.user_id', '=', 'users.id')
            ->join('cars', 'rents.car_id', '=', 'cars.id')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->get();

        return response()->json([
            'rented' => RentedResource::collection($rented),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // If argument passed is an id
        if(ctype_digit($id)){
            $rental = Rent::all()->where('car_id', '=', $id);
            return response()->json([
                'rental' => $rental,
            ]);
        }
        // If arugment passed is a string
        else{
            $brand_id = Brand::where('name', 'like', '%'.$id.'%')->value('id');
            $allcars = Car::where('brand_id', '=', $brand_id)->get();
            $cars = [];
            foreach($allcars as $car){
                $exists = Rent::where('rents.car_id', '=', $car->id)->exists();
                if($exists){
                    $rented = Rent::select('cars.id as car_id', 'users.name as username', 'brands.name', 'cars.model', 'rents.rental_date', 'rents.return_date')
                        ->where('rents.car_id', '=', $car->id)
                        ->join('users', 'rents.user_id', '=', 'users.id')
                        ->join('cars', 'rents.car_id', '=', 'cars.id')
                        ->join('brands', 'cars.brand_id', '=', 'brands.id')
                        ->get();
                    array_push($cars, $rented);
                }
            }
            return response()->json([
                'rental' => $cars,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $unavailable = Rent::where('car_id', '=', $request->car_id)->exists();
        $updated = false;

        if(!$unavailable){
            $updated = Rent::where('car_id', '=', $id)->update([
                'car_id' => $request->car_id,
                'rental_date' => $request->rental_date,
                'return_date' => $request->return_date,
            ]);
        }

        return response()->json([
            'car_unavailable' => $unavailable,
            'updated' => $updated,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return response()->json([
            'deleted' => Rent::destroy($id),
        ]);
    }

    /**
     * Search for a name.
     *
     * @param  str $brand
     * @return \Illuminate\Http\Response
     */
    public function search($brand)
    {
        $brand_id = Brand::where('name', 'like', '%'.$brand.'%')->value('id');
        return response()->json([
            'cars' => Rent::where('car_id', 'like', '%'.$brand_id.'%')->get(),
        ]);
    }
}
