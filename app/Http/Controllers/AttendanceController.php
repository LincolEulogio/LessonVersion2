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
use App\Http\Requests\GetAttendanceRequest;
use App\Http\Requests\SaveAttendanceRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource for class/section/date selection.
     */
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('asistencia_de_estudiante_view') && !Auth::user()->hasPermission('asistencia_de_estudiante_add')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $user = Auth::user();
        if ($user->usertypeID == 3) { // Estudiante
            return redirect()->route('attendance.show', $user->studentID);
        }

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
    public function add(GetAttendanceRequest $request)
    {
        $data = $request->validated();
        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        $classesID = $data['classesID'];
        $sectionID = $data['sectionID'];
        $dateInput = $data['date'];
        $subjectID = $data['subjectID'] ?? null;

        $class = Classes::findOrFail($classesID);
        $section = Section::findOrFail($sectionID);
        
        $subjects = [];
        if ($attendance_type == 'subject') {
            $subjects = Subject::where('classesID', $classesID)->orderBy('subject')->get();
        }

        $carbonDate = Carbon::parse($dateInput);
        $dateDisplay = $carbonDate->format('d-m-Y');

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
            'class', 'section', 'dateInput', 'dateDisplay', 'dayNum', 'monthyear', 'aday', 
            'students', 'attendances', 'attendance_type', 'subjects', 'subjectID'
        ));
    }

    /**
     * Save attendance status for a student.
     */
    public function save(SaveAttendanceRequest $request)
    {
        $data = $request->validated();

        try {
            $carbonDate = Carbon::createFromFormat('d-m-Y', $data['date']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Fecha inválida'], 400);
        }

        $dayNum = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $dayNum;
        $schoolyearID = session('default_schoolyearID') ?? 1;
        
        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        $status = $data['status'] == 'N' ? null : $data['status'];

        if ($attendance_type == 'subject') {
            $attendance = SubjectAttendance::firstOrCreate([
                'studentID' => $data['studentID'],
                'classesID' => $data['classesID'],
                'sectionID' => $data['sectionID'],
                'subjectID' => $data['subjectID'],
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
                'studentID' => $data['studentID'],
                'classesID' => $data['classesID'],
                'sectionID' => $data['sectionID'],
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
        if (!Auth::user()->hasPermission('asistencia_de_estudiante_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $user = Auth::user();
        
        // Restriction for Students: they can only see their own attendance
        if ($user->usertypeID == 3 && $user->studentID != $id) {
            abort(403, 'No tienes permiso para ver la asistencia de otro estudiante.');
        }

        // Restriction for Parents: they can only see their child's attendance
        if ($user->usertypeID == 4) {
            // Parents model has parentsID, but Student model uses parentID FK
            $isChild = Student::where('studentID', $id)->where('parentID', $user->parentsID)->exists();
            if (!$isChild) {
                abort(403, 'No tienes permiso para ver la asistencia de este estudiante.');
            }
        }

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
