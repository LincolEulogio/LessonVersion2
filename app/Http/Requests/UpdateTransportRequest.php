<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $transportID = $this->route('transport');
        return [
            'route' => 'required|string|max:128|unique:transport,route,' . $transportID . ',transportID',
            'vehicle' => 'required|string|max:128',
            'cost' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:200',
        ];
    }

    public function messages(): array
    {
        return [
            'route.required' => 'La ruta es obligatoria.',
            'route.string' => 'La ruta debe ser una cadena de texto.',
            'route.max' => 'La ruta no puede exceder los 128 caracteres.',
            'route.unique' => 'Esta ruta ya está registrada.',
            'vehicle.required' => 'El vehículo es obligatorio.',
            'vehicle.string' => 'El vehículo debe ser una cadena de texto.',
            'vehicle.max' => 'El vehículo no puede exceder los 128 caracteres.',
            'cost.required' => 'El costo es obligatorio.',
            'cost.numeric' => 'El costo debe ser un número.',
            'cost.min' => 'El costo no puede ser negativo.',
            'note.max' => 'La nota no puede exceder los 200 caracteres.',
        ];
    }
}
