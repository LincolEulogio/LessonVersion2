<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Schoolyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $classes = Classes::all();
        
        $query = Routine::leftJoin('classes', 'routine.classesID', '=', 'classes.classesID')
            ->leftJoin('section', 'routine.sectionID', '=', 'section.sectionID')
            ->leftJoin('subject', 'routine.subjectID', '=', 'subject.subjectID')
            ->leftJoin('teachers', 'routine.teacherID', '=', 'teachers.teacherID')
            ->select('routine.*', 'classes.classes as class_name', 'section.section as section_name', 'subject.subject as subject_name', 'teachers.name as teacher_name');

        if ($classesID) {
            $query->where('routine.classesID', $classesID);
        }

        $routines = $query->get();
            
        return view('routine.index', compact('routines', 'classes', 'classesID'));
    }

    public function create()
    {
        $classes = Classes::all();
        $teachers = Teacher::all();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return view('routine.create', compact('classes', 'teachers', 'days'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'subjectID' => 'required|exists:subject,subjectID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required|string|max:255',
        ]);

        $schoolyear = Schoolyear::where('schoolyearID', session('default_schoolyearID') ?? 1)->first();

        Routine::create([
            'classesID' => $request->classesID,
            'sectionID' => $request->sectionID,
            'subjectID' => $request->subjectID,
            'teacherID' => $request->teacherID,
            'schoolyearID' => $schoolyear->schoolyearID ?? 1,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'room' => $request->room,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => Auth::id(),
            'create_usertypeID' => Auth::user()->usertypeID,
        ]);

        return redirect()->route('routine.index')->with('success', 'Horario creado exitosamente.');
    }

    public function edit($id)
    {
        $routine = Routine::findOrFail($id);
        $classes = Classes::all();
        $sections = Section::where('classesID', $routine->classesID)->get();
        $subjects = Subject::where('classesID', $routine->classesID)->get();
        $teachers = Teacher::all();
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        return view('routine.edit', compact('routine', 'classes', 'sections', 'subjects', 'teachers', 'days'));
    }

    public function update(Request $request, $id)
    {
        $routine = Routine::findOrFail($id);
        
        $request->validate([
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'subjectID' => 'required|exists:subject,subjectID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'room' => 'required|string|max:255',
        ]);

        $routine->update([
            'classesID' => $request->classesID,
            'sectionID' => $request->sectionID,
            'subjectID' => $request->subjectID,
            'teacherID' => $request->teacherID,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'room' => $request->room,
            'modify_date' => now(),
        ]);

        return redirect()->route('routine.index')->with('success', 'Horario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $routine = Routine::findOrFail($id);
        $routine->delete();
        return redirect()->route('routine.index')->with('success', 'Horario eliminado exitosamente.');
    }
}
