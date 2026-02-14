<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('seccion_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

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
        if (!Auth::user()->hasPermission('seccion_add')) {
            abort(403, 'No tienes permiso para agregar secciones.');
        }

        $classes = Classes::orderBy('classes_numeric')->get();
        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('section.create', compact('classes', 'teachers'));
    }

    public function store(StoreSectionRequest $request)
    {
        $data = $request->validated();
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_username'] = Auth::user()->username;
        $data['create_usertype'] = Auth::user()->usertype->usertype ?? 'Admin';
        $data['create_usertypeID'] = Auth::user()->usertypeID;

        Section::create($data);

        return redirect()->route('section.index', ['classesID' => $data['classesID']])->with('success', 'Sección registrada exitosamente.');
    }

    public function show($id)
    {
        if (!Auth::user()->hasPermission('seccion_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $section = Section::with(['class'])
            ->leftJoin('teachers', 'section.teacherID', '=', 'teachers.teacherID')
            ->select('section.*', 'teachers.name as teacher_name', 'teachers.photo as teacher_photo')
            ->where('section.sectionID', $id)
            ->firstOrFail();
            
        return view('section.show', compact('section'));
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermission('seccion_edit')) {
            abort(403, 'No tienes permiso para editar secciones.');
        }

        $section = Section::findOrFail($id);
        $classes = Classes::orderBy('classes_numeric')->get();
        $teachers = Teacher::where('active', 1)->orderBy('name')->get();
        return view('section.edit', compact('section', 'classes', 'teachers'));
    }

    public function update(UpdateSectionRequest $request, $id)
    {
        $section = Section::findOrFail($id);
        $data = $request->validated();
        $data['modify_date'] = now();

        $section->update($data);

        return redirect()->route('section.index', ['classesID' => $data['classesID']])->with('success', 'Sección actualizada exitosamente.');
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('seccion_delete')) {
            abort(403, 'No tienes permiso para eliminar secciones.');
        }

        $section = Section::findOrFail($id);
        $classesID = $section->classesID;
        $section->delete();

        return redirect()->route('section.index', ['classesID' => $classesID])->with('success', 'Sección eliminada exitosamente.');
    }
}
