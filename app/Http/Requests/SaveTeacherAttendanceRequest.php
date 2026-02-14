<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SaveTeacherAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('asistencia_docente_add');
    }

    public function rules(): array
    {
        return [
            'teacherID' => 'required|exists:teachers,teacherID',
            'date' => 'required|date_format:d-m-Y',
            'status' => 'required|in:P,A,L,N',
        ];
    }

    public function messages(): array
    {
        return [
            'teacherID.required' => 'El docente es obligatorio.',
            'teacherID.exists' => 'El docente seleccionado no es válido.',
            'date.required' => 'La fecha es obligatoria.',
            'status.required' => 'El estado es obligatorio.',
            'status.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
