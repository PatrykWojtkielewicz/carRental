<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Rent;
use App\Http\Resources\RentedResource;

class OverdueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display currently rented cars
        $overdued = Rent::select('cars.id as car_id', 'users.name as username', 'brands.name', 'cars.model', 'rents.rental_date', 'rents.return_date')
        ->join('users', 'rents.user_id', '=', 'users.id')
        ->join('cars', 'rents.car_id', '=', 'cars.id')
        ->join('brands', 'cars.brand_id', '=', 'brands.id')
        ->where('rents.return_date', '<', date('Y-m-d'))
        ->get();

        return response()->json([
            'status' => true,
            'overdued' => RentedResource::collection($overdued),
        ]);
    }
}
