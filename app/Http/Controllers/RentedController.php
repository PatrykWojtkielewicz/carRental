<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Brand;


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
        return Rent::select('users.name as Tenant', 'brands.name as Car', 'cars.model as Model', 'rents.rental_date', 'rents.return_date')
            ->join('users', 'rents.user_id', '=', 'users.id')
            ->join('cars', 'rents.car_id', '=', 'cars.id')
            ->join('brands', 'cars.brand_id', '=', 'brands.id')
            ->get(['users.name as Tenant', 'brands.name as Car', 'cars.model as Model']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Rent::find($id);
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
        $rent = Rent::find($id);
        $rent->update($request->all());
        return $rent;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Rent::destroy($id);
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
        return Rent::where('car_id', 'like', '%'.$brand_id.'%')->get();
    }
}
