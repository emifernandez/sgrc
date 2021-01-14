<?php

namespace App\Http\Requests\ServicioMedico;

use Illuminate\Foundation\Http\FormRequest;

class StoreServicioMedicoRequest extends FormRequest
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
            'nombre' => 'required|max:60|unique:servicios_medicos,nombre',
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
            'nombre.required' => 'Debe introducir un nombre para el servicio medico',
            'nombre.max' => 'El nombre del servicio medico no puede exceder 60 caracteres',
            'nombre.unique' => 'El nombre ingresado ya existe',
        ];
    }
}
