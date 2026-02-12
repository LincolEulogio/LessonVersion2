<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\SubjectAttendance;
use App\Models\Setting;
use App\Models\Subject;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        return view('report.index');
    }

    public function classReport(Request $request)
    {
        $classes = Classes::all();
        $classesID = $request->get('classesID');
        $sectionID = $request->get('sectionID');
        
        $sections = [];
        if ($classesID) {
            $sections = Section::where('classesID', $classesID)->get();
        }

        $students = [];
        if ($classesID) {
            $query = Student::where('classesID', $classesID);
            if ($sectionID) {
                $query->where('sectionID', $sectionID);
            }
            $students = $query->get();
        }

        return view('report.class', compact('classes', 'sections', 'students', 'classesID', 'sectionID'));
    }

    public function attendanceReport(Request $request)
    {
        $classes = Classes::all();
        $classesID = $request->get('classesID');
        $sectionID = $request->get('sectionID');
        $date = $request->get('date', date('d-m-Y'));
        
        $sections = [];
        if ($classesID) {
            $sections = Section::where('classesID', $classesID)->get();
        }

        $attendance_type = Setting::where('fieldname', 'attendance')->first()->value ?? 'daily';
        
        $reportData = [];
        if ($classesID && $sectionID) {
            $carbonDate = Carbon::createFromFormat('d-m-Y', $date);
            $day = $carbonDate->day;
            $monthyear = $carbonDate->format('m-Y');
            $aday = "a" . $day;

            $students = Student::where('classesID', $classesID)
                ->where('sectionID', $sectionID)
                ->get();

            if ($attendance_type == 'subject') {
                $attendances = SubjectAttendance::where('classesID', $classesID)
                    ->where('sectionID', $sectionID)
                    ->where('monthyear', $monthyear)
                    ->get()
                    ->groupBy('studentID');
                
                $subjects = Subject::where('classesID', $classesID)->get();

                foreach ($students as $student) {
                    $studentAttendance = $attendances->get($student->studentID, collect());
                    $reportData[$student->studentID] = [
                        'name' => $student->name,
                        'roll' => $student->roll,
                        'subjects' => []
                    ];
                    
                    foreach ($subjects as $subject) {
                        $sAtt = $studentAttendance->where('subjectID', $subject->subjectID)->first();
                        $reportData[$student->studentID]['subjects'][$subject->subjectID] = $sAtt ? $sAtt->$aday : '-';
                    }
                }
            } else {
                $attendances = Attendance::where('classesID', $classesID)
                    ->where('sectionID', $sectionID)
                    ->where('monthyear', $monthyear)
                    ->get()
                    ->keyBy('studentID');

                foreach ($students as $student) {
                    $att = $attendances->get($student->studentID);
                    $reportData[] = [
                        'name' => $student->name,
                        'roll' => $student->roll,
                        'status' => $att ? $att->$aday : '-'
                    ];
                }
            }
        }

        return view('report.attendance', compact('classes', 'sections', 'reportData', 'classesID', 'sectionID', 'date', 'attendance_type'));
    }

    public function studentReport(Request $request)
    {
        $classes = Classes::all();
        $classesID = $request->get('classesID');
        $studentID = $request->get('studentID');
        
        $students = [];
        if ($classesID) {
            $students = Student::where('classesID', $classesID)->get();
        }

        $student = null;
        if ($studentID) {
            $student = Student::with(['classes', 'section', 'parent'])->findOrFail($studentID);
        }

        return view('report.student', compact('classes', 'students', 'student', 'classesID', 'studentID'));
    }
}
