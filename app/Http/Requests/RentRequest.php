<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentRequest extends FormRequest
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
            'user_id' => 'required',
            'car_id' => 'required',
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
            'user_id.required' => 'ID użytkownika jest wymagane jest wymagane',
            'car_id.required' => 'ID auta jest wymagane jest wymagane',
            'rental_date.required' => 'Data wyjnajęcia jest wymagana',
            'return_date.required' => 'Data zwrotu jest wymagana',
        ];
    }
}
