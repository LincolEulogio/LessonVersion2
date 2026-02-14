<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreGradeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('grado_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'grade' => 'required|string|max:60',
            'point' => 'required|string|max:11',
            'markfrom' => 'required|integer',
            'markto' => 'required|integer',
            'note' => 'nullable|string',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'grade.required' => 'El nombre del grado es obligatorio.',
            'point.required' => 'El punto de calificación es obligatorio.',
            'markfrom.required' => 'La nota mínima es obligatoria.',
            'markto.required' => 'La nota máxima es obligatoria.',
        ];
    }
}
