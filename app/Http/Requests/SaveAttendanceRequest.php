<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class SaveAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('asistencia_de_estudiante_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        $rules = [
            'studentID' => 'required|exists:students,studentID',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'date' => 'required|date_format:d-m-Y',
            'status' => 'required|in:P,A,L,N',
        ];

        if ($attendance_type == 'subject') {
            $rules['subjectID'] = 'required|exists:subject,subjectID';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'studentID.required' => 'El estudiante es obligatorio.',
            'studentID.exists' => 'El estudiante seleccionado no es válido.',
            'classesID.required' => 'La clase es obligatoria.',
            'sectionID.required' => 'La sección es obligatoria.',
            'date.required' => 'La fecha es obligatoria.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado seleccionado no es válido.',
            'subjectID.required' => 'La materia es obligatoria.',
        ];
    }
}
