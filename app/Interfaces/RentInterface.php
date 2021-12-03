<?php

namespace App\Interfaces;

use App\Http\Requests\RentRequest;

interface RentInterface
{
    /**
     * Display a listing of the resource.
     * 
     * @method GET api/rent
     * @access public
     */
    public function notRented();

    /**
     * Store new rental
     * 
     * @param  \Illuminate\Http\RentRequest  $request
     * @method POST api/rent
     * @access public
     */
    public function storeRent(RentRequest $request);
}