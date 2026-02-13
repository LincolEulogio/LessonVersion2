<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $search = $request->get('search');
        
        $classes = Classes::orderBy('classes_numeric')->get();
        
        $query = Topic::with(['classes', 'subject']);

        if ($classesID) {
            $query->where('classesID', $classesID);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $topics = $query->latest()->paginate(10)->withQueryString();
            
        return view('topic.index', compact('topics', 'classes', 'classesID', 'search'));
    }

    public function create()
    {
        $classes = Classes::orderBy('classes_numeric')->get();
        $subjects = Subject::orderBy('subject')->get();
        return view('topic.create', compact('classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'subjectID' => 'required|exists:subject,subjectID',
            'description' => 'required|string|max:500',
        ], [
            'title.required' => 'El título del tema es obligatorio.',
            'title.max' => 'El título no debe exceder los 128 caracteres.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'classesID.exists' => 'La clase seleccionada no es válida.',
            'subjectID.required' => 'Debe seleccionar una materia.',
            'subjectID.exists' => 'La materia seleccionada no es válida.',
            'description.required' => 'La descripción del tema es obligatoria.',
            'description.max' => 'La descripción no debe exceder los 500 caracteres.',
        ]);

        Topic::create([
            'title' => $request->title,
            'description' => $request->description,
            'classesID' => $request->classesID,
            'subjectID' => $request->subjectID,
            'create_userID' => Auth::id(),
            'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
        ]);

        return redirect()->route('topic.index')->with('success', 'Tema registrado exitosamente.');
    }

    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        $classes = Classes::orderBy('classes_numeric')->get();
        $subjects = Subject::where('classesID', $topic->classesID)->orderBy('subject')->get();
        return view('topic.edit', compact('topic', 'classes', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'subjectID' => 'required|exists:subject,subjectID',
            'description' => 'required|string|max:500',
        ], [
            'title.required' => 'El título del tema es obligatorio.',
            'title.max' => 'El título no debe exceder los 128 caracteres.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'classesID.exists' => 'La clase seleccionada no es válida.',
            'subjectID.required' => 'Debe seleccionar una materia.',
            'subjectID.exists' => 'La materia seleccionada no es válida.',
            'description.required' => 'La descripción del tema es obligatoria.',
            'description.max' => 'La descripción no debe exceder los 500 caracteres.',
        ]);

        $topic->update([
            'title' => $request->title,
            'description' => $request->description,
            'classesID' => $request->classesID,
            'subjectID' => $request->subjectID,
        ]);

        return redirect()->route('topic.index')->with('success', 'Tema actualizado exitosamente.');
    }

    public function show($id)
    {
        $topic = Topic::with(['classes', 'subject'])->findOrFail($id);
        return view('topic.show', compact('topic'));
    }

    public function destroy($id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();
        return redirect()->route('topic.index')->with('success', 'Tema eliminado exitosamente.');
    }

    public function getSubjectsByClass($classID)
    {
        $subjects = Subject::where('classesID', $classID)->get();
        return response()->json($subjects);
    }

    public function getSectionsByClass($classID)
    {
        $sections = \App\Models\Section::where('classesID', $classID)->get();
        return response()->json($sections);
    }
}
