<?php

namespace App\Http\Requests\Permiso;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermisoRequest extends FormRequest
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
            'perfil' => 'required|unique:permisos,perfil,' . $this->permiso->permiso . ',permiso'
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
            'perfil.required' => 'Debe introducir un perfil para el permiso',
            'perfil.unique' => 'El perfil ingresado ya se encuentra asociado a otro permiso',
        ];
    }
}
