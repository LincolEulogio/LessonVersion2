<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Eattendance;
use Illuminate\Http\Request;
use App\Http\Requests\SaveExamAttendanceRequest;
use Illuminate\Support\Facades\Auth;

class ExamAttendanceController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('asistencia_examen_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

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

    public function save(SaveExamAttendanceRequest $request)
    {
        $data = $request->validated();

        $student = Student::findOrFail($data['studentID']);
        $schoolyearID = $student->schoolyearID ?? 1;

        $attendance = Eattendance::updateOrCreate([
            'examID' => $data['examID'],
            'classesID' => $data['classesID'],
            'sectionID' => $data['sectionID'],
            'subjectID' => $data['subjectID'],
            'studentID' => $data['studentID'],
            'schoolyearID' => $schoolyearID,
        ], [
            's_name' => $student->name,
            'eattendance' => $data['status'],
            'date' => date('Y-m-d'),
            'year' => date('Y'),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'status' => $data['status'],
                'message' => __('Asistencia registrada correctamente')
            ]);
        }

        return back()->with('success', 'Asistencia de examen guardada.');
    }
}
