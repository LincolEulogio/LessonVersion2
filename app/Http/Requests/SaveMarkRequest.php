<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SaveMarkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('promedio_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'examID' => 'required',
            'classesID' => 'required',
            'subjectID' => 'required',
            'sectionID' => 'required',
            'inputs' => 'required|array',
            'inputs.*.mark' => 'required|string',
            'inputs.*.value' => 'nullable|numeric|min:0|max:20',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'examID.required' => 'El examen es obligatorio.',
            'classesID.required' => 'La clase es obligatoria.',
            'subjectID.required' => 'La materia es obligatoria.',
            'inputs.required' => 'No se han enviado calificaciones.',
        ];
    }
}
