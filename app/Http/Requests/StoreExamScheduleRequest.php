<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreExamScheduleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('horario_de_examen_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'examID' => 'required|exists:exam,examID',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'subjectID' => 'required|exists:subject,subjectID',
            'edate' => 'required|date',
            'examfrom' => 'required|string|max:10',
            'examto' => 'required|string|max:10',
            'room' => 'nullable|string|max:255',
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
            'sectionID.required' => 'La sección es obligatoria.',
            'subjectID.required' => 'La materia es obligatoria.',
            'edate.required' => 'La fecha es obligatoria.',
            'examfrom.required' => 'La hora de inicio es obligatoria.',
            'examto.required' => 'La hora de fin es obligatoria.',
        ];
    }
}
