<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Tattendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TeacherAttendanceController extends Controller
{
    /**
     * Display selection form or dashboard for teacher attendance.
     */
    public function index(Request $request)
    {
        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('teacher_attendance.index', compact('teachers'));
    }

    /**
     * Show form for marking teacher attendance on a specific date.
     */
    public function add(Request $request)
    {
        $request->validate([
            'date' => 'required|string',
        ], [
            'date.required' => 'La fecha es obligatoria.',
        ]);

        $dateInput = $request->get('date');
        
        try {
            $carbonDate = \Illuminate\Support\Carbon::parse($dateInput);
        } catch (\Exception $e) {
            $carbonDate = \Illuminate\Support\Carbon::now();
        }

        $dateInput = $carbonDate->format('d-m-Y');
        $dayNum = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $dayNum;

        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        $schoolyearID = session('default_schoolyearID') ?? 1;
        
        $attendances = Tattendance::where('monthyear', $monthyear)
            ->where('schoolyearID', $schoolyearID)
            ->get()
            ->keyBy('teacherID');

        return view('teacher_attendance.add', compact('dateInput', 'dayNum', 'monthyear', 'aday', 'teachers', 'attendances'));
    }

    /**
     * Save/Update attendance status for a single teacher.
     */
    public function save(Request $request)
    {
        $request->validate([
            'teacherID' => 'required|exists:teachers,teacherID',
            'date' => 'required|string',
            'status' => 'required|in:P,A,L,N', // P: Presente, A: Ausente, L: Tarde, N: Ninguno/Limpiar
        ], [
            'teacherID.required' => 'El ID del docente es obligatorio.',
            'teacherID.exists' => 'El docente seleccionado no existe.',
            'date.required' => 'La fecha es obligatoria.',
            'status.required' => 'El estado de asistencia es obligatorio.',
            'status.in' => 'El estado seleccionado no es válido.',
        ]);

        try {
            $carbonDate = Carbon::createFromFormat('d-m-Y', $request->date);
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
        
        // Si el estado es 'N', limpiamos el registro (ponemos null)
        $statusValue = ($request->status === 'N') ? null : $request->status;

        $attendance = Tattendance::firstOrCreate([
            'teacherID' => $request->teacherID,
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
        $teacher = Teacher::findOrFail($id);
        $monthyearInput = $request->get('monthyear', date('m-Y'));
        
        // Validar formato monthyear si es provisto
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
