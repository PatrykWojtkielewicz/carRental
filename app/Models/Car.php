<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Car extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = ['brand_id','model','year','mileage'];
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function rent(){
        return $this->hasOne(Rent::class);
    }
}
