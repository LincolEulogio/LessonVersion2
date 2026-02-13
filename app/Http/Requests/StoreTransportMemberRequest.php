<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransportMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'studentID' => 'required|exists:students,studentID|unique:tmember,studentID',
            'transportID' => 'required|exists:transport,transportID',
            'tjoindate' => 'required|date',
            'tbalance' => 'nullable|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'studentID.required' => 'Debe seleccionar un estudiante.',
            'studentID.exists' => 'El estudiante seleccionado no es válido.',
            'studentID.unique' => 'Este estudiante ya está registrado en una ruta de transporte.',
            'transportID.required' => 'Debe seleccionar una ruta de transporte.',
            'transportID.exists' => 'La ruta seleccionada no es válida.',
            'tjoindate.required' => 'La fecha de unión es obligatoria.',
            'tjoindate.date' => 'La fecha de unión debe ser una fecha válida.',
            'tbalance.numeric' => 'El balance debe ser un número.',
        ];
    }
}
