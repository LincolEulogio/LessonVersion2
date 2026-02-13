<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $active = $request->input('active');

        $query = Teacher::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('dni', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('designation', 'like', "%{$search}%");
            });
        }

        if ($active !== null && $active !== '') {
            $query->where('active', $active);
        }

        $teachers = $query->paginate(10)->withQueryString();
        return view('teacher.index', compact('teachers', 'search', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
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
        ], [
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
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['usertypeID'] = 2;
        $data['active'] = 1;
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_username'] = Auth::user()->name;
        $data['create_usertype'] = 'Admin';

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        } else {
            $data['photo'] = 'default.png';
        }

        Teacher::create($data);

        return redirect()->route('teacher.index')->with('success', 'Docente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:60|regex:/^[\pL\s\-]+$/u',
            'designation' => 'required|string|max:128|regex:/^[\pL\s\-]+$/u',
            'dob' => 'required|date',
            'sex' => 'required|string|max:10',
            'email' => 'required|email|max:40|unique:teachers,email,'.$id.',teacherID',
            'phone' => 'required|numeric|digits_between:7,9',
            'address' => 'required|string|max:200',
            'jod' => 'required|date',
            'username' => 'required|string|min:8|max:40|unique:teachers,username,'.$id.',teacherID',
            'dni' => 'required|numeric|digits:8|unique:teachers,dni,'.$id.',teacherID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
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
            'dni.required' => 'El DNI es obligatorio.',
            'dni.numeric' => 'El DNI debe contener solo números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.numeric' => 'El teléfono debe contener solo números.',
            'phone.digits_between' => 'El teléfono debe tener entre 7 y 9 dígitos.',
            'address.required' => 'La dirección es obligatoria.',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($teacher->photo && $teacher->photo != 'default.png') {
                Storage::disk('public')->delete('images/' . $teacher->photo);
            }
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        $teacher->update($data);

        return redirect()->route('teacher.index')->with('success', 'Docente actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        if ($teacher->photo && $teacher->photo != 'default.png') {
            Storage::disk('public')->delete('images/' . $teacher->photo);
        }
        $teacher->delete();

        return redirect()->route('teacher.index')->with('success', 'Docente eliminado correctamente.');
    }
}
