<?php

namespace App\Http\Requests\Admision;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdmisionRequest extends FormRequest
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
            'establecimiento'   => 'required',
            'paciente'          => 'required',
            'fecha_admision'    => 'required',
            'especialidad'      => 'required',
            'profesional'       => 'required',
            'servicio'          => 'required',
            'usuario'           => 'max:20',
            'fecha_registro'    => 'required',
            'estado'            => 'required',
            'prioridad'         => 'required',
            'observacion'       => 'max:300',
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
            'establecimiento.required' => 'Debe introducir un establecimiento para la admisión',
            'paciente.required' => 'Debe introducir un paciente para la admisión',
            'fecha_admision.required' => 'Debe introducir una fecha para la admisión',
            'especialidad.required' => 'Debe introducir una especialidad para la admisión',
            'profesional.required' => 'Debe introducir un profesional para la admisión',
            'servicio.required' => 'Debe introducir un servicio para la admisión',
            'usuario.required' => 'Debe introducir un usuario para la admisión',
            'usuario.max' => 'El usuario de admisión no puede exceder 20 caracteres',
            'fecha_registro.required' => 'Debe introducir una fecha de registro para la admisión',
            'estado.required' => 'Debe introducir un estado para la admisión',
            'prioridad.required' => 'Debe introducir una prioridad para la admisión',
            'observacion.max' => 'La observación de admisión no puede exceder 300 caracteres',
        ];
    }
}
