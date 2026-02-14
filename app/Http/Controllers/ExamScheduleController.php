<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ExamSchedule;
use Illuminate\Http\Request;
use App\Http\Requests\StoreExamScheduleRequest;
use App\Http\Requests\UpdateExamScheduleRequest;
use Illuminate\Support\Facades\Auth;

class ExamScheduleController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('horario_de_examen_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $classes = Classes::all();
        $classesID = $request->get('classesID');
        
        $schedules = [];
        if ($classesID) {
            $schedules = ExamSchedule::where('classesID', $classesID)
                ->with(['exam', 'section', 'subject'])
                ->get();
        }

        return view('examschedule.index', compact('classes', 'classesID', 'schedules'));
    }

    public function create()
    {
        if (!Auth::user()->hasPermission('horario_de_examen_add')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $exams = Exam::all();
        $classes = Classes::all();
        return view('examschedule.create', compact('exams', 'classes'));
    }

    public function store(StoreExamScheduleRequest $request)
    {
        $validated = $request->validated();
        $validated['schoolyearID'] = session('default_schoolyearID') ?? 1;
        
        ExamSchedule::create($validated);

        return redirect()->route('examschedule.index', ['classesID' => $request->classesID])
            ->with('success', 'Horario de examen creado correctamente.');
    }

    public function show($id)
    {
        if (!Auth::user()->hasPermission('horario_de_examen_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $schedule = ExamSchedule::with(['exam', 'classes', 'section', 'subject'])->findOrFail($id);
        return view('examschedule.show', compact('schedule'));
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermission('horario_de_examen_edit')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $schedule = ExamSchedule::findOrFail($id);
        $exams = Exam::all();
        $classes = Classes::all();
        $sections = Section::where('classesID', $schedule->classesID)->get();
        $subjects = Subject::where('classesID', $schedule->classesID)->get();
        
        return view('examschedule.edit', compact('schedule', 'exams', 'classes', 'sections', 'subjects'));
    }

    public function update(UpdateExamScheduleRequest $request, $id)
    {
        $schedule = ExamSchedule::findOrFail($id);
        $schedule->update($request->validated());

        return redirect()->route('examschedule.index', ['classesID' => $request->classesID])
            ->with('success', 'Horario de examen actualizado correctamente.');
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('horario_de_examen_delete')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $schedule = ExamSchedule::findOrFail($id);
        $classesID = $schedule->classesID;
        $schedule->delete();

        return redirect()->route('examschedule.index', ['classesID' => $classesID])
            ->with('success', 'Horario de examen eliminado correctamente.');
    }
}
