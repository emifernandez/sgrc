<?php

namespace App\Http\Requests\Cargo;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCargoRequest extends FormRequest
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
            'nombre'=>'required|max:60|unique:cargos,nombre,' . $this->cargo->cargo . ',cargo',
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
            'nombre.required' => 'Debe introducir un nombre para el cargo',
            'nombre.max' => 'El nombre del cargo no puede exceder 60 caracteres',
            'nombre.unique' => 'El cargo ingresado ya existe',
        ];
    }
}
