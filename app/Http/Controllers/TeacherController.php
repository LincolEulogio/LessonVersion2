<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teachers = Teacher::paginate(20);
        return view('teacher.index', compact('teachers'));
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
            'name' => 'required|string|max:60',
            'designation' => 'required|string|max:128',
            'dob' => 'required|date',
            'sex' => 'required|string|max:10',
            'email' => 'required|email|max:40|unique:teachers,email',
            'phone' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:200',
            'jod' => 'required|date',
            'username' => 'required|string|min:4|max:40|unique:teachers,username',
            'password' => 'required|string|min:4|max:40',
            'dni' => 'required|string|max:30|unique:teachers,dni',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['usertypeID'] = 2;
        $data['active'] = 1;

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
            'name' => 'required|string|max:60',
            'designation' => 'required|string|max:128',
            'dob' => 'required|date',
            'sex' => 'required|string|max:10',
            'email' => 'required|email|max:40|unique:teachers,email,'.$id.',teacherID',
            'phone' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:200',
            'jod' => 'required|date',
            'username' => 'required|string|min:4|max:40|unique:teachers,username,'.$id.',teacherID',
            'dni' => 'required|string|max:30|unique:teachers,dni,'.$id.',teacherID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
