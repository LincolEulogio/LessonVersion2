<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateRoutineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('horario_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'subjectID' => 'required|exists:subject,subjectID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'day' => 'required|string',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'room' => 'required|string|max:64',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'classesID.required' => 'La clase es obligatoria.',
            'classesID.exists' => 'La clase seleccionada no es válida.',
            'sectionID.required' => 'La sección es obligatoria.',
            'sectionID.exists' => 'La sección seleccionada no es válida.',
            'subjectID.required' => 'La materia es obligatoria.',
            'subjectID.exists' => 'La materia seleccionada no es válida.',
            'teacherID.required' => 'El docente es obligatorio.',
            'teacherID.exists' => 'El docente seleccionado no es válido.',
            'day.required' => 'El día es obligatorio.',
            'start_time.required' => 'La hora de inicio es obligatoria.',
            'end_time.required' => 'La hora de fin es obligatoria.',
            'room.required' => 'El aula es obligatoria.',
            'room.max' => 'El nombre del aula no debe exceder los 64 caracteres.',
        ];
    }
}
