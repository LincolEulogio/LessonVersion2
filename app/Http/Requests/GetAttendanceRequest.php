<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class GetAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('asistencia_de_estudiante_add') || 
               Auth::user()->hasPermission('asistencia_de_estudiante_view');
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
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'date' => 'required|date_format:Y-m-d',
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
            'classesID.required' => 'La clase es obligatoria.',
            'classesID.exists' => 'La clase seleccionada no es válida.',
            'sectionID.required' => 'La sección es obligatoria.',
            'sectionID.exists' => 'La sección seleccionada no es válida.',
            'subjectID.required' => 'La materia es obligatoria.',
            'subjectID.exists' => 'La materia seleccionada no es válida.',
            'date.required' => 'La fecha es obligatoria.',
            'date.date_format' => 'El formato de fecha debe ser YYYY-MM-DD.',
        ];
    }
}
