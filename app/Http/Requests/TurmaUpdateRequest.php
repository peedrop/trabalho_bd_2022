<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurmaUpdateRequest extends FormRequest
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
            'disciplina_id' => ['required', 'exists:disciplina,id'],
            'professor_id' => ['required', 'exists:professor,id'],
            'codigo' => ['required', 'max:255', 'string'],
        ];
    }
}
