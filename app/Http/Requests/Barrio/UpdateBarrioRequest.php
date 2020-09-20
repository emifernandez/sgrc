<?php

namespace App\Http\Requests\Barrio;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBarrioRequest extends FormRequest
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
        dd($this->barrio);
        return [
            'nombre' => [
                'required',
                'max:60',
                Rule::unique('barrios', 'nombre')
                    ->ignore($this->barrio, 'barrio')
                    ->where(function ($query) {
                        return $query->where('distrito', $this->distrito);
                    })
            ],
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
            'nombre.required' => 'Debe introducir un nombre para el barrio',
            'nombre.max' => 'El nombre del barrio no puede exceder 60 caracteres',
            'nombre.unique' => 'El barrio ingresado ya existe',
        ];
    }
}
