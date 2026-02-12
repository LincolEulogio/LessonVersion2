<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Section;
use App\Models\Student;
use App\Models\Schoolyear;
use App\Models\Promotionlog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    public function index(Request $request)
    {
        $classes = Classes::all();
        $schoolyears = Schoolyear::all();
        
        $classesID = $request->query('classesID');
        $schoolyearID = $request->query('schoolyearID');
        
        $students = [];
        if ($classesID && $schoolyearID) {
            $students = Student::where('classesID', $classesID)
                ->where('schoolyearID', $schoolyearID)
                ->get();
        }

        return view('promotion.index', compact('classes', 'schoolyears', 'students', 'classesID', 'schoolyearID'));
    }

    public function promote(Request $request)
    {
        $request->validate([
            'classesID' => 'required',
            'schoolyearID' => 'required',
            'promotion_classesID' => 'required',
            'promotion_schoolyearID' => 'required',
            'student_ids' => 'required|array'
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->student_ids as $studentID) {
                $student = Student::findOrFail($studentID);
                
                // Log the promotion
                Promotionlog::create([
                    'studentID' => $student->studentID,
                    'classesID' => $student->classesID,
                    'sectionID' => $student->sectionID,
                    'roll' => $student->roll,
                    'schoolyearID' => $student->schoolyearID,
                    'promotion_classesID' => $request->promotion_classesID,
                    'promotion_sectionID' => $student->sectionID, // Assuming same section for now
                    'promotion_roll' => $student->roll,
                    'promotion_schoolyearID' => $request->promotion_schoolyearID,
                    'create_date' => now(),
                    'create_userID' => Auth::id(),
                    'create_usertypeID' => 1 // Admin
                ]);

                // Update student record
                $student->update([
                    'classesID' => $request->promotion_classesID,
                    'schoolyearID' => $request->promotion_schoolyearID
                ]);
            }
            DB::commit();
            return redirect()->route('promotion.index')->with('success', 'Estudiantes promovidos correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error en la promoción: ' . $e->getMessage());
        }
    }
}
