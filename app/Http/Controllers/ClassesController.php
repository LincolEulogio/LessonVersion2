<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassesController extends Controller
{
    public function index()
    {
        $classes = Classes::leftJoin('teachers', 'classes.teacherID', '=', 'teachers.teacherID')
            ->select('classes.*', 'teachers.name as teacher_name')
            ->get();
            
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        $teachers = Teacher::where('active', 1)->get();
        return view('classes.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'classes' => 'required|string|max:60|unique:classes,classes',
            'classes_numeric' => 'required|numeric|unique:classes,classes_numeric',
            'teacherID' => 'required|exists:teachers,teacherID',
            'note' => 'nullable|string|max:200',
        ]);

        $data = $request->all();
        $data['studentmaxID'] = 999999999;
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_username'] = Auth::user()->username;
        $data['create_usertype'] = Auth::user()->usertypeID;

        Classes::create($data);

        return redirect()->route('classes.index')->with('success', 'Clase creada exitosamente.');
    }

    public function show($id)
    {
        $class = Classes::leftJoin('teachers', 'classes.teacherID', '=', 'teachers.teacherID')
            ->select('classes.*', 'teachers.name as teacher_name')
            ->where('classes.classesID', $id)
            ->firstOrFail();
            
        return view('classes.show', compact('class'));
    }

    public function edit($id)
    {
        $class = Classes::findOrFail($id);
        $teachers = Teacher::where('active', 1)->get();
        return view('classes.edit', compact('class', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $class = Classes::findOrFail($id);
        
        $validated = $request->validate([
            'classes' => 'required|string|max:60|unique:classes,classes,'.$id.',classesID',
            'classes_numeric' => 'required|numeric|unique:classes,classes_numeric,'.$id.',classesID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'note' => 'nullable|string|max:200',
        ]);

        $data = $request->all();
        $data['modify_date'] = now();

        $class->update($data);

        return redirect()->route('classes.index')->with('success', 'Clase actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        
        // Check if class has students or subjects before deleting (optional but recommended)
        // For now, mirroring legacy behavior which just deletes.
        
        $class->delete();

        return redirect()->route('classes.index')->with('success', 'Clase eliminada exitosamente.');
    }
}
