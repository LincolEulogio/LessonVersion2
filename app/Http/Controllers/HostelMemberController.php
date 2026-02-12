<?php

namespace App\Http\Controllers;

use App\Models\Hmember;
use App\Models\Hostel;
use App\Models\Category;
use App\Models\Student;
use Illuminate\Http\Request;

class HostelMemberController extends Controller
{
    public function index(Request $request)
    {
        $classID = $request->get('classID');
        
        $query = Student::query();
        if ($classID) {
            $query->where('classesID', $classID);
        }
        
        $students = $query->with(['hmember.hostel', 'hmember.category', 'classes'])->get();
        $classes = \App\Models\Classes::all();
        
        return view('hmember.index', compact('students', 'classes', 'classID'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'studentID' => 'required|exists:student,studentID',
            'hostelID' => 'required|exists:hostel,hostelID',
            'categoryID' => 'required|exists:category,categoryID',
        ]);

        $category = Category::findOrFail($request->categoryID);

        Hmember::create([
            'studentID' => $request->studentID,
            'hostelID' => $request->hostelID,
            'categoryID' => $request->categoryID,
            'hbalance' => $category->hbalance,
            'hjoindate' => now(),
        ]);

        return redirect()->back()->with('success', 'Estudiante registrado en el hostal correctamente.');
    }

    public function destroy($id)
    {
        $hmember = Hmember::findOrFail($id);
        $hmember->delete();

        return redirect()->back()->with('success', 'Estudiante eliminado del hostal correctamente.');
    }
}
