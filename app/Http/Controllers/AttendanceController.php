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
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classes = Classes::all();
        $classesID = $request->get('classesID');
        
        $sections = [];
        if ($classesID) {
            $sections = Section::where('classesID', $classesID)->get();
        }

        return view('attendance.index', compact('classes', 'classesID', 'sections'));
    }

    /**
     * Show the form for taking attendance.
     */
    public function add(Request $request)
    {
        $classesID = $request->get('classesID');
        $sectionID = $request->get('sectionID');
        $date = $request->get('date', date('d-m-Y'));
        $subjectID = $request->get('subjectID');

        if (!$classesID || !$sectionID) {
            return redirect()->route('attendance.index')->with('error', 'Seleccione clase y sección.');
        }

        $classes = Classes::findOrFail($classesID);
        $section = Section::findOrFail($sectionID);
        
        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        $subjects = [];
        if ($attendance_type == 'subject') {
            $subjects = Subject::where('classesID', $classesID)->get();
            if (!$subjectID && count($subjects) > 0) {
                // If no subject selected but required, we might need a selection step
                // For now, let's assume one is needed.
            }
        }

        $carbonDate = Carbon::createFromFormat('d-m-Y', $date);
        $day = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $day;

        $students = Student::where('classesID', $classesID)
            ->where('sectionID', $sectionID)
            ->get();

        $attendances = [];
        if ($attendance_type == 'subject' && $subjectID) {
            $attendances = SubjectAttendance::where('classesID', $classesID)
                ->where('sectionID', $sectionID)
                ->where('subjectID', $subjectID)
                ->where('monthyear', $monthyear)
                ->get()
                ->keyBy('studentID');
        } else {
            $attendances = Attendance::where('classesID', $classesID)
                ->where('sectionID', $sectionID)
                ->where('monthyear', $monthyear)
                ->get()
                ->keyBy('studentID');
        }

        return view('attendance.add', compact(
            'classes', 'section', 'date', 'day', 'monthyear', 'aday', 
            'students', 'attendances', 'attendance_type', 'subjects', 'subjectID'
        ));
    }

    /**
     * Store or update attendance for a single student via AJAX or form.
     */
    public function save(Request $request)
    {
        $request->validate([
            'studentID' => 'required|exists:students,studentID',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:sections,sectionID',
            'date' => 'required|date_format:d-m-Y',
            'status' => 'required|in:P,A,L', // Present, Absent, Late
        ]);

        $carbonDate = Carbon::createFromFormat('d-m-Y', $request->date);
        $day = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $day;
        
        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        if ($attendance_type == 'subject') {
            $request->validate(['subjectID' => 'required|exists:subject,subjectID']);
            
            $attendance = SubjectAttendance::firstOrCreate([
                'studentID' => $request->studentID,
                'classesID' => $request->classesID,
                'sectionID' => $request->sectionID,
                'subjectID' => $request->subjectID,
                'monthyear' => $monthyear,
                'schoolyearID' => 1, // Default or session based
            ], [
                'userID' => Auth::id(),
                'usertype' => Auth::user()->usertypeID ?? 'Admin',
            ]);
        } else {
            $attendance = Attendance::firstOrCreate([
                'studentID' => $request->studentID,
                'classesID' => $request->classesID,
                'sectionID' => $request->sectionID,
                'monthyear' => $monthyear,
                'schoolyearID' => 1,
            ], [
                'userID' => Auth::id(),
                'usertype' => Auth::user()->usertypeID ?? 'Admin',
            ]);
        }

        $attendance->$aday = $request->status;
        $attendance->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Asistencia guardada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $student = Student::with(['classes', 'section'])->findOrFail($id);
        $monthyear = $request->get('monthyear', date('m-Y'));
        
        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        $attendances = [];
        if ($attendance_type == 'subject') {
            $attendances = SubjectAttendance::where('studentID', $id)
                ->where('monthyear', $monthyear)
                ->with('subject')
                ->get();
        } else {
            $attendances = Attendance::where('studentID', $id)
                ->where('monthyear', $monthyear)
                ->get();
        }

        return view('attendance.show', compact('student', 'attendances', 'monthyear', 'attendance_type'));
    }
}
