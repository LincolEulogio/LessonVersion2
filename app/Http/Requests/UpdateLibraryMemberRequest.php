<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLibraryMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $lmemberID = $this->route('lmember');
        return [
            'lmembercardID' => 'required|string|max:40|unique:lmember,lmembercardID,' . $lmemberID . ',lmemberID',
            'lbalance' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'lmembercardID.required' => 'El ID de biblioteca es obligatorio.',
            'lmembercardID.unique' => 'Este ID de biblioteca ya está en uso.',
            'lbalance.required' => 'El saldo es obligatorio.',
            'lbalance.numeric' => 'El saldo debe ser un número.',
            'lbalance.min' => 'El saldo no puede ser negativo.',
        ];
    }
}
