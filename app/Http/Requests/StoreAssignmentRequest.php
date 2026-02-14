<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreAssignmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('asignacion_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'subjectID' => 'required|exists:subject,subjectID',
            'deadlinedate' => 'required|date|after_or_equal:today',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240',
            'description' => 'required|string|max:1000',
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
            'title.required' => 'El título es obligatorio.',
            'title.max' => 'El título no debe exceder los 128 caracteres.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'classesID.exists' => 'La clase seleccionada no es válida.',
            'subjectID.required' => 'Debe seleccionar una materia.',
            'subjectID.exists' => 'La materia seleccionada no es válida.',
            'deadlinedate.required' => 'La fecha límite es obligatoria.',
            'deadlinedate.after_or_equal' => 'La fecha límite debe ser hoy o una fecha futura.',
            'file.mimes' => 'El archivo debe ser tipo: pdf, doc, docx, ppt, pptx, zip, jpg, png.',
            'file.max' => 'El archivo no debe exceder los 10MB.',
            'description.required' => 'La descripción es obligatoria.',
            'description.max' => 'La descripción no debe exceder los 1000 caracteres.',
        ];
    }
}
