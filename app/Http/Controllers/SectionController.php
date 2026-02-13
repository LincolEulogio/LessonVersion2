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
        $search = $request->get('search');
        
        $classes = Classes::orderBy('classes_numeric')->get();
        
        $query = Section::with(['class'])
            ->leftJoin('teachers', 'section.teacherID', '=', 'teachers.teacherID')
            ->select('section.*', 'teachers.name as teacher_name', 'teachers.photo as teacher_photo');

        if ($classesID) {
            $query->where('section.classesID', $classesID);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('section.section', 'like', "%{$search}%")
                  ->orWhere('section.category', 'like', "%{$search}%")
                  ->orWhere('teachers.name', 'like', "%{$search}%");
            });
        }

        $sections = $query->latest('section.sectionID')->paginate(10)->withQueryString();
            
        return view('section.index', compact('sections', 'classes', 'classesID', 'search'));
    }

    public function create()
    {
        $classes = Classes::orderBy('classes_numeric')->get();
        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('section.create', compact('classes', 'teachers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section' => 'required|string|max:60',
            'category' => 'required|string|max:128',
            'capacity' => 'required|numeric|min:1',
            'classesID' => 'required|exists:classes,classesID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'note' => 'required|string|max:500',
        ], [
            'section.required' => 'El nombre de la sección es obligatorio.',
            'category.required' => 'La categoría es obligatoria.',
            'capacity.required' => 'La capacidad es obligatoria.',
            'capacity.numeric' => 'La capacidad debe ser un número.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'teacherID.required' => 'Debe asignar un mentor.',
            'note.required' => 'La descripción es obligatoria.',
            'note.max' => 'La nota no debe exceder los 500 caracteres.',
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
        $data['create_usertype'] = Auth::user()->usertype->usertype ?? 'Admin';
        $data['create_usertypeID'] = Auth::user()->usertypeID;

        Section::create($data);

        return redirect()->route('section.index', ['classesID' => $request->classesID])->with('success', 'Sección registrada exitosamente.');
    }

    public function show($id)
    {
        $section = Section::with(['class'])
            ->leftJoin('teachers', 'section.teacherID', '=', 'teachers.teacherID')
            ->select('section.*', 'teachers.name as teacher_name', 'teachers.photo as teacher_photo')
            ->where('section.sectionID', $id)
            ->firstOrFail();
            
        return view('section.show', compact('section'));
    }

    public function edit($id)
    {
        $section = Section::findOrFail($id);
        $classes = Classes::orderBy('classes_numeric')->get();
        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('section.edit', compact('section', 'classes', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        $section = Section::findOrFail($id);
        
        $request->validate([
            'section' => 'required|string|max:60',
            'category' => 'required|string|max:128',
            'capacity' => 'required|numeric|min:1',
            'classesID' => 'required|exists:classes,classesID',
            'teacherID' => 'required|exists:teachers,teacherID',
            'note' => 'required|string|max:500',
        ], [
            'section.required' => 'El nombre de la sección es obligatorio.',
            'category.required' => 'La categoría es obligatoria.',
            'capacity.required' => 'La capacidad es obligatoria.',
            'capacity.numeric' => 'La capacidad debe ser un número.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'teacherID.required' => 'Debe asignar un mentor.',
            'note.required' => 'La descripción es obligatoria.',
            'note.max' => 'La nota no debe exceder los 500 caracteres.',
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
