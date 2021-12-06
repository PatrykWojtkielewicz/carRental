<?php

namespace App\Interfaces;

use App\Http\Requests\RentedRequest;
use App\Models\Rent;

interface RentedInterface
{
    /**
     * Get all rentals
     * 
     * @method GET api/rented
     * @access public
     */
    public function getRentals();

    /**
     * Show specified rental
     * 
     * @param \App\Models\Rent $rent
     * @method GET api/rented/{rent}
     * @access public
     */
    public function showRental(Rent $rent);

    /**
     * Update specified rental
     * 
     * @param \App\Http\Requests\RentedRequest $request
     * @param \App\Models\Rent $rent
     * @method PUT api/rented/{rent}
     * @access public
     */
    public function updateRental(RentedRequest $request, Rent $rent);

    /**
     * Destroy specified rental
     * 
     * @param \App\Models\Rent $rent
     * @method DELETE api/rented/{rent}
     * @access public
     */
    public function destroyRental(Rent $rent);
    
}