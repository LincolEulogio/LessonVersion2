<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\ExamSchedule;
use Illuminate\Http\Request;

class ExamScheduleController extends Controller
{
    public function index(Request $request)
    {
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
        $exams = Exam::all();
        $classes = Classes::all();
        return view('examschedule.create', compact('exams', 'classes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'examID' => 'required|exists:exam,examID',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'subjectID' => 'required|exists:subject,subjectID',
            'edate' => 'required|date',
            'examfrom' => 'required|string|max:10',
            'examto' => 'required|string|max:10',
            'room' => 'nullable|string|max:255',
        ]);

        $validated['schoolyearID'] = 1; // Default
        ExamSchedule::create($validated);

        return redirect()->route('examschedule.index', ['classesID' => $request->classesID])
            ->with('success', 'Horario de examen creado correctamente.');
    }

    public function show($id)
    {
        $schedule = ExamSchedule::with(['exam', 'classes', 'section', 'subject'])->findOrFail($id);
        return view('examschedule.show', compact('schedule'));
    }

    public function edit($id)
    {
        $schedule = ExamSchedule::findOrFail($id);
        $exams = Exam::all();
        $classes = Classes::all();
        $sections = Section::where('classesID', $schedule->classesID)->get();
        $subjects = Subject::where('classesID', $schedule->classesID)->get();
        
        return view('examschedule.edit', compact('schedule', 'exams', 'classes', 'sections', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $schedule = ExamSchedule::findOrFail($id);
        
        $validated = $request->validate([
            'examID' => 'required|exists:exam,examID',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'subjectID' => 'required|exists:subject,subjectID',
            'edate' => 'required|date',
            'examfrom' => 'required|string|max:10',
            'examto' => 'required|string|max:10',
            'room' => 'nullable|string|max:255',
        ]);

        $schedule->update($validated);

        return redirect()->route('examschedule.index', ['classesID' => $request->classesID])
            ->with('success', 'Horario de examen actualizado correctamente.');
    }

    public function destroy($id)
    {
        $schedule = ExamSchedule::findOrFail($id);
        $classesID = $schedule->classesID;
        $schedule->delete();

        return redirect()->route('examschedule.index', ['classesID' => $classesID])
            ->with('success', 'Horario de examen eliminado correctamente.');
    }
}
