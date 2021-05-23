<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'clave_actual' => 'required',
            'clave' => 'required|confirmed',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'clave_actual.required' => 'Debe introducir la contraseña actual',
            'clave.required' => 'Debe introducir una contraseña para el usuario',
            'clave.confirmed' => 'La confirmación de contraseña no coincide',
        ];
    }
}
