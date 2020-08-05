<?php

namespace App\Http\Requests\EspecialidadMedica;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEspecialidadMedicaRequest extends FormRequest
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
            'nombre'=>'required|max:60|unique:especialidades_medicas,nombre,' . $this->especialidad->especialidad . ',especialidad',
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
            'nombre.required' => 'Debe introducir un nombre para la especialidad',
            'nombre.max' => 'El nombre de la especialidad no puede exceder 60 caracteres',
            'nombre.unique' => 'La especialidad ingresada ya existe',
        ];
    }
}
