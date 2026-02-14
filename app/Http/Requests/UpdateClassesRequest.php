<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateClassesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('clases_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('class');

        return [
            'classes' => 'required|string|max:60|unique:classes,classes,' . $id . ',classesID',
            'classes_numeric' => 'required|numeric|unique:classes,classes_numeric,' . $id . ',classesID',
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
            'classes.required' => 'El nombre de la clase es obligatorio.',
            'classes.unique' => 'Este nombre de clase ya está registrado.',
            'classes_numeric.required' => 'El valor numérico es obligatorio.',
            'classes_numeric.numeric' => 'El valor numérico debe ser un número.',
            'classes_numeric.unique' => 'Este valor numérico ya está en uso.',
            'teacherID.required' => 'Debe asignar un maestro responsable.',
            'teacherID.exists' => 'El maestro seleccionado no es válido.',
            'note.required' => 'La descripción o nota de la clase es obligatoria.',
            'note.max' => 'La nota no debe exceder los 500 caracteres.',
        ];
    }
}
