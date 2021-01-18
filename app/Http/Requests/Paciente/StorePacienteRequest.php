<?php

namespace App\Http\Requests\Paciente;

use Illuminate\Foundation\Http\FormRequest;

class StorePacienteRequest extends FormRequest
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
            'fecha_ingreso'     => 'required',
            'tipo_documento'    => 'required',
            'numero_documento'  => 'required|max:10|unique:pacientes,numero_documento',
            'nombres'           => 'required|max:80',
            'fecha_nacimiento'  => 'required',
            'sexo'              => 'required',
            'lugar_nacimiento'  => 'required|max:80',
            'tipo_lugar'        => 'required',
            'nacionalidad'      => 'required',
            'etnia'             => 'required',
            'nombre_etnia'      => 'max:60',
            'estado_civil'      => 'required',
            'barrio'            => 'required',
            'area'              => 'required',
            'sector'            => 'max:20',
            'manzana'           => 'max:10',
            'direccion'         => 'max:150',
            'nro_casa'          => 'max:10',
            'referencia'        => 'max:60',
            'telefono'          => 'required|max:20',
            'correo_electronico' => 'max:80',
            'nivel_educativo'   => 'required',
            'seguro'            => 'required',
            'profesion'         => 'required',
            'situacion_laboral' => 'required',
            'ocupacion'         => 'max:60',
            'nombre_padre'      => 'max:60',
            'nombre_madre'      => 'max:60',
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
            'establecimiento.required' => 'Debe introducir un establecimiento para el paciente',
            'fecha_ingreso.required' => 'Debe introducir una fecha de ingreso para el paciente',
            'tipo_documento.required' => 'Debe introducir un tipo de documento para el paciente',
            'numero_documento.required' => 'Debe introducir un numero de documento para el paciente',
            'numero_documento.max' => 'El numero de documento del paciente no puede exceder 10 caracteres',
            'numero_documento.unique' => 'El numero de documento ingresado ya existe',
            'nombres.required' => 'Debe introducir un nombre y apellido para el paciente',
            'nombres.max' => 'El nombre del paciente no puede exceder 80 caracteres',
            'fecha_nacimiento.required' => 'Debe introducir una fecha de nacimiento para el paciente',
            'sexo.required' => 'Debe introducir un sexo para el paciente',
            'lugar_nacimiento.required' => 'Debe introducir un lugar de nacimiento para el paciente',
            'lugar_nacimiento.max' => 'El lugar de nacimiento del paciente no puede exceder 80 caracteres',
            'tipo_lugar.required' => 'Debe introducir un tipo de lugar para el paciente',
            'nacionalidad.required' => 'Debe introducir una nacionalidad para el paciente',
            'etnia.required' => 'Debe introducir una etnia para el paciente',
            'nombres_etnia.max' => 'El nombre de etnia del paciente no puede exceder 60 caracteres',
            'estado_civil.required' => 'Debe introducir un estado civil para el paciente',
            'barrio.required' => 'Debe introducir un barrio para el paciente',
            'area.required' => 'Debe introducir una area para el paciente',
            'sector.max' => 'El sector del paciente no puede exceder 20 caracteres',
            'manzana.max' => 'La manzana del paciente no puede exceder 10 caracteres',
            'direccion.max' => 'La direccion del paciente no puede exceder 150 caracteres',
            'nro_casa.max' => 'El numero de casa del paciente no puede exceder 10 caracteres',
            'referencia.max' => 'La referencia del paciente no puede exceder 60 caracteres',
            'telefono.required' => 'Debe introducir un telefono para el paciente',
            'telefono.max' => 'El telefono del paciente no puede exceder 20 caracteres',
            'correo_electronico.max' => 'El correo electronico del paciente no puede exceder 80 caracteres',
            'nivel_educativo.required' => 'Debe introducir un nivel educativo para el paciente',
            'seguro.required' => 'Debe introducir un seguro para el paciente',
            'profesion.required' => 'Debe introducir una profesion para el paciente',
            'situacion_laboral.required' => 'Debe introducir una situacion laboral para el paciente',
            'ocupacion.max' => 'La ocupacion del paciente no puede exceder 60 caracteres',
            'nombre_padre.max' => 'El nombre del padre del paciente no puede exceder 60 caracteres',
            'nombre_madre.max' => 'El nombre de la madre del paciente no puede exceder 60 caracteres',
        ];
    }
}
