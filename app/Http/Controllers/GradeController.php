<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::all();
        return view('grade.index', compact('grades'));
    }

    public function create()
    {
        return view('grade.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'grade' => 'required|string|max:60',
            'point' => 'required|string|max:11',
            'markfrom' => 'required|integer',
            'markto' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        Grade::create($validated);

        return redirect()->route('grade.index')->with('success', 'Grado creado correctamente.');
    }

    public function edit(string $id)
    {
        $grade = Grade::findOrFail($id);
        return view('grade.edit', compact('grade'));
    }

    public function update(Request $request, string $id)
    {
        $grade = Grade::findOrFail($id);

        $validated = $request->validate([
            'grade' => 'required|string|max:60',
            'point' => 'required|string|max:11',
            'markfrom' => 'required|integer',
            'markto' => 'required|integer',
            'note' => 'nullable|string',
        ]);

        $grade->update($validated);

        return redirect()->route('grade.index')->with('success', 'Grado actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        $grade = Grade::findOrFail($id);
        $grade->delete();

        return redirect()->route('grade.index')->with('success', 'Grado eliminado correctamente.');
    }
}
