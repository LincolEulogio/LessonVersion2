<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\SubjectAttendance;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource for class/section/date selection.
     */
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $classes = Classes::orderBy('classes_numeric')->get();
        
        $sections = [];
        if ($classesID) {
            $sections = Section::where('classesID', $classesID)->get();
        }

        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';

        return view('attendance.index', compact('classes', 'classesID', 'sections', 'attendance_type'));
    }

    /**
     * Show the form for marking attendance.
     */
    public function add(Request $request)
    {
        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        $rules = [
            'classesID' => 'required|integer',
            'sectionID' => 'required|integer',
            'date' => 'required|string',
        ];

        if ($attendance_type == 'subject') {
            $rules['subjectID'] = 'required|integer';
        }

        $request->validate($rules, [
            'classesID.required' => 'La clase es obligatoria.',
            'sectionID.required' => 'La sección es obligatoria.',
            'subjectID.required' => 'La materia es obligatoria.',
            'date.required' => 'La fecha es obligatoria.',
        ]);

        $classesID = $request->get('classesID');
        $sectionID = $request->get('sectionID');
        $dateInput = $request->get('date');
        $subjectID = $request->get('subjectID');

        $class = Classes::findOrFail($classesID);
        $section = Section::findOrFail($sectionID);
        
        $subjects = [];
        if ($attendance_type == 'subject') {
            $subjects = Subject::where('classesID', $classesID)->orderBy('subject')->get();
        }

        try {
            $carbonDate = \Illuminate\Support\Carbon::parse($dateInput);
        } catch (\Exception $e) {
            $carbonDate = \Illuminate\Support\Carbon::now();
        }
        
        $dateInput = $carbonDate->format('d-m-Y');

        $dayNum = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $dayNum;

        $students = Student::where('classesID', $classesID)
            ->where('sectionID', $sectionID)
            ->orderBy('roll')
            ->get();

        $schoolyearID = session('default_schoolyearID') ?? 1;

        $attendances = [];
        if ($attendance_type == 'subject' && $subjectID) {
            $attendances = SubjectAttendance::where('classesID', $classesID)
                ->where('sectionID', $sectionID)
                ->where('subjectID', $subjectID)
                ->where('monthyear', $monthyear)
                ->where('schoolyearID', $schoolyearID)
                ->get()
                ->keyBy('studentID');
        } else {
            $attendances = Attendance::where('classesID', $classesID)
                ->where('sectionID', $sectionID)
                ->where('monthyear', $monthyear)
                ->where('schoolyearID', $schoolyearID)
                ->get()
                ->keyBy('studentID');
        }

        return view('attendance.add', compact(
            'class', 'section', 'dateInput', 'dayNum', 'monthyear', 'aday', 
            'students', 'attendances', 'attendance_type', 'subjects', 'subjectID'
        ));
    }

    /**
     * Save attendance status for a student.
     */
    public function save(Request $request)
    {
        $request->validate([
            'studentID' => 'required|integer',
            'classesID' => 'required|integer',
            'sectionID' => 'required|integer',
            'date' => 'required|string',
            'status' => 'required|in:P,A,L,N', // Present, Absent, Late, None
        ]);

        try {
            $carbonDate = Carbon::createFromFormat('d-m-Y', $request->date);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Fecha inválida'], 400);
        }

        $dayNum = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $dayNum;
        $schoolyearID = session('default_schoolyearID') ?? 1;
        
        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        $status = $request->status == 'N' ? null : $request->status;

        if ($attendance_type == 'subject') {
            $request->validate(['subjectID' => 'required|integer']);
            
            $attendance = SubjectAttendance::firstOrCreate([
                'studentID' => $request->studentID,
                'classesID' => $request->classesID,
                'sectionID' => $request->sectionID,
                'subjectID' => $request->subjectID,
                'monthyear' => $monthyear,
                'schoolyearID' => $schoolyearID,
            ], [
                'userID' => Auth::id(),
                'usertype' => Auth::user()->usertype->usertype ?? 'Admin',
                'create_username' => Auth::user()->username,
                'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
            ]);
        } else {
            $attendance = Attendance::firstOrCreate([
                'studentID' => $request->studentID,
                'classesID' => $request->classesID,
                'sectionID' => $request->sectionID,
                'monthyear' => $monthyear,
                'schoolyearID' => $schoolyearID,
            ], [
                'userID' => Auth::id(),
                'usertype' => Auth::user()->usertype->usertype ?? 'Admin',
                'create_username' => Auth::user()->username,
                'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
            ]);
        }

        $attendance->$aday = $status;
        $attendance->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Asistencia actualizada correctamente.');
    }

    /**
     * Display student's monthly attendance summary.
     */
    public function show($id, Request $request)
    {
        $student = Student::with(['classes', 'section'])->findOrFail($id);
        $monthyearInput = $request->get('monthyear', date('m-Y'));
        $schoolyearID = session('default_schoolyearID') ?? 1;
        
        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        if ($attendance_type == 'subject') {
            $attendances = SubjectAttendance::where('studentID', $id)
                ->where('monthyear', $monthyearInput)
                ->where('schoolyearID', $schoolyearID)
                ->with('subject')
                ->get();
        } else {
            $attendances = Attendance::where('studentID', $id)
                ->where('monthyear', $monthyearInput)
                ->where('schoolyearID', $schoolyearID)
                ->get();
        }

        // Generate list of all days in that month for the view
        try {
            $date = Carbon::createFromFormat('m-Y', $monthyearInput);
            $daysInMonth = $date->daysInMonth;
        } catch (\Exception $e) {
            $daysInMonth = 31;
        }

        return view('attendance.show', compact('student', 'attendances', 'monthyearInput', 'attendance_type', 'daysInMonth'));
    }
}
