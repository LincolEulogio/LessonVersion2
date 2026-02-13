<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLibraryMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'studentID' => 'required|exists:students,studentID',
            'lmembercardID' => 'required|string|max:40|unique:lmember,lmembercardID',
            'lbalance' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'studentID.required' => 'El estudiante es obligatorio.',
            'studentID.exists' => 'El estudiante seleccionado no es válido.',
            'lmembercardID.required' => 'El ID de biblioteca es obligatorio.',
            'lmembercardID.unique' => 'Este ID de biblioteca ya está en uso.',
            'lbalance.required' => 'El saldo inicial es obligatorio.',
            'lbalance.numeric' => 'El saldo debe ser un número.',
            'lbalance.min' => 'El saldo no puede ser negativo.',
        ];
    }
}
