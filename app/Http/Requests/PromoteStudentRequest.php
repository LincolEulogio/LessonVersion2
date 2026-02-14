<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PromoteStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('promocion_add');
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
            'schoolyearID' => 'required|exists:schoolyear,schoolyearID',
            'promotion_classesID' => 'required|exists:classes,classesID',
            'promotion_schoolyearID' => 'required|exists:schoolyear,schoolyearID',
            'student_ids' => 'required|array',
            'student_ids.*' => 'exists:student,studentID',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'classesID.required' => 'La clase actual es obligatoria.',
            'schoolyearID.required' => 'El año escolar actual es obligatorio.',
            'promotion_classesID.required' => 'La clase de destino es obligatoria.',
            'promotion_schoolyearID.required' => 'El año escolar de destino es obligatorio.',
            'student_ids.required' => 'Debe seleccionar al menos un estudiante para promover.',
        ];
    }
}
