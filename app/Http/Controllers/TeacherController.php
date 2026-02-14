<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
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
        if (!Auth::user()->hasPermission('docente_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

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
        if (!Auth::user()->hasPermission('docente_add')) {
            abort(403, 'No tienes permiso para agregar docentes.');
        }

        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();
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
        if (!Auth::user()->hasPermission('docente_view')) {
            abort(403, 'No tienes permiso para ver este docente.');
        }

        $teacher = Teacher::findOrFail($id);
        return view('teacher.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::user()->hasPermission('docente_edit')) {
            abort(403, 'No tienes permiso para editar docentes.');
        }

        $teacher = Teacher::findOrFail($id);
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeacherRequest $request, string $id)
    {
        $teacher = Teacher::findOrFail($id);
        $data = $request->validated();

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
        if (!Auth::user()->hasPermission('docente_delete')) {
            abort(403, 'No tienes permiso para eliminar docentes.');
        }

        $teacher = Teacher::findOrFail($id);
        if ($teacher->photo && $teacher->photo != 'default.png') {
            Storage::disk('public')->delete('images/' . $teacher->photo);
        }
        $teacher->delete();

        return redirect()->route('teacher.index')->with('success', 'Docente eliminado correctamente.');
    }
}
