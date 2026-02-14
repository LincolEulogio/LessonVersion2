<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\StoreClassesRequest;
use App\Http\Requests\UpdateClassesRequest;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('clases_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

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
        if (!Auth::user()->hasPermission('clases_add')) {
            abort(403, 'No tienes permiso para agregar clases.');
        }

        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('classes.create', compact('teachers'));
    }

    public function store(StoreClassesRequest $request)
    {
        $data = $request->validated();
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
        if (!Auth::user()->hasPermission('clases_view')) {
            abort(403, 'No tienes permiso para ver esta clase.');
        }

        $class = Classes::leftJoin('teachers', 'classes.teacherID', '=', 'teachers.teacherID')
            ->select('classes.*', 'teachers.name as teacher_name', 'teachers.photo as teacher_photo', 'teachers.email as teacher_email')
            ->where('classes.classesID', $id)
            ->firstOrFail();

        return view('classes.show', compact('class'));
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermission('clases_edit')) {
            abort(403, 'No tienes permiso para editar clases.');
        }

        $class = Classes::findOrFail($id);
        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('classes.edit', compact('class', 'teachers'));
    }

    public function update(UpdateClassesRequest $request, $id)
    {
        $class = Classes::findOrFail($id);
        $data = $request->validated();
        $data['modify_date'] = now();

        $class->update($data);

        return redirect()->route('classes.index')->with('success', 'Clase actualizada exitosamente.');
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('clases_delete')) {
            abort(403, 'No tienes permiso para eliminar clases.');
        }

        $class = Classes::findOrFail($id);
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Clase eliminada exitosamente.');
    }
}
