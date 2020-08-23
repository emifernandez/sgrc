<?php

namespace App\Http\Requests\Funcionario;

use Illuminate\Foundation\Http\FormRequest;

class StoreFuncionarioRequest extends FormRequest
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
            'nombres' => 'required|max:60',
            'apellidos' => 'required|max:60',
            'cedula_identidad' => 'required|unique:funcionarios,cedula_identidad',
            'direccion' => 'required|max:80',
            'barrio' => 'required',
            'fecha_nacimiento' => 'required',
            'sexo' => 'required',
            'telefono_principal' => 'required|max:20',
            'profesion' => 'required',
            'cargo' => 'required',
            'especialidad' => 'required',
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
            'nombres.required' => 'Debe introducir un nombre para el funcionario',
            'nombres.max' => 'El nombre del funcionario no puede exceder 60 caracteres',
            'apellidos.required' => 'Debe introducir un apellido para el funcionario',
            'apellidos.max' => 'El apellido del funcionario no puede exceder 60 caracteres',
            'cedula_identidad.required' => 'Debe introducir una cedula de identidad para el funcionario',
            'cedula_identidad.unique' => 'La cedula de identidad ingresada ya existe',
            'direccion.required' => 'Debe introducir una direccion para el funcionario',
            'direccion.max' => 'La direccion del funcionario no puede exceder 80 caracteres',
            'barrio.required' => 'Debe introducir un barrio para el funcionario',
            'fecha_nacimiento.required' => 'Debe introducir una fecha de nacimiento para el funcionario',
            'sexo.required' => 'Debe introducir un sexo para el funcionario',
            'telefono_principal.required' => 'Debe introducir un telefono para el funcionario',
            'telefono_principal.max' => 'El telefono del funcionario no puede exceder 20 caracteres',
            'profesion.required' => 'Debe introducir una profesion para el funcionario',
            'cargo.required' => 'Debe introducir un cargo para el funcionario',
            'especialidad.required' => 'Debe introducir una especialidad para el funcionario',
        ];
    }
}
