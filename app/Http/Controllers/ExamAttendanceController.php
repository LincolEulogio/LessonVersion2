<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Eattendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $exams = Exam::all();
        $classes = Classes::all();
        
        $examID = $request->get('examID');
        $classesID = $request->get('classesID');
        $sectionID = $request->get('sectionID');
        $subjectID = $request->get('subjectID');
        
        $sections = [];
        $subjects = [];
        $students = [];
        $attendances = [];

        if ($classesID) {
            $sections = Section::where('classesID', $classesID)->get();
            $subjects = Subject::where('classesID', $classesID)->get();
        }

        if ($examID && $classesID && $sectionID && $subjectID) {
            $students = Student::where('classesID', $classesID)
                ->where('sectionID', $sectionID)
                ->get();
            
            $attendances = Eattendance::where('examID', $examID)
                ->where('classesID', $classesID)
                ->where('sectionID', $sectionID)
                ->where('subjectID', $subjectID)
                ->get()
                ->keyBy('studentID');
        }

        return view('exam_attendance.index', compact(
            'exams', 'classes', 'sections', 'subjects', 'students', 'attendances',
            'examID', 'classesID', 'sectionID', 'subjectID'
        ));
    }

    public function save(Request $request)
    {
        $request->validate([
            'examID' => 'required',
            'classesID' => 'required',
            'sectionID' => 'required',
            'subjectID' => 'required',
            'studentID' => 'required',
            'status' => 'required|in:P,A',
        ]);

        $attendance = Eattendance::updateOrCreate([
            'examID' => $request->examID,
            'classesID' => $request->classesID,
            'sectionID' => $request->sectionID,
            'subjectID' => $request->subjectID,
            'studentID' => $request->studentID,
            'schoolyearID' => 1,
            'year' => date('Y'),
        ], [
            'eattendance' => $request->status,
            'date' => date('Y-m-d'),
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Asistencia de examen guardada.');
    }
}
