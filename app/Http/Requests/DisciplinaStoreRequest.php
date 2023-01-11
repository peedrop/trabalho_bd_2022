<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DisciplinaStoreRequest extends FormRequest
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
            'curso_id' => ['required', 'exists:curso,id'],
            'departamento_id' => ['required', 'exists:departamento,id'],
            'nome' => ['required', 'max:255', 'string'],
            'codigo' => ['required', 'max:255', 'string'],
        ];
    }
}
