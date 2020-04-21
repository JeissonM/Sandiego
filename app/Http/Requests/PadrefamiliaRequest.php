<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PadrefamiliaRequest extends FormRequest
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
            'acudiente' => 'required|max:5',
            'personanatural_id' => 'required'
        ];
    }
}
