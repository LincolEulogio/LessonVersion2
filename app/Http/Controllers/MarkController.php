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
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'examID' => 'required',
            'classesID' => 'required',
            'subjectID' => 'required',
            'inputs' => 'required|array',
            'inputs.*.mark' => 'required|string',
            'inputs.*.value' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => __('Error de validación global.'),
                'errors' => $validator->errors()
            ], 422);
        }

        $mark_percentages = Markpercentage::all()->keyBy('markpercentageID');
        $year = date('Y');
        $schoolyearID = 1; // Default
        
        $input_errors = [];
        foreach ($request->inputs as $index => $input) {
            $parts = explode('-', $input['mark']);
            $markpercentageID = $parts[0];
            $studentID = $parts[1];
            $value = $input['value'];

            $percentage = $mark_percentages->get($markpercentageID);
            if ($percentage && $value > $percentage->markpercentage_numeric) {
                $input_errors[$input['mark']] = [
                    __('El valor no puede superar :max', ['max' => $percentage->markpercentage_numeric])
                ];
            }
        }

        if (!empty($input_errors)) {
            return response()->json([
                'success' => false,
                'message' => __('Hay errores en las calificaciones ingresadas.'),
                'errors' => $input_errors
            ], 422);
        }

        DB::beginTransaction();
        try {
            foreach ($request->inputs as $input) {
                $parts = explode('-', $input['mark']);
                $markpercentageID = $parts[0];
                $studentID = $parts[1];
                $value = $input['value'];

                $mark = Mark::updateOrCreate(
                    [
                        'examID' => $request->examID,
                        'classesID' => $request->classesID,
                        'subjectID' => $request->subjectID,
                        'studentID' => $studentID,
                        'schoolyearID' => $schoolyearID,
                        'year' => $year
                    ],
                    [
                        'sectionID' => $request->sectionID,
                        'mark' => 0, // Calculated mark can be updated later or if needed
                    ]
                );

                Markrelation::updateOrCreate(
                    [
                        'markID' => $mark->markID,
                        'markpercentageID' => $markpercentageID
                    ],
                    [
                        'mark' => $value ?? 0
                    ]
                );
                
                // Recalculate total mark if necessary
                $total = Markrelation::where('markID', $mark->markID)->sum('mark');
                $mark->update(['mark' => $total]);
            }
            DB::commit();
            return response()->json([
                'success' => true, 
                'message' => __('¡Calificaciones guardadas con éxito!')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false, 
                'message' => __('Error al guardar: ') . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $student = Student::with(['classes', 'section'])->findOrFail($id);
        $exams = Exam::all();
        $marks = Mark::where('studentID', $id)
            ->with(['exam', 'subject', 'relations.percentage'])
            ->get()
            ->groupBy('examID');

        return view('mark.show', compact('student', 'exams', 'marks'));
    }
}
