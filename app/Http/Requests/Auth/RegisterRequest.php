<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
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
            'name.required' => 'Imie jest wymagane',
            'name.string' => 'Imie nie jest ciągiem znaków',
            'surname.required' => 'Nazwisko nie jest ciągiem znaków',
            'surname.string' => 'Nazwisko nie jest ciągiem znaków',
            'email.required' => 'E-mail jest wymagany',
            'email.string' => 'E-mail nie jest ciągiem znaków',
            'email.unique' => 'Ten e-mail jest już używany',
            'password.required' => 'Hasło jest wymagane',
            'password.string' => 'Hasło nie jest ciągiem znaków',
            'password.confirmed' => 'Podane hasła się nie zgadzają',
        ];
    }
}
