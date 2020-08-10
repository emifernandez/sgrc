<?php

namespace App\Http\Requests\Profesion;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfesionRequest extends FormRequest
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
            'nombre'=>'required|max:60|unique:profesiones,nombre',
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
            'nombre.required' => 'Debe introducir un nombre para la profesion',
            'nombre.max' => 'El nombre de la profesion no puede exceder 60 caracteres',
            'nombre.unique' => 'La profesion ingresada ya existe',
        ];
    }
}
