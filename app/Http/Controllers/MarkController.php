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
use App\Http\Requests\SaveMarkRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarkController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('promedio_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

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
        if (!Auth::user()->hasPermission('promedio_view') && !Auth::user()->hasPermission('promedio_add')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

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

            $mark_percentages = Markpercentage::all();
            return view('mark.add', compact('classes', 'exams', 'sections', 'subjects', 'classesID', 'sectionID', 'subjectID', 'examID', 'mark_percentages'));
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

    public function save(SaveMarkRequest $request)
    {
        $validated = $request->validated();
        $mark_percentages = Markpercentage::all() ?: collect();
        $year = date('Y');
        $schoolyearID = session('default_schoolyearID') ?? 1;
        
        DB::beginTransaction();
        try {
            foreach ($validated['inputs'] as $input) {
                $parts = explode('-', $input['mark']);
                $markpercentageID = $parts[0];
                $studentID = $parts[1];
                $value = $input['value'];

                $mark = Mark::updateOrCreate(
                    [
                        'examID' => $validated['examID'],
                        'classesID' => $validated['classesID'],
                        'subjectID' => $validated['subjectID'],
                        'studentID' => $studentID,
                        'schoolyearID' => $schoolyearID,
                        'year' => $year
                    ],
                    [
                        'sectionID' => $validated['sectionID'],
                        'mark' => 0,
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
                
                // Recalculate total mark as average
                $sum = Markrelation::where('markID', $mark->markID)->sum('mark');
                $count = $mark_percentages->count() ?: 1;
                $average = $sum / $count;
                $roundedAverage = round($average);
                $mark->update(['mark' => $roundedAverage]);
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
        if (!Auth::user()->hasPermission('promedio_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $student = Student::with(['classes', 'section'])->findOrFail($id);
        
        // Restriction for Students: they can only see their own marks
        $user = Auth::user();
        if ($user->usertypeID == 3 && $user->studentID != $id) {
            abort(403, 'No tienes permiso para ver las calificaciones de otro estudiante.');
        }

        // Restriction for Parents: they can only see their child's marks
        if ($user->usertypeID == 4) {
            $isChild = Student::where('studentID', $id)->where('parentID', $user->parentID)->exists();
            if (!$isChild) {
                abort(403, 'No tienes permiso para ver las calificaciones de este estudiante.');
            }
        }

        $exams = Exam::all();
        $marks = Mark::where('studentID', $id)
            ->with(['exam', 'subject', 'relations.percentage'])
            ->get()
            ->groupBy('examID');

        return view('mark.show', compact('student', 'exams', 'marks'));
    }
}
