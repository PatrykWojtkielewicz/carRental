<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\RentRequest;
use App\Interfaces\RentInterface;

class RentController extends Controller
{
    protected $rentInterface;

    /**
     * Create a new constructor for this controller
     */
    public function __construct(RentInterface $rentInterface){
        $this->rentInterface = $rentInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return $this->rentInterface->notRented();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RentRequest $request)
    {
        return $this->rentInterface->storeRent($request);
    }
}
