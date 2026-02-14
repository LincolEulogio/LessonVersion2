<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMarkpercentageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('porcentaje_promedio_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'markpercentage' => 'required|string|max:60',
            'markpercentage_numeric' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'markpercentage.required' => 'El nombre del porcentaje de calificación es obligatorio.',
            'markpercentage_numeric.required' => 'El valor numérico es obligatorio.',
            'markpercentage_numeric.numeric' => 'El valor debe ser un número.',
        ];
    }
}
