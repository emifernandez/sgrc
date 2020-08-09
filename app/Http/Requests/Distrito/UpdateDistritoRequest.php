<?php

namespace App\Http\Requests\Distrito;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDistritoRequest extends FormRequest
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
            'nombre'=>['required',
                        'max:60',
                        Rule::unique('distritos', 'nombre')
                            ->ignore($this->distrito, 'distrito')
                            ->where(function ($query) {
                                return $query->where('region', $this->region);
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
            'nombre.required' => 'Debe introducir un nombre para el distrito',
            'nombre.max' => 'El nombre de distrito no puede exceder 60 caracteres',
            'nombre.unique' => 'El distrito ingresado ya existe',
        ];
    }
}
