<?php

namespace App\Http\Requests\HorarioAtencion;

use Illuminate\Foundation\Http\FormRequest;

class StoreHorarioAtencionRequest extends FormRequest
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
            'establecimiento' => 'required',
            'especialidad' => 'required',
            'funcionario' => 'required',
            'dia' => 'required',
            'hora_desde' => 'required',
            'hora_hasta' => 'required',
            'observacion' => 'max:300',
            'capacidad_atencion' => 'required|numeric|gte:0',
            'uso_atencion' => 'required|numeric|gte:0|lte:capacidad_atencion'
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
            'establecimiento.required' => 'Debe introducir un establecimiento para el horario de atención',
            'especialidad.required' => 'Debe introducir una especialidad para el horario de atención',
            'funcionario.required' => 'Debe introducir un funcionario para el horario de atención',
            'dia.required' => 'Debe introducir un día para el horario de atención',
            'hora_desde.required' => 'Debe introducir una hora desde para el horario de atención',
            'hora_hasta.required' => 'Debe introducir una hora hasta para el horario de atención',
            'observacion.max' => 'La observación del horario de atención no puede exceder 300 caracteres',
            'capacidad_atencion.required' => 'Debe introducir una capacidad de atención para el horario',
            'capacidad_atencion.numeric' => 'La capacidad de atención debe ser un valor numérico',
            'capacidad_atencion.gte' => 'La capacidad de atención debe ser mayor o igual a cero',
            'uso_atencion.required' => 'Debe introducir un uso de atención para el horario',
            'uso_atencion.numeric' => 'El uso de atención debe ser un valor numérico',
            'uso_atencion.gte' => 'El uso de atención debe ser mayor o igual a cero',
            'uso_atencion.lte' => 'El uso de atención no puede ser mayor a la capacidad de atención',
        ];
    }
}
