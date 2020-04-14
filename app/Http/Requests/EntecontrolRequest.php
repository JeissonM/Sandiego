<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntecontrolRequest extends FormRequest
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
            'razonsocial' => 'required|max:100',
            'representantelegal' => 'required|max:80',
            'tipodoc_id' => 'required'
        ];
    }
}
