<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonanaturalRequest extends FormRequest
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
            'numero_documento' => 'required|max:15',
            'primer_nombre' => 'required|max:50',
            'primer_apellido' => 'required|max:50',
            'sexo' => 'required|max:1',
            'tipodoc_id' => 'required'
        ];
    }
}
