<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibraryMember;
use App\Models\Student;
use App\Models\Classes;
use App\Http\Requests\StoreLibraryMemberRequest;
use App\Http\Requests\UpdateLibraryMemberRequest;

class LibraryMemberController extends Controller
{
    /**
     * Display a listing of library members.
     */
    public function index()
    {
        $members = LibraryMember::with(['student.classes'])->get();
        return view('lmember.index', compact('members'));
    }

    /**
     * Show the form for creating a new library member (student selection).
     */
    public function create(Request $request)
    {
        $classes = Classes::orderBy('classesID', 'asc')->get();
        $classID = $request->get('classID', $classes->first()?->classesID);
        
        $students = Student::where('classesID', $classID)
                           ->orderBy('studentID', 'asc')
                           ->get();
                           
        $existingMembers = LibraryMember::pluck('studentID')->toArray();

        return view('lmember.create', compact('classes', 'students', 'existingMembers', 'classID'));
    }

    /**
     * Store a newly created library member.
     */
    public function store(StoreLibraryMemberRequest $request)
    {
        $student = Student::findOrFail($request->studentID);

        LibraryMember::create([
            'lmembercardID' => $request->lmembercardID,
            'studentID' => $student->studentID,
            'name' => $student->name,
            'email' => $student->email,
            'phone' => $student->phone,
            'lbalance' => $request->lbalance,
            'ljoindate' => now()->toDateString()
        ]);

        $student->update(['library' => 1]);

        return redirect()->route('lmember.index')->with('success', 'Estudiante registrado en la biblioteca correctamente.');
    }

    /**
     * Display the specified library member.
     */
    public function show($id)
    {
        $lmember = LibraryMember::with(['student.classes', 'student.section'])->findOrFail($id);
        return view('lmember.show', compact('lmember'));
    }

    /**
     * Show the form for editing the specified library member.
     */
    public function edit($id)
    {
        $lmember = LibraryMember::with('student')->findOrFail($id);
        return view('lmember.edit', compact('lmember'));
    }

    /**
     * Update the specified library member in storage.
     */
    public function update(UpdateLibraryMemberRequest $request, $id)
    {
        $lmember = LibraryMember::findOrFail($id);
        $lmember->update($request->validated());

        return redirect()->route('lmember.index')->with('success', 'Membresía de biblioteca actualizada.');
    }

    /**
     * Remove the specified library member from storage.
     */
    public function destroy($id)
    {
        $lmember = LibraryMember::findOrFail($id);
        $student = Student::where('studentID', $lmember->studentID)->first();
        
        if ($student) {
            $student->update(['library' => 0]);
        }

        $lmember->delete();

        return redirect()->route('lmember.index')->with('success', 'Membresía de biblioteca eliminada.');
    }
}
