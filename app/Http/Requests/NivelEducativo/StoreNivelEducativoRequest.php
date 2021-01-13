<?php

namespace App\Http\Requests\NivelEducativo;

use Illuminate\Foundation\Http\FormRequest;

class StoreNivelEducativoRequest extends FormRequest
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
            'nombre' => 'required|max:60|unique:niveles_educativos,nombre',
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
            'nombre.required' => 'Debe introducir un nombre para el Nivel Educativo',
            'nombre.max' => 'El nombre del Nivel Educativo no puede exceder 60 caracteres',
            'nombre.unique' => 'El Nivel Educativo ingresado ya existe',
        ];
    }
}
