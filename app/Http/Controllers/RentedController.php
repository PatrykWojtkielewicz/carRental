<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
            'status' => true,
            'rented' => RentedResource::collection($rented),
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent)
    {
        return response()->json([
            'status' => true,
            'rental' => $rent,
        ], Response::HTTP_OK);

        //* Code below makes possible showing cars also by their brand
        /* // If argument passed is an id
        if(ctype_digit($id)){
            $rental = Rent::all()->where('car_id', '=', $id);
            return response()->json([
                'status' => true,
                'rental' => $rental,
            ], Response::HTTP_OK);
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
                'status' => true,
                'rental' => $cars,
            ], Response::HTTP_OK);
        } */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rent $rent)
    {
        $carInUse = Rent::where('car_id', '=', $request->car_id)->exists();

        if(!$carInUse){
            $rent->update([
                'car_id' => $request->car_id,
                'rental_date' => $request->rental_date,
                'return_date' => $request->return_date,
            ]);
            return response()->json([
                'status' => true,
                'car_unavailable' => false,
                'updated' => true,
            ], Response::HTTP_CREATED);
        }
        else{
            return response()->json([
                'status' => false,
                'car_unavailable' => true,
                'updated' => false,
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent)
    {
        return response()->json([
            'status' => true,
            'deleted' => $rent->delete(),
        ], Response::HTTP_OK);
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
            'status' => true,
            'cars' => Rent::where('car_id', 'like', '%'.$brand_id.'%')->get(),
        ], Response::HTTP_OK);
    }
}
