<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransportMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tmemberID = $this->route('tmember');
        return [
            'transportID' => 'required|exists:transport,transportID',
            'tjoindate' => 'required|date',
            'tbalance' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'transportID.required' => 'Debe seleccionar una ruta de transporte.',
            'transportID.exists' => 'La ruta seleccionada no es válida.',
            'tjoindate.required' => 'La fecha de unión es obligatoria.',
            'tjoindate.date' => 'La fecha de unión debe ser una fecha válida.',
            'tbalance.required' => 'El balance es obligatorio.',
            'tbalance.numeric' => 'El balance debe ser un número.',
        ];
    }
}
