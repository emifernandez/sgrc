<?php

namespace App\Http\Requests\NivelAtencion;

use Illuminate\Foundation\Http\FormRequest;

class StoreNivelAtencionRequest extends FormRequest
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
            'nombre'=>'required|max:60|unique:niveles_atencion,nombre',
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
            'nombre.required' => 'Debe introducir un nombre para el nivel de atención',
            'nombre.max' => 'El nombre del nivel de atención no puede exceder 60 caracteres',
            'nombre.unique' => 'El nivel de atención ingresado ya existe',
        ];
    }
}
