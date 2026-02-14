<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermission('examen_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $exams = Exam::orderBy('date', 'desc')->get();
        return view('exam.index', compact('exams'));
    }

    public function create()
    {
        if (!Auth::user()->hasPermission('examen_add')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        return view('exam.create');
    }

    public function store(StoreExamRequest $request)
    {
        Exam::create($request->validated());

        return redirect()->route('exam.index')->with('success', 'Examen creado exitosamente.');
    }

    public function show(string $id)
    {
        if (!Auth::user()->hasPermission('examen_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $exam = Exam::findOrFail($id);
        return view('exam.show', compact('exam'));
    }

    public function edit(string $id)
    {
        if (!Auth::user()->hasPermission('examen_edit')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $exam = Exam::findOrFail($id);
        return view('exam.edit', compact('exam'));
    }

    public function update(UpdateExamRequest $request, string $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->update($request->validated());

        return redirect()->route('exam.index')->with('success', 'Examen actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->hasPermission('examen_delete')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $exam = Exam::findOrFail($id);
        $exam->delete();

        return redirect()->route('exam.index')->with('success', 'Examen eliminado exitosamente.');
    }
}
