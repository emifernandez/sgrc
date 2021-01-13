<?php

namespace App\Http\Requests\Seguro;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSeguroRequest extends FormRequest
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
            'nombre' => 'required|max:60|unique:seguros,nombre,' . $this->seguro->seguro . ',seguro',
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
            'nombre.required' => 'Debe introducir un nombre para el Seguro',
            'nombre.max' => 'El nombre del Seguro no puede exceder 60 caracteres',
            'nombre.unique' => 'El Seguro ingresado ya existe',
        ];
    }
}
