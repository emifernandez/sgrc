<?php

namespace App\Http\Requests\Nacionalidad;

use Illuminate\Foundation\Http\FormRequest;

class StoreNacionalidadRequest extends FormRequest
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
            'nombre'=>'required|max:60|unique:nacionalidades,nombre',
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
            'nombre.required' => 'Debe introducir un nombre para la Nacionalidad',
            'nombre.max' => 'El nombre de la Nacionalidad no puede exceder 60 caracteres',
            'nombre.unique' => 'La Nacionalidad ingresada ya existe',
        ];
    }
}
