<?php

namespace App\Http\Requests\Enfermedad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnfermedadRequest extends FormRequest
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
            'codigo' => 'required|max:10|unique:enfermedades,codigo,' . $this->enfermedad->enfermedad . ',enfermedad',
            'descripcion' => 'required|max:300|unique:enfermedades,descripcion,' . $this->enfermedad->enfermedad . ',enfermedad',
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
            'codigo.required' => 'Debe introducir un codigo para la enfermedad',
            'codigo.max' => 'El codigo de la enfermedad no puede exceder 10 caracteres',
            'codigo.unique' => 'La enfermedad ingresada ya existe',
            'descripcion.required' => 'Debe introducir una descripcion para la enfermedad',
            'descripcion.max' => 'La descripcion de la enfermedad no puede exceder 300 caracteres',
            'descripcion.unique' => 'La enfermedad ingresada ya existe',
        ];
    }
}
