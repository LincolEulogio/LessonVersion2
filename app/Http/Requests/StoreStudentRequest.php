<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreStudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('estudiante_add');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'dob' => 'required|date',
            'sex' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|numeric|digits:9',
            'address' => 'required|string',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'username' => 'required|string|min:8|unique:students,username',
            'password' => 'required|string|min:8',
            'parentID' => 'required|exists:parents,parentsID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dni' => 'required|numeric|digits:8|unique:students,dni',
            'roll' => 'required|numeric',
            'religion' => 'required|string|regex:/^[\pL\s\-]+$/u',
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
            'name.required' => 'El nombre completo es obligatorio.',
            'name.regex' => 'El nombre no debe contener números.',
            'sex.required' => 'El género es obligatorio.',
            'classesID.required' => 'La clase o grado es obligatorio.',
            'sectionID.required' => 'La sección es obligatoria.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.min' => 'El usuario debe tener al menos 8 caracteres.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico con formato válido (@).',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.max' => 'La imagen no debe pesar más de 2MB.',
            'dob.required' => 'La fecha de nacimiento es obligatoria.',
            'dob.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.numeric' => 'El teléfono debe ser solo números.',
            'phone.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'address.required' => 'La dirección de residencia es obligatoria.',
            'parentID.required' => 'Debe seleccionar un tutor para el estudiante.',
            'parentID.exists' => 'El tutor seleccionado no existe en el sistema.',
            'dni.required' => 'El DNI/Documento es obligatorio.',
            'dni.numeric' => 'El DNI debe ser solo números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'roll.required' => 'El número de registro (Roll) es obligatorio.',
            'roll.numeric' => 'El número de registro debe ser un valor numérico.',
            'religion.required' => 'La religión es obligatoria.',
            'religion.regex' => 'La religión no debe contener números.',
        ];
    }
}
