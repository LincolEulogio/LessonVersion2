<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateExamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('examen_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('exam'); // Current ID from route
        return [
            'exam' => 'required|string|max:60|unique:exam,exam,' . $id . ',examID',
            'date' => 'required|date',
            'note' => 'nullable|string|max:200',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'exam.required' => 'El nombre del examen es obligatorio.',
            'exam.unique' => 'Este examen ya existe.',
            'date.required' => 'La fecha es obligatoria.',
        ];
    }
}
