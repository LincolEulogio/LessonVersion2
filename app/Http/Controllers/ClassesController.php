<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Classes::query()
            ->leftJoin('teachers', 'classes.teacherID', '=', 'teachers.teacherID')
            ->select('classes.*', 'teachers.name as teacher_name', 'teachers.photo as teacher_photo');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('classes.classes', 'like', "%{$search}%")
                    ->orWhere('classes.classes_numeric', 'like', "%{$search}%")
                    ->orWhere('teachers.name', 'like', "%{$search}%");
            });
        }

        $classes = $query->paginate(10)->withQueryString();

        return view('classes.index', compact('classes', 'search'));
    }

    public function create()
    {
        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classes' => 'required|string|max:60|unique:classes,classes',
            'classes_numeric' => 'required|numeric|unique:classes,classes_numeric',
            'teacherID' => 'required|exists:teachers,teacherID',
            'note' => 'required|string|max:500',
        ], [
            'classes.required' => 'El nombre de la clase es obligatorio.',
            'classes.unique' => 'Este nombre de clase ya está registrado.',
            'classes_numeric.required' => 'El valor numérico es obligatorio.',
            'classes_numeric.numeric' => 'El valor numérico debe ser un número.',
            'classes_numeric.unique' => 'Este valor numérico ya está en uso.',
            'teacherID.required' => 'Debe asignar un maestro responsable.',
            'teacherID.exists' => 'El maestro seleccionado no es válido.',
            'note.required' => 'La descripción o nota de la clase es obligatoria.',
            'note.max' => 'La nota no debe exceder los 500 caracteres.',
        ]);

        $data = $request->all();
        $data['studentmaxID'] = 999;
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_username'] = Auth::user()->username;
        $data['create_usertype'] = Auth::user()->usertypeID;

        Classes::create($data);

        return redirect()->route('classes.index')->with('success', 'Clase creada exitosamente.');
    }

    public function show($id)
    {
        $class = Classes::leftJoin('teachers', 'classes.teacherID', '=', 'teachers.teacherID')
            ->select('classes.*', 'teachers.name as teacher_name', 'teachers.photo as teacher_photo', 'teachers.email as teacher_email')
            ->where('classes.classesID', $id)
            ->firstOrFail();

        return view('classes.show', compact('class'));
    }

    public function edit($id)
    {
        $class = Classes::findOrFail($id);
        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('classes.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $class = Classes::findOrFail($id);

        $request->validate([
            'classes' => 'required|string|max:60|unique:classes,classes,' . $id . ',classesID',
            'classes_numeric' => 'required|numeric|unique:classes,classes_numeric,' . $id . ',classesID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'note' => 'required|string|max:500',
        ], [
            'classes.required' => 'El nombre de la clase es obligatorio.',
            'classes.unique' => 'Este nombre de clase ya está registrado.',
            'classes_numeric.required' => 'El valor numérico es obligatorio.',
            'classes_numeric.numeric' => 'El valor numérico debe ser un número.',
            'classes_numeric.unique' => 'Este valor numérico ya está en uso.',
            'teacherID.required' => 'Debe asignar un maestro responsable.',
            'teacherID.exists' => 'El maestro seleccionado no es válido.',
            'note.required' => 'La descripción o nota de la clase es obligatoria.',
            'note.max' => 'La nota no debe exceder los 500 caracteres.',
        ]);

        $data = $request->all();
        $data['modify_date'] = now();

        $class->update($data);

        return redirect()->route('classes.index')->with('success', 'Clase actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Clase eliminada exitosamente.');
    }
}
