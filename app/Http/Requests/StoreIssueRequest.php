<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIssueRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lmembercardID' => 'required|exists:lmember,lmembercardID',
            'bookID' => 'required|exists:book,bookID',
            'serial_no' => 'required|string|max:40',
            'issue_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'note' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'lmembercardID.required' => 'El ID de miembro es obligatorio.',
            'lmembercardID.exists' => 'El ID de miembro no es válido o no está registrado.',
            'bookID.required' => 'Debe seleccionar un libro.',
            'bookID.exists' => 'El libro seleccionado no es válido.',
            'serial_no.required' => 'El número de serie es obligatorio.',
            'issue_date.required' => 'La fecha de préstamo es obligatoria.',
            'due_date.required' => 'La fecha de vencimiento es obligatoria.',
            'due_date.after_or_equal' => 'La fecha de vencimiento debe ser igual o posterior a la fecha de préstamo.'
        ];
    }
}
