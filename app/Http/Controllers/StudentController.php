<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Parents;
use App\Models\Studentgroup;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('estudiante_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $classesID = $request->get('classesID');
        $search = $request->get('search');
        $active = $request->get('active');
        
        $classes = Classes::all();
        
        $query = Student::with(['classes', 'section']);
        
        if ($classesID) {
            $query->where('classesID', $classesID);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('roll', 'like', "%{$search}%")
                  ->orWhere('dni', 'like', "%{$search}%");
            });
        }

        if ($active !== null && $active !== '') {
            $query->where('active', $active);
        }

        $students = $query->paginate(10)->withQueryString();

        return view('student.index', compact('students', 'classes', 'classesID', 'search', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::user()->hasPermission('estudiante_add')) {
            abort(403, 'No tienes permiso para agregar estudiantes.');
        }

        $classes = Classes::all();
        $sections = Section::all();
        $parents = Parents::all();
        $groups = Studentgroup::all();

        return view('student.create', compact('classes', 'sections', 'parents', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $data['usertypeID'] = 3;
        $data['active'] = 1;
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_username'] = Auth::user()->name;
        $data['create_usertype'] = 'Admin';

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        Student::create($data);

        return redirect()->route('student.index')->with('success', 'Estudiante creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Auth::user()->hasPermission('estudiante_edit')) {
            abort(403, 'No tienes permiso para editar estudiantes.');
        }

        $student = Student::findOrFail($id);
        $classes = Classes::all();
        $sections = Section::where('classesID', $student->classesID)->get();
        $parents = Parents::all();
        $groups = Studentgroup::all();

        return view('student.edit', compact('student', 'classes', 'sections', 'parents', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, string $id)
    {
        $student = Student::findOrFail($id);
        $data = $request->validated();
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($student->photo && $student->photo != 'default.png') {
                Storage::disk('public')->delete('images/' . $student->photo);
            }
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        $student->update($data);

        return redirect()->route('student.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Auth::user()->hasPermission('estudiante_delete')) {
            abort(403, 'No tienes permiso para eliminar estudiantes.');
        }

        $student = Student::findOrFail($id);
        if ($student->photo && $student->photo != 'default.png') {
            Storage::disk('public')->delete('images/' . $student->photo);
        }
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Estudiante eliminado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::user()->hasPermission('estudiante_view')) {
            abort(403, 'No tienes permiso para ver este estudiante.');
        }

        $student = Student::with(['classes', 'section', 'parent'])->findOrFail($id);
        return view('student.show', compact('student'));
    }
}
