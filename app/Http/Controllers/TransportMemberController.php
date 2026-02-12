<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Models\TransportMember;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;

class TransportMemberController extends Controller
{
    public function index(Request $request)
    {
        $classID = $request->get('classID');
        
        $query = Student::query();
        if ($classID) {
            $query->where('classesID', $classID);
        }
        
        $students = $query->with(['transportMember.transport', 'classes'])->get();
        $classes = Classes::all();
        $transports = Transport::all();
        
        return view('tmember.index', compact('students', 'classes', 'classID', 'transports'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'studentID' => 'required|exists:students,studentID',
            'transportID' => 'required|exists:transport,transportID',
        ]);

        $transport = Transport::findOrFail($request->transportID);

        TransportMember::create([
            'studentID' => $request->studentID,
            'transportID' => $request->transportID,
            'tbalance' => $transport->cost,
            'tjoindate' => now(),
        ]);

        return redirect()->back()->with('success', 'Estudiante registrado en el transporte correctamente.');
    }

    public function destroy($id)
    {
        $tmember = TransportMember::findOrFail($id);
        $tmember->delete();

        return redirect()->back()->with('success', 'Estudiante eliminado del transporte correctamente.');
    }
}
