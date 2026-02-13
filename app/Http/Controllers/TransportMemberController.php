<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Models\TransportMember;
use App\Models\Classes;
use App\Models\Student;
use App\Http\Requests\StoreTransportMemberRequest;
use App\Http\Requests\UpdateTransportMemberRequest;
use Illuminate\Http\Request;

class TransportMemberController extends Controller
{
    /**
     * Display a listing of transport members.
     */
    public function index(Request $request)
    {
        $classID = $request->get('classID');
        
        $query = Student::query();
        if ($classID) {
            $query->where('classesID', $classID);
        }
        
        // Use with() to avoid N+1 issues
        $students = $query->with(['classes', 'transportMember.transport'])->get();
        $classes = Classes::all();
        $transports = Transport::all();
        
        return view('tmember.index', compact('students', 'classes', 'classID', 'transports'));
    }

    /**
     * Show the form for creating a new transport member assignment.
     */
    public function create(Request $request)
    {
        $selectedStudentID = $request->get('studentID');
        
        // Get students not in transport, but include the selected one if it exists
        $assignedStudentIds = TransportMember::pluck('studentID')->toArray();
        $students = Student::whereNotIn('studentID', $assignedStudentIds);
        
        if ($selectedStudentID) {
            $students->orWhere('studentID', $selectedStudentID);
        }
        
        $students = $students->get();
        $transports = Transport::all();
        
        return view('tmember.create', compact('students', 'transports', 'selectedStudentID'));
    }

    /**
     * Store a newly created transport member.
     */
    public function store(StoreTransportMemberRequest $request)
    {
        $transport = Transport::findOrFail($request->transportID);

        TransportMember::create([
            'studentID' => $request->studentID,
            'transportID' => $request->transportID,
            'tbalance' => $request->tbalance ?? $transport->cost,
            'tjoindate' => $request->tjoindate ?? now(),
        ]);

        return redirect()->route('tmember.index')->with('success', 'Estudiante registrado en el transporte correctamente.');
    }

    /**
     * Display the specified transport member.
     */
    public function show($id)
    {
        $tmember = TransportMember::with(['student.classes', 'transport'])->findOrFail($id);
        return view('tmember.show', compact('tmember'));
    }

    /**
     * Show the form for editing the specified transport member.
     */
    public function edit($id)
    {
        $tmember = TransportMember::with('student')->findOrFail($id);
        $transports = Transport::all();
        return view('tmember.edit', compact('tmember', 'transports'));
    }

    /**
     * Update the specified transport member.
     */
    public function update(UpdateTransportMemberRequest $request, $id)
    {
        $tmember = TransportMember::findOrFail($id);
        
        $tmember->update($request->validated());

        return redirect()->route('tmember.index')->with('success', 'Membresía de transporte actualizada correctamente.');
    }

    /**
     * Remove the specified transport member.
     */
    public function destroy($id)
    {
        $tmember = TransportMember::findOrFail($id);
        $tmember->delete();

        return redirect()->back()->with('success', 'Estudiante eliminado del transporte correctamente.');
    }
}
