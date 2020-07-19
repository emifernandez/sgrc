<?php

namespace App\Http\Requests\Establecimiento;

use Illuminate\Foundation\Http\FormRequest;

class StoreEstablecimientoRequest extends FormRequest
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
            'codigo' => 'required|max:3',
            'nombre' => 'required|max:60',
            'tipo' => 'required',
            'red' => 'required',
            'ubicacion' => 'required|max:60',
            'barrio' => 'required',
            'telefono1' => 'required|max:20',
            //'estado' => 'required',
            'orden' => 'required',
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
            'codigo.required' => 'Debe introducir un codigo para el establecimiento',
            'codigo.max' => 'El codigo del establecimiento no puede exceder 3 caracteres',
            'nombre.required' => 'Debe introducir un nombre para el establecimiento',
            'nombre.max' => 'El nombre del establecimiento no puede exceder 60 caracteres',
            'tipo.required' => 'Debe introducir un tipo para el establecimiento',
            'red.required' => 'Debe introducir una red para el establecimiento',
            'ubicacion.required' => 'Debe introducir una ubicacion para el establecimiento',
            'ubicacion.max' => 'La ubicacion del establecimiento no puede exceder 60 caracteres',
            'barrio.required' => 'Debe introducir un barrio para el establecimiento',
            'telefono1.required' => 'Debe introducir un telefono para el establecimiento',
            'telefono1.max' => 'El telefono del establecimiento no puede exceder 20 caracteres',
            //'estado.required' => 'Debe introducir un estado para el establecimiento',
            'orden.required' => 'Debe introducir un orden para el establecimiento',
        ];
    }
}
