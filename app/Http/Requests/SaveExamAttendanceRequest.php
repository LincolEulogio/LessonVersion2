<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SaveExamAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('asistencia_examen_add');
    }

    public function rules(): array
    {
        return [
            'examID' => 'required|exists:exam,examID',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'subjectID' => 'required|exists:subject,subjectID',
            'studentID' => 'required|exists:students,studentID',
            'status' => 'required|in:P,A',
        ];
    }
}
