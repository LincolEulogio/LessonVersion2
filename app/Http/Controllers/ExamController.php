<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::orderBy('date', 'desc')->get();
        return view('exam.index', compact('exams'));
    }

    public function create()
    {
        return view('exam.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'exam' => 'required|string|max:60|unique:exam,exam',
            'date' => 'required|date',
            'note' => 'nullable|string|max:200',
        ]);

        Exam::create($validated);

        return redirect()->route('exam.index')->with('success', 'Examen creado exitosamente.');
    }

    public function edit(string $id)
    {
        $exam = Exam::findOrFail($id);
        return view('exam.edit', compact('exam'));
    }

    public function update(Request $request, string $id)
    {
        $exam = Exam::findOrFail($id);

        $validated = $request->validate([
            'exam' => 'required|string|max:60|unique:exam,exam,' . $id . ',examID',
            'date' => 'required|date',
            'note' => 'nullable|string|max:200',
        ]);

        $exam->update($validated);

        return redirect()->route('exam.index')->with('success', 'Examen actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->route('exam.index')->with('success', 'Examen eliminado exitosamente.');
    }
}
