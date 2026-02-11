<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ParentsController extends Controller
{
    public function index()
    {
        $parents = Parents::paginate(20);
        return view('parents.index', compact('parents'));
    }

    public function create()
    {
        return view('parents.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:60',
            'father_name' => 'nullable|string|max:60',
            'mother_name' => 'nullable|string|max:60',
            'father_profession' => 'nullable|string|max:40',
            'mother_profession' => 'nullable|string|max:40',
            'email' => 'nullable|email|max:40|unique:parents,email',
            'phone' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:200',
            'username' => 'required|string|min:4|max:40|unique:parents,username',
            'password' => 'required|string|min:4|max:40',
            'dni' => 'required|string|max:30|unique:parents,dni',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['usertypeID'] = 4;
        $data['active'] = 1;

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
            'name' => 'required|string|max:60',
            'father_name' => 'nullable|string|max:60',
            'mother_name' => 'nullable|string|max:60',
            'father_profession' => 'nullable|string|max:40',
            'mother_profession' => 'nullable|string|max:40',
            'email' => 'nullable|email|max:40|unique:parents,email,'.$id.',parentsID',
            'phone' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:200',
            'username' => 'required|string|min:4|max:40|unique:parents,username,'.$id.',parentsID',
            'dni' => 'required|string|max:30|unique:parents,dni,'.$id.',parentsID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
