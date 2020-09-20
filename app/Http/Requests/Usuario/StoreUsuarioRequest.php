<?php

namespace App\Http\Requests\Usuario;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
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
            'usuario' => 'required|unique:usuarios,usuario',
            'funcionario' => 'required|unique:usuarios,funcionario',
            'clave' => 'required|confirmed',
            'fecha_registro' => 'required|date_format:d-m-Y',
            'fecha_validez' => 'required|date_format:d-m-Y',
            'perfil' => 'required',
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
            'usuario.required' => 'Debe introducir el usuario',
            'usuario.unique' => 'El usuario ingresado ya existe',
            'funcionario.required' => 'Debe introducir un funcionario para el usuario',
            'funcionario.unique' => 'El usuario ingresado ya se encuentra asociado a otro usuario',
            'clave.required' => 'Debe introducir una contraseña para el usuario',
            'clave.confirmed' => 'La confirmación de contraseña no coincide',
            'fecha_registro.required' => 'Debe introducir una fecha de registro para el usuario',
            'fecha_validez.required' => 'Debe introducir una fecha de validez para el usuario',
            'fecha_registro.date_format' => 'Debe introducir correctamente el formato',
            'fecha_validez.date_format' => 'Debe introducir correctamente el formato',
            'perfil.required' => 'Debe introducir un perfil para el usuario',
        ];
    }
}
