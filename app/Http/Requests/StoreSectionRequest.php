<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreSectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('seccion_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'section' => [
                'required',
                'string',
                'max:60',
                Rule::unique('section')->where(function ($query) {
                    return $query->where('classesID', $this->classesID);
                }),
            ],
            'category' => 'required|string|max:128',
            'capacity' => 'required|numeric|min:1',
            'classesID' => 'required|exists:classes,classesID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'note' => 'required|string|max:500',
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
            'section.required' => 'El nombre de la sección es obligatorio.',
            'section.unique' => 'Esta sección ya existe para la clase seleccionada.',
            'category.required' => 'La categoría es obligatoria.',
            'capacity.required' => 'La capacidad es obligatoria.',
            'capacity.numeric' => 'La capacidad debe ser un número.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'teacherID.required' => 'Debe asignar un mentor.',
            'note.required' => 'La descripción es obligatoria.',
            'note.max' => 'La nota no debe exceder los 500 caracteres.',
        ];
    }
}
