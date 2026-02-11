<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Exam;
use App\Models\Mark;
use App\Models\Markpercentage;
use App\Models\Markrelation;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    public function index(Request $request)
    {
        $classes = Classes::all();
        $classesID = $request->query('classesID');
        
        $sections = collect();
        if ($classesID) {
            $sections = Section::where('classesID', $classesID)->get();
        }

        return view('mark.index', compact('classes', 'classesID', 'sections'));
    }

    public function add(Request $request)
    {
        $classesID = $request->input('classesID');
        $sectionID = $request->input('sectionID');
        $subjectID = $request->input('subjectID');
        $examID = $request->input('examID');

        // Initial Load or Filter Change
        if (!$classesID || !$sectionID || !$subjectID || !$examID) {
            $classes = Classes::all();
            $exams = Exam::all();
            
            $sections = $classesID ? Section::where('classesID', $classesID)->get() : collect();
            $subjects = $classesID ? Subject::where('classesID', $classesID)->get() : collect();

            return view('mark.add', compact('classes', 'exams', 'sections', 'subjects', 'classesID', 'sectionID', 'subjectID', 'examID'));
        }

        // Fetch Data for Grading Interface
        $students = Student::where('classesID', $classesID)
            ->where('sectionID', $sectionID)
            ->with(['marks' => function($query) use ($examID, $subjectID) {
                $query->where('examID', $examID)
                      ->where('subjectID', $subjectID);
            }])
            ->get();

        $mark_percentages = Markpercentage::all(); // Get all configured percentages

        // Attach existing marks to students for easy access in view
        foreach ($students as $student) {
            $student_mark = $student->marks->first();
            $student->mark_relations = collect();

            if ($student_mark) {
                $relations = Markrelation::where('markID', $student_mark->markID)->get();
                $student->mark_relations = $relations->pluck('mark', 'markpercentageID');
            }
        }
        
        $classes = Classes::all();
        $exams = Exam::all();
        $sections = Section::where('classesID', $classesID)->get();
        $subjects = Subject::where('classesID', $classesID)->get();

        return view('mark.add', compact('classes', 'exams', 'sections', 'subjects', 'students', 'mark_percentages', 'classesID', 'sectionID', 'subjectID', 'examID'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'examID' => 'required',
            'classesID' => 'required',
            'subjectID' => 'required',
            'inputs' => 'required|array'
        ]);

        $year = date('Y');
        $schoolyearID = 1; // Default for now
        
        DB::beginTransaction();
        try {
            foreach ($request->inputs as $input) {
                // $input format: ['mark' => 'markpercentageID-studentID', 'value' => 'score']
                $parts = explode('-', $input['mark']);
                $markpercentageID = $parts[0];
                $studentID = $parts[1];
                $value = $input['value'];

                // Find or Create Mark Record
                $mark = Mark::firstOrCreate(
                    [
                        'examID' => $request->examID,
                        'classesID' => $request->classesID,
                        'subjectID' => $request->subjectID,
                        'studentID' => $studentID,
                        'schoolyearID' => $schoolyearID,
                        'year' => $year
                    ],
                    [
                        'sectionID' => $request->sectionID, // Assuming sectionID is passed or retrieved
                        'mark' => '', // Total mark can be calculated later
                    ]
                );

                // Update/Insert Mark Relation
                Markrelation::updateOrCreate(
                    [
                        'markID' => $mark->markID,
                        'markpercentageID' => $markpercentageID
                    ],
                    [
                        'mark' => $value
                    ]
                );
            }
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Notas guardadas correctamente.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Error al guardar notas: ' . $e->getMessage()], 500);
        }
    }
}
