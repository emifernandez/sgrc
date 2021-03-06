<?php

namespace App\Http\Requests\Tipo;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoRequest extends FormRequest
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
            'nombre'=>'required|max:60|unique:tipos,nombre,' . $this->tipo . ',tipo,nivel,' . $this->nivel,
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
            'nombre.required' => 'Debe introducir un nombre para el tipo',
            'nombre.max' => 'El nombre del tipo no puede exceder 60 caracteres',
            'nombre.unique' => 'El tipo ingresado ya existe',
        ];
    }
}
