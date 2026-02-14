<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('tema_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

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
        if (!Auth::user()->hasPermission('tema_add')) {
            abort(403, 'No tienes permiso para agregar temas.');
        }

        $classes = Classes::orderBy('classes_numeric')->get();
        $subjects = Subject::orderBy('subject')->get();
        return view('topic.create', compact('classes', 'subjects'));
    }

    public function store(StoreTopicRequest $request)
    {
        $data = $request->validated();
        
        Topic::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'classesID' => $data['classesID'],
            'subjectID' => $data['subjectID'],
            'create_userID' => Auth::id(),
            'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
        ]);

        return redirect()->route('topic.index')->with('success', 'Tema registrado exitosamente.');
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermission('tema_edit')) {
            abort(403, 'No tienes permiso para editar temas.');
        }

        $topic = Topic::findOrFail($id);
        $classes = Classes::orderBy('classes_numeric')->get();
        $subjects = Subject::where('classesID', $topic->classesID)->orderBy('subject')->get();
        return view('topic.edit', compact('topic', 'classes', 'subjects'));
    }

    public function update(UpdateTopicRequest $request, $id)
    {
        $topic = Topic::findOrFail($id);
        $data = $request->validated();

        $topic->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'classesID' => $data['classesID'],
            'subjectID' => $data['subjectID'],
        ]);

        return redirect()->route('topic.index')->with('success', 'Tema actualizado exitosamente.');
    }

    public function show($id)
    {
        if (!Auth::user()->hasPermission('tema_view')) {
            abort(403, 'No tienes permiso para ver este tema.');
        }

        $topic = Topic::with(['classes', 'subject'])->findOrFail($id);
        return view('topic.show', compact('topic'));
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('tema_delete')) {
            abort(403, 'No tienes permiso para eliminar temas.');
        }

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
