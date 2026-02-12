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
        $classes = Classes::all();
        
        $query = Topic::with(['classes', 'subject']);

        if ($classesID) {
            $query->where('classesID', $classesID);
        }

        $topics = $query->get();
            
        return view('topic.index', compact('topics', 'classes', 'classesID'));
    }

    public function create()
    {
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('topic.create', compact('classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'subjectID' => 'required|exists:subject,subjectID',
            'description' => 'nullable|string',
        ]);

        Topic::create([
            'title' => $request->title,
            'description' => $request->description,
            'classesID' => $request->classesID,
            'subjectID' => $request->subjectID,
            'create_userID' => Auth::id(),
            'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
        ]);

        return redirect()->route('topic.index')->with('success', 'Tema creado exitosamente.');
    }

    public function edit($id)
    {
        $topic = Topic::findOrFail($id);
        $classes = Classes::all();
        $subjects = Subject::where('classesID', $topic->classesID)->get();
        return view('topic.edit', compact('topic', 'classes', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $topic = Topic::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'subjectID' => 'required|exists:subject,subjectID',
            'description' => 'nullable|string',
        ]);

        $topic->update([
            'title' => $request->title,
            'description' => $request->description,
            'classesID' => $request->classesID,
            'subjectID' => $request->subjectID,
        ]);

        return redirect()->route('topic.index')->with('success', 'Tema actualizado exitosamente.');
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
}
