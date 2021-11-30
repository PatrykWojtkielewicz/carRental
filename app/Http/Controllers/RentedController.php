<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rent;
use App\Models\Car;
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
        return Rent::all();
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
