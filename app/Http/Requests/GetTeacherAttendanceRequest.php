<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GetTeacherAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('asistencia_docente_view') || 
               Auth::user()->hasPermission('asistencia_docente_add');
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date_format:Y-m-d',
        ];
    }

    public function messages(): array
    {
        return [
            'date.required' => 'La fecha es obligatoria.',
            'date.date_format' => 'El formato de fecha debe ser YYYY-MM-DD.',
        ];
    }
}
