<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Car;
use App\Models\Brand;

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
        return Car::select('cars.id', 'brands.name', 'cars.model', 'cars.year', 'cars.mileage')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->whereNotIn('cars.id', function($query){
                $query->select('car_id')->from('rents');
            })
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'car_id' => 'required',
            'rental_date' => 'required',
            'return_date' => 'required',
        ]);
        return Rent::create([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'rental_date' => $request->rental_date,
            'return_date' => $request->return_date,
        ]);
    }
}
