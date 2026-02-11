<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $classes = Classes::all();
        
        $query = Subject::leftJoin('classes', 'subject.classesID', '=', 'classes.classesID')
            ->leftJoin('teachers', 'subject.teacherID', '=', 'teachers.teacherID')
            ->select('subject.*', 'classes.classes as class_name', 'teachers.name as teacher_name');

        if ($classesID) {
            $query->where('subject.classesID', $classesID);
        }

        $subjects = $query->get();
            
        return view('subject.index', compact('subjects', 'classes', 'classesID'));
    }

    public function create()
    {
        $classes = Classes::all();
        $teachers = Teacher::where('active', 1)->get();
        return view('subject.create', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:60',
            'subject_code' => 'required|string|max:20|unique:subject,subject_code',
            'classesID' => 'required|exists:classes,classesID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'type' => 'required|in:1,2', // 1=Mandatory, 2=Optional (usually based on legacy usertype logic, but here it's mandatory/optional)
            'passmark' => 'required|numeric|min:0',
            'finalmark' => 'required|numeric|min:0',
            'subject_author' => 'nullable|string|max:100',
        ]);

        // Check uniqueness per class
        $exists = Subject::where('classesID', $request->classesID)
            ->where('subject', $request->subject)
            ->exists();
            
        if ($exists) {
            return back()->withErrors(['subject' => 'Esta materia ya existe para la clase seleccionada.'])->withInput();
        }

        $teacher = Teacher::findOrFail($request->teacherID);

        $data = $request->all();
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_usertypeID'] = Auth::user()->usertypeID;

        Subject::create($data);

        return redirect()->route('subject.index', ['classesID' => $request->classesID])->with('success', 'Materia creada exitosamente.');
    }

    public function show($id)
    {
        $subject = Subject::leftJoin('classes', 'subject.classesID', '=', 'classes.classesID')
            ->leftJoin('teachers', 'subject.teacherID', '=', 'teachers.teacherID')
            ->select('subject.*', 'classes.classes as class_name', 'teachers.name as teacher_name')
            ->where('subject.subjectID', $id)
            ->firstOrFail();
            
        return view('subject.show', compact('subject'));
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $classes = Classes::all();
        $teachers = Teacher::where('active', 1)->get();
        return view('subject.edit', compact('subject', 'classes', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        
        $validated = $request->validate([
            'subject' => 'required|string|max:60',
            'subject_code' => 'required|string|max:20|unique:subject,subject_code,'.$id.',subjectID',
            'classesID' => 'required|exists:classes,classesID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'type' => 'required|in:1,2',
            'passmark' => 'required|numeric|min:0',
            'finalmark' => 'required|numeric|min:0',
            'subject_author' => 'nullable|string|max:100',
        ]);

        // Check uniqueness per class excluding current
        $exists = Subject::where('classesID', $request->classesID)
            ->where('subject', $request->subject)
            ->where('subjectID', '!=', $id)
            ->exists();
            
        if ($exists) {
            return back()->withErrors(['subject' => 'Esta materia ya existe para la clase seleccionada.'])->withInput();
        }

        $data = $request->all();
        $data['modify_date'] = now();

        $subject->update($data);

        return redirect()->route('subject.index', ['classesID' => $request->classesID])->with('success', 'Materia actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $classesID = $subject->classesID;
        $subject->delete();

        return redirect()->route('subject.index', ['classesID' => $classesID])->with('success', 'Materia eliminada exitosamente.');
    }
}
