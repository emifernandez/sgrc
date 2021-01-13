<?php

namespace App\Http\Requests\Motivo;

use Illuminate\Foundation\Http\FormRequest;

class StoreMotivoRequest extends FormRequest
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
            'descripcion' => 'required|max:60|unique:motivos,descripcion',
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
            'descripcion.required' => 'Debe introducir una descripcion para el Motivo',
            'descripcion.max' => 'La descripcion del Motivo no puede exceder 60 caracteres',
            'descripcion.unique' => 'El Motivo ingresado ya existe',
        ];
    }
}
