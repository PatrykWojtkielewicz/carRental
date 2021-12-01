<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RentedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'tenant' => $this->username,
            'car_name' => $this->name,
            'car_model' => $this->model,
            'rental_date' => $this->rental_date,
            'return_date' => $this->return_date,
        ];
    }
}
