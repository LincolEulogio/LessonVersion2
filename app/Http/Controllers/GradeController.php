<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGradeRequest;
use App\Http\Requests\UpdateGradeRequest;
use Illuminate\Support\Facades\Auth;

class GradeController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermission('grado_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $grades = Grade::all();
        return view('grade.index', compact('grades'));
    }

    public function create()
    {
        if (!Auth::user()->hasPermission('grado_add')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        return view('grade.create');
    }

    public function store(StoreGradeRequest $request)
    {
        Grade::create($request->validated());

        return redirect()->route('grade.index')->with('success', 'Grado creado correctamente.');
    }

    public function show(string $id)
    {
        if (!Auth::user()->hasPermission('grado_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $grade = Grade::findOrFail($id);
        return view('grade.show', compact('grade'));
    }

    public function edit(string $id)
    {
        if (!Auth::user()->hasPermission('grado_edit')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $grade = Grade::findOrFail($id);
        return view('grade.edit', compact('grade'));
    }

    public function update(UpdateGradeRequest $request, string $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->update($request->validated());

        return redirect()->route('grade.index')->with('success', 'Grado actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->hasPermission('grado_delete')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->route('grade.index')->with('success', 'Grado eliminado correctamente.');
    }
}
