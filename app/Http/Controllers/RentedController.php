<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\RentedRequest;
use Illuminate\Http\Response;
use App\Models\Rent;
use App\Models\Brand;
use App\Models\Car;
use App\Interfaces\RentedInterface;

class RentedController extends Controller
{
    protected $rentedInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(RentedInterface $rentedInterface){
        $this->rentedInterface = $rentedInterface;
    }

    /**
     * Get all rentals
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $data = $this->rentedInterface->getRentals();

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'results' => $data[2],
        ], $data[3]);
    }

    /**
     * Display the specified resource
     * 
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function show(Rent $rent){
        $data = $this->rentedInterface->showRental($rent);

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'results' => $data[2],
        ], $data[3]);
    }

    /**
     * Display the specified resource
     * 
     * @param \App\Http\Requests\RentedRequest $request
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function update(RentedRequest $request, Rent $rent){
        $data = $this->rentedInterface->updateRental($request, $rent);

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'results' => $data[2],
        ], $data[3]);
    }

    /**
     * Display the specified resource
     * 
     * @param \App\Models\Rent $rent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rent $rent){
        $data = $this->rentedInterface->destroyRental($rent);

        return response()->json([
            'message' => $data[0],
            'error' => $data[1],
            'results' => $data[2],
        ], $data[3]);
    }

}
