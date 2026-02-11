<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LibraryMember;
use App\Models\Student;
use App\Models\Classes;

class LibraryMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classes = Classes::orderBy('classesID', 'asc')->get();
        $classID = $request->get('classID', $classes->first()?->classesID);
        
        $students = Student::where('classesID', $classID)
                           ->orderBy('studentID', 'asc')
                           ->get();
                           
        $members = LibraryMember::pluck('studentID')->toArray();

        return view('lmember.index', compact('classes', 'students', 'members', 'classID'));
    }

    /**
     * Store a newly created resource in storage (Add membership).
     */
    public function store(Request $request)
    {
        $request->validate([
            'studentID' => 'required|exists:student,studentID',
            'lID' => 'required|string|unique:lmember,lID',
            'lbalance' => 'nullable|numeric|min:0'
        ]);

        $student = Student::findOrFail($request->studentID);

        LibraryMember::create([
            'lID' => $request->lID,
            'studentID' => $student->studentID,
            'name' => $student->name,
            'email' => $student->email,
            'phone' => $student->phone,
            'lbalance' => $request->lbalance ?? 0,
            'ljoindate' => now()->toDateString()
        ]);

        $student->update(['library' => 1]);

        return redirect()->back()->with('success', 'Estudiante registrado en la biblioteca.');
    }

    /**
     * Remove membership.
     */
    public function destroy(string $id)
    {
        $member = LibraryMember::where('studentID', $id)->firstOrFail();
        $student = Student::findOrFail($id);

        $member->delete();
        $student->update(['library' => 0]);

        return redirect()->back()->with('success', 'Membresía de biblioteca eliminada.');
    }
}
