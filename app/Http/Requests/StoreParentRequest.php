<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreParentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('padres_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:60|regex:/^[\pL\s\-]+$/u',
            'father_name' => 'required|string|max:60|regex:/^[\pL\s\-]+$/u',
            'mother_name' => 'required|string|max:60|regex:/^[\pL\s\-]+$/u',
            'father_profession' => 'required|string|max:40|regex:/^[\pL\s\-]+$/u',
            'mother_profession' => 'required|string|max:40|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|max:40|unique:parents,email',
            'phone' => 'required|numeric|digits_between:7,9',
            'address' => 'required|string|max:200',
            'username' => 'required|string|min:8|max:40|unique:parents,username',
            'password' => 'required|string|min:8|max:40',
            'dni' => 'required|numeric|digits:8|unique:parents,dni',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'name.required' => 'El nombre del tutor es obligatorio.',
            'name.regex' => 'El nombre no debe contener números.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un formato de correo válido (@).',
            'email.unique' => 'Este correo ya está registrado.',
            'father_name.required' => 'El nombre del padre es obligatorio.',
            'mother_name.required' => 'El nombre de la madre es obligatorio.',
            'father_profession.required' => 'La profesión del padre es obligatoria.',
            'mother_profession.required' => 'La profesión de la madre es obligatoria.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.numeric' => 'El teléfono debe contener solo números.',
            'phone.digits_between' => 'El teléfono debe tener entre 7 y 9 dígitos.',
            'address.required' => 'La dirección es obligatoria.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.numeric' => 'El DNI debe contener solo números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'username.required' => 'El usuario es obligatorio.',
            'username.min' => 'El usuario debe tener al menos 8 caracteres.',
            'username.unique' => 'Este usuario ya existe.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'regex' => 'Este campo no debe contener números.',
        ];
    }
}
