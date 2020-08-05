<?php

namespace App\Http\Requests\Region;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegionRequest extends FormRequest
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
            'nombre'=>'required|max:60|unique:regiones,nombre',
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
            'nombre.required' => 'Debe introducir un nombre para la Region Sanitaria',
            'nombre.max' => 'El nombre de la Region Sanitaria no puede exceder 60 caracteres',
            'nombre.unique' => 'El nombre de la Region Sanitaria ya se encuentra registrada',
        ];
    }
}
