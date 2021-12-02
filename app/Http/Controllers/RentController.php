<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\RentRequest;
use App\Models\Rent;
use App\Models\Car;

class RentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Displays not rented cars with their name, instead of id
        $cars = Car::select('cars.id', 'brands.name', 'cars.model', 'cars.year', 'cars.mileage')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->whereNotIn('cars.id', function($query){
                $query->select('car_id')->from('rents');
            })
            ->get();

        return response()->json([
            'status' => true,
            'cars' => $cars,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RentRequest $request)
    {
        $exists = Rent::where('car_id', '=', $request->car_id)->exists();
        if(!$exists){
            $rent = Rent::create([
                'user_id' => auth()->user()->id,
                'car_id' => $request->car_id,
                'rental_date' => $request->rental_date,
                'return_date' => $request->return_date,
            ]);
            return response()->json([
                'status' => true,
                'rent' => $rent,
            ], Response::HTTP_CREATED);
        }
        else{
            return response()->json([
                'status' => true,
                'message' => 'Auto jest już wynajęte'
            ], Response::HTTP_FORBIDDEN);
        }
    }
}
