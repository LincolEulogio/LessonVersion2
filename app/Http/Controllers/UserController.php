<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usertype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $active = $request->input('active');
        $usertypeID = $request->input('usertypeID');

        $query = User::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('dni', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%");
            });
        }

        if ($active !== null && $active !== '') {
            $query->where('active', $active);
        }

        if ($usertypeID) {
            $query->where('usertypeID', $usertypeID);
        }

        $users = $query->paginate(10)->withQueryString();
        $usertypes = Usertype::all();

        return view('user.index', compact('users', 'search', 'active', 'usertypes', 'usertypeID'));
    }

    public function create()
    {
        $usertypes = Usertype::all();
        return view('user.create', compact('usertypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:60|regex:/^[\pL\s\-]+$/u',
            'dob' => 'required|date',
            'sex' => 'required|string|max:10',
            'email' => 'required|email|max:40|unique:users,email',
            'phone' => 'required|numeric|digits_between:7,9',
            'address' => 'required|string|max:200',
            'jod' => 'required|date',
            'usertypeID' => 'required|exists:usertypes,usertypeID',
            'username' => 'required|string|min:8|max:40|unique:users,username',
            'password' => 'required|string|min:8|max:40',
            'dni' => 'required|numeric|digits:8|unique:users,dni',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre no debe contener números.',
            'dob.required' => 'La fecha de nacimiento es obligatoria.',
            'sex.required' => 'El género es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un formato de correo válido (@).',
            'email.unique' => 'Este correo ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.numeric' => 'El teléfono debe contener solo números.',
            'phone.digits_between' => 'El teléfono debe tener entre 7 y 9 dígitos.',
            'address.required' => 'La dirección es obligatoria.',
            'jod.required' => 'La fecha de ingreso es obligatoria.',
            'usertypeID.required' => 'El tipo de usuario es obligatorio.',
            'username.required' => 'El usuario es obligatorio.',
            'username.min' => 'El usuario debe tener al menos 8 caracteres.',
            'username.unique' => 'Este usuario ya existe.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.numeric' => 'El DNI debe contener solo números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
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

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Usuario creado correctamente.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('user.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $usertypes = Usertype::all();
        return view('user.edit', compact('user', 'usertypes'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:60|regex:/^[\pL\s\-]+$/u',
            'dob' => 'required|date',
            'sex' => 'required|string|max:10',
            'email' => 'required|email|max:40|unique:users,email,'.$id.',userID',
            'phone' => 'required|numeric|digits_between:7,9',
            'address' => 'required|string|max:200',
            'jod' => 'required|date',
            'usertypeID' => 'required|exists:usertypes,usertypeID',
            'username' => 'required|string|min:8|max:40|unique:users,username,'.$id.',userID',
            'dni' => 'required|numeric|digits:8|unique:users,dni,'.$id.',userID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre no debe contener números.',
            'dob.required' => 'La fecha de nacimiento es obligatoria.',
            'sex.required' => 'El género es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un formato de correo válido (@).',
            'email.unique' => 'Este correo ya está registrado.',
            'phone.required' => 'El teléfono es obligatorio.',
            'phone.numeric' => 'El teléfono debe contener solo números.',
            'phone.digits_between' => 'El teléfono debe tener entre 7 y 9 dígitos.',
            'address.required' => 'La dirección es obligatoria.',
            'jod.required' => 'La fecha de ingreso es obligatoria.',
            'usertypeID.required' => 'El tipo de usuario es obligatorio.',
            'username.required' => 'El usuario es obligatorio.',
            'username.min' => 'El usuario debe tener al menos 8 caracteres.',
            'username.unique' => 'Este usuario ya existe.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.numeric' => 'El DNI debe contener solo números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($user->photo && $user->photo != 'default.png') {
                Storage::disk('public')->delete('images/' . $user->photo);
            }
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        $data['modify_date'] = now();
        $user->update($data);

        return redirect()->route('user.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->photo && $user->photo != 'default.png') {
            Storage::disk('public')->delete('images/' . $user->photo);
        }
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
