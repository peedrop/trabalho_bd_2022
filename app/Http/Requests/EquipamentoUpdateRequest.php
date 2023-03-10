<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipamentoUpdateRequest extends FormRequest
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
            'nome' => ['required', 'max:255', 'string'],
            'sala_id' => ['required', 'exists:sala,id'],
            'num_serie' => ['required', 'max:255', 'string'],
        ];
    }
}
