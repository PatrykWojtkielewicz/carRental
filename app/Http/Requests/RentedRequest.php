<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentedRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'car_id' => 'required|unique:rents,car_id',
            'rental_date' => 'required',
            'return_date' => 'required',
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'car_id.required' => 'ID auta jest wymgane',
            'car_id.unique' => 'Auto jest już wypożyczone',
            'rental_date.required' => 'Data wypożyczenia jest wymagane',
            'return_date.required' => 'Data zwrotu jest wymagana',
        ];
    }
}
