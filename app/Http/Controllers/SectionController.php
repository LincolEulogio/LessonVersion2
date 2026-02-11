<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $classes = Classes::all();
        
        $query = Section::leftJoin('classes', 'section.classesID', '=', 'classes.classesID')
            ->leftJoin('teachers', 'section.teacherID', '=', 'teachers.teacherID')
            ->select('section.*', 'classes.classes as class_name', 'teachers.name as teacher_name');

        if ($classesID) {
            $query->where('section.classesID', $classesID);
        }

        $sections = $query->get();
            
        return view('section.index', compact('sections', 'classes', 'classesID'));
    }

    public function create()
    {
        $classes = Classes::all();
        $teachers = Teacher::where('active', 1)->get();
        return view('section.create', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'section' => 'required|string|max:60',
            'category' => 'required|string|max:128',
            'capacity' => 'required|numeric|min:1',
            'classesID' => 'required|exists:classes,classesID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'note' => 'nullable|string|max:200',
        ]);

        // Check uniqueness per class
        $exists = Section::where('classesID', $request->classesID)
            ->where('section', $request->section)
            ->exists();
            
        if ($exists) {
            return back()->withErrors(['section' => 'Esta sección ya existe para la clase seleccionada.'])->withInput();
        }

        $data = $request->all();
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_username'] = Auth::user()->username;
        $data['create_usertype'] = Auth::user()->usertypeID;

        Section::create($data);

        return redirect()->route('section.index', ['classesID' => $request->classesID])->with('success', 'Sección creada exitosamente.');
    }

    public function show($id)
    {
        $section = Section::leftJoin('classes', 'section.classesID', '=', 'classes.classesID')
            ->leftJoin('teachers', 'section.teacherID', '=', 'teachers.teacherID')
            ->select('section.*', 'classes.classes as class_name', 'teachers.name as teacher_name')
            ->where('section.sectionID', $id)
            ->firstOrFail();
            
        return view('section.show', compact('section'));
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        $classes = Classes::all();
        $teachers = Teacher::where('active', 1)->get();
        return view('section.edit', compact('section', 'classes', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        
        $validated = $request->validate([
            'section' => 'required|string|max:60',
            'category' => 'required|string|max:128',
            'capacity' => 'required|numeric|min:1',
            'classesID' => 'required|exists:classes,classesID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'note' => 'nullable|string|max:200',
        ]);

        // Check uniqueness per class excluding current
        $exists = Section::where('classesID', $request->classesID)
            ->where('section', $request->section)
            ->where('sectionID', '!=', $id)
            ->exists();
            
        if ($exists) {
            return back()->withErrors(['section' => 'Esta sección ya existe para la clase seleccionada.'])->withInput();
        }

        $data = $request->all();
        $data['modify_date'] = now();

        $section->update($data);

        return redirect()->route('section.index', ['classesID' => $request->classesID])->with('success', 'Sección actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $section = Section::findOrFail($id);
        $classesID = $section->classesID;
        $section->delete();

        return redirect()->route('section.index', ['classesID' => $classesID])->with('success', 'Sección eliminada exitosamente.');
    }
}
