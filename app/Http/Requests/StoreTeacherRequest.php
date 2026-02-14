<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('docente_add');
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
            'designation' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',
            'dob' => 'required|date',
            'sex' => 'required|string|max:10',
            'email' => 'required|email|max:40|unique:teachers,email',
            'phone' => 'required|numeric|digits_between:7,9',
            'address' => 'required|string|max:200',
            'jod' => 'required|date',
            'username' => 'required|string|min:8|max:40|unique:teachers,username',
            'password' => 'required|string|min:8|max:40',
            'dni' => 'required|numeric|digits:8|unique:teachers,dni',
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
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre no debe contener números.',
            'designation.required' => 'El cargo es obligatorio.',
            'designation.regex' => 'El cargo no debe contener números.',
            'dob.required' => 'La fecha de nacimiento es obligatoria.',
            'sex.required' => 'El género es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un formato de correo válido (@).',
            'email.unique' => 'Este correo ya está registrado.',
            'jod.required' => 'La fecha de ingreso es obligatoria.',
            'username.required' => 'El usuario es obligatorio.',
            'username.min' => 'El usuario debe tener al menos 8 caracteres.',
            'username.unique' => 'Este usuario ya existe.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.numeric' => 'El DNI debe contener solo números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.numeric' => 'El teléfono debe contener solo números.',
            'phone.digits_between' => 'El teléfono debe tener entre 7 y 9 dígitos.',
            'address.required' => 'La dirección es obligatoria.',
        ];
    }
}
