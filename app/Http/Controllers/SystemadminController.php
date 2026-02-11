<?php

namespace App\Http\Controllers;

use App\Models\Systemadmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SystemadminController extends Controller
{
    public function index()
    {
        $systemadmins = Systemadmin::paginate(20);
        return view('systemadmin.index', compact('systemadmins'));
    }

    public function create()
    {
        return view('systemadmin.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:60',
            'dob' => 'required|date',
            'sex' => 'nullable|string|max:10',
            'email' => 'required|email|max:40|unique:systemadmins,email',
            'phone' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:200',
            'jod' => 'required|date',
            'username' => 'required|string|min:4|max:40|unique:systemadmins,username',
            'password' => 'required|string|min:4|max:40',
            'dni' => 'required|string|max:30|unique:systemadmins,dni',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['usertypeID'] = 1;
        $data['active'] = 1;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        } else {
            $data['photo'] = 'default.png';
        }

        Systemadmin::create($data);

        return redirect()->route('systemadmin.index')->with('success', 'Administrador creado correctamente.');
    }

    public function show(string $id)
    {
        $systemadmin = Systemadmin::findOrFail($id);
        return view('systemadmin.show', compact('systemadmin'));
    }

    public function edit(string $id)
    {
        // Prevent editing the main admin (ID 1) by others if needed, but for now just basic check
        $systemadmin = Systemadmin::findOrFail($id);
        return view('systemadmin.edit', compact('systemadmin'));
    }

    public function update(Request $request, string $id)
    {
        $systemadmin = Systemadmin::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:60',
            'dob' => 'required|date',
            'sex' => 'nullable|string|max:10',
            'email' => 'required|email|max:40|unique:systemadmins,email,'.$id.',systemadminID',
            'phone' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:200',
            'jod' => 'required|date',
            'username' => 'required|string|min:4|max:40|unique:systemadmins,username,'.$id.',systemadminID',
            'dni' => 'required|string|max:30|unique:systemadmins,dni,'.$id.',systemadminID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($systemadmin->photo && $systemadmin->photo != 'default.png') {
                Storage::disk('public')->delete('images/' . $systemadmin->photo);
            }
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        $systemadmin->update($data);

        return redirect()->route('systemadmin.index')->with('success', 'Administrador actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        if ($id == 1) {
            return redirect()->route('systemadmin.index')->with('error', 'No se puede eliminar al administrador principal.');
        }

        $systemadmin = Systemadmin::findOrFail($id);
        if ($systemadmin->photo && $systemadmin->photo != 'default.png') {
            Storage::disk('public')->delete('images/' . $systemadmin->photo);
        }
        $systemadmin->delete();

        return redirect()->route('systemadmin.index')->with('success', 'Administrador eliminado correctamente.');
    }
}
