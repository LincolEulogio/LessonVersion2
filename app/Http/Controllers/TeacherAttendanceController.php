<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Tattendance;
use Illuminate\Http\Request;
use App\Http\Requests\GetTeacherAttendanceRequest;
use App\Http\Requests\SaveTeacherAttendanceRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TeacherAttendanceController extends Controller
{
    /**
     * Display selection form or dashboard for teacher attendance.
     */
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('asistencia_docente_view') && !Auth::user()->hasPermission('asistencia_docente_add')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $user = Auth::user();
        if ($user->usertypeID == 2) { // Docente
            return redirect()->route('tattendance.show', $user->teacherID);
        }

        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('teacher_attendance.index', compact('teachers'));
    }

    /**
     * Show form for marking teacher attendance on a specific date.
     */
    public function add(GetTeacherAttendanceRequest $request)
    {
        $data = $request->validated();
        $dateInput = $data['date'];
        
        $carbonDate = Carbon::parse($dateInput);
        $dateDisplay = $carbonDate->format('d-m-Y');

        $dayNum = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $dayNum;

        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        $schoolyearID = session('default_schoolyearID') ?? 1;
        
        $attendances = Tattendance::where('monthyear', $monthyear)
            ->where('schoolyearID', $schoolyearID)
            ->get()
            ->keyBy('teacherID');

        return view('teacher_attendance.add', compact('dateInput', 'dateDisplay', 'dayNum', 'monthyear', 'aday', 'teachers', 'attendances'));
    }

    /**
     * Save/Update attendance status for a single teacher.
     */
    public function save(SaveTeacherAttendanceRequest $request)
    {
        $data = $request->validated();

        try {
            $carbonDate = Carbon::createFromFormat('d-m-Y', $data['date']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'El formato de fecha no es válido (d-m-Y).'
            ], 400);
        }

        $dayNum = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $dayNum;
        $schoolyearID = session('default_schoolyearID') ?? 1;
        
        $statusValue = ($data['status'] === 'N') ? null : $data['status'];

        $attendance = Tattendance::firstOrCreate([
            'teacherID' => $data['teacherID'],
            'monthyear' => $monthyear,
            'schoolyearID' => $schoolyearID,
        ], [
            'usertypeID' => 2, // Tipo Docente
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => Auth::id(),
            'create_usertypeID' => Auth::user()->usertypeID ?? 1,
            'create_username' => Auth::user()->username,
            'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
        ]);

        $attendance->$aday = $statusValue;
        $attendance->modify_date = now();
        $attendance->save();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Asistencia registrada correctamente.'
            ]);
        }

        return back()->with('success', 'Asistencia de docente actualizada correctamente.');
    }

    /**
     * Show monthly attendance report for a specific teacher.
     */
    public function show($id, Request $request)
    {
        if (!Auth::user()->hasPermission('asistencia_docente_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $user = Auth::user();
        if ($user->usertypeID == 2 && $user->teacherID != $id) {
            abort(403, 'No tienes permiso para ver la asistencia de otro docente.');
        }

        $teacher = Teacher::findOrFail($id);
        $monthyearInput = $request->get('monthyear', date('m-Y'));
        
        if ($request->has('monthyear')) {
            try {
                Carbon::createFromFormat('m-Y', $monthyearInput);
            } catch (\Exception $e) {
                $monthyearInput = date('m-Y');
            }
        }

        $schoolyearID = session('default_schoolyearID') ?? 1;
        
        $attendances = Tattendance::where('teacherID', $id)
            ->where('monthyear', $monthyearInput)
            ->where('schoolyearID', $schoolyearID)
            ->get();

        try {
            $date = Carbon::createFromFormat('m-Y', $monthyearInput);
            $daysInMonth = $date->daysInMonth;
        } catch (\Exception $e) {
            $daysInMonth = 31;
        }

        return view('teacher_attendance.show', compact('teacher', 'attendances', 'monthyearInput', 'daysInMonth'));
    }
}
