<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Tattendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TeacherAttendanceController extends Controller
{
    public function index()
    {
        $teachers = Teacher::where('active', 1)->get();
        return view('teacher_attendance.index', compact('teachers'));
    }

    public function add(Request $request)
    {
        $date = $request->get('date', date('d-m-Y'));
        try {
            $carbonDate = Carbon::createFromFormat('d-m-Y', $date);
        } catch (\Exception $e) {
            $date = date('d-m-Y');
            $carbonDate = Carbon::createFromFormat('d-m-Y', $date);
        }
        
        $day = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $day;

        $teachers = Teacher::where('active', 1)->get();
        $attendances = Tattendance::where('monthyear', $monthyear)->get()->keyBy('teacherID');

        return view('teacher_attendance.add', compact('date', 'day', 'monthyear', 'aday', 'teachers', 'attendances'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'teacherID' => 'required|exists:teachers,teacherID',
            'date' => 'required|date_format:d-m-Y',
            'status' => 'required|in:P,A,L',
        ]);

        $carbonDate = Carbon::createFromFormat('d-m-Y', $request->date);
        $day = $carbonDate->day;
        $monthyear = $carbonDate->format('m-Y');
        $aday = "a" . $day;

        $attendance = Tattendance::firstOrCreate([
            'teacherID' => $request->teacherID,
            'monthyear' => $monthyear,
            'schoolyearID' => 1,
        ], [
            'usertypeID' => 2,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => Auth::id(),
            'create_usertypeID' => Auth::user()->usertypeID ?? 1,
        ]);

        $attendance->$aday = $request->status;
        $attendance->modify_date = now();
        $attendance->save();

        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Asistencia de docente guardada.');
    }

    public function show($id, Request $request)
    {
        $teacher = Teacher::findOrFail($id);
        $monthyear = $request->get('monthyear', date('m-Y'));
        
        $attendances = Tattendance::where('teacherID', $id)
            ->where('monthyear', $monthyear)
            ->get();

        return view('teacher_attendance.show', compact('teacher', 'attendances', 'monthyear'));
    }
}
