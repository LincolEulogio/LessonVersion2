<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTopicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('tema_edit');
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
            'description' => 'required|string|max:500',
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
            'title.required' => 'El título del tema es obligatorio.',
            'title.max' => 'El título no debe exceder los 128 caracteres.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'classesID.exists' => 'La clase seleccionada no es válida.',
            'subjectID.required' => 'Debe seleccionar una materia.',
            'subjectID.exists' => 'La materia seleccionada no es válida.',
            'description.required' => 'La descripción del tema es obligatoria.',
            'description.max' => 'La descripción no debe exceder los 500 caracteres.',
        ];
    }
}
