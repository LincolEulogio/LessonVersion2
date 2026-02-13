<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ParentsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $active = $request->get('active');

        $query = Parents::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('dni', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($active !== null && $active !== '') {
            $query->where('active', $active);
        }

        $parents = $query->paginate(10)->withQueryString();
        return view('parents.index', compact('parents', 'search', 'active'));
    }

    public function create()
    {
        return view('parents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
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
        ], [
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
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['usertypeID'] = 4;
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

        Parents::create($data);

        return redirect()->route('parents.index')->with('success', 'Padre/Tutor creado correctamente.');
    }

    public function show(string $id)
    {
        $parent = Parents::findOrFail($id);
        return view('parents.show', compact('parent'));
    }

    public function edit(string $id)
    {
        $parent = Parents::findOrFail($id);
        return view('parents.edit', compact('parent'));
    }

    public function update(Request $request, string $id)
    {
        $parent = Parents::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:60|regex:/^[\pL\s\-]+$/u',
            'father_name' => 'nullable|string|max:60|regex:/^[\pL\s\-]+$/u',
            'mother_name' => 'nullable|string|max:60|regex:/^[\pL\s\-]+$/u',
            'father_profession' => 'nullable|string|max:40|regex:/^[\pL\s\-]+$/u',
            'mother_profession' => 'nullable|string|max:40|regex:/^[\pL\s\-]+$/u',
            'email' => 'required|email|max:40|unique:parents,email,'.$id.',parentsID',
            'phone' => 'required|numeric|digits_between:7,9',
            'address' => 'required|string|max:200',
            'username' => 'required|string|min:8|max:40|unique:parents,username,'.$id.',parentsID',
            'dni' => 'required|numeric|digits:8|unique:parents,dni,'.$id.',parentsID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'El nombre del tutor es obligatorio.',
            'name.regex' => 'El nombre no debe contener números.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un formato de correo válido (@).',
            'email.unique' => 'Este correo ya está registrado.',
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
            'regex' => 'Este campo no debe contener números.',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($parent->photo && $parent->photo != 'default.png') {
                Storage::disk('public')->delete('images/' . $parent->photo);
            }
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        $parent->update($data);

        return redirect()->route('parents.index')->with('success', 'Padre/Tutor actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $parent = Parents::findOrFail($id);
        if ($parent->photo && $parent->photo != 'default.png') {
            Storage::disk('public')->delete('images/' . $parent->photo);
        }
        $parent->delete();

        return redirect()->route('parents.index')->with('success', 'Padre/Tutor eliminado correctamente.');
    }
}
