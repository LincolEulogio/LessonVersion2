<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Schoolyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $classes = Classes::all();
        
        $query = Assignment::leftJoin('classes', 'assignment.classesID', '=', 'classes.classesID')
            ->select('assignment.*', 'classes.classes as class_name');

        if ($classesID) {
            $query->where('assignment.classesID', $classesID);
        }

        $assignments = $query->get();
            
        return view('assignment.index', compact('assignments', 'classes', 'classesID'));
    }

    public function create()
    {
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('assignment.create', compact('classes', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'subjectID' => 'required|exists:subject,subjectID',
            'deadlinedate' => 'required|date',
            'file' => 'nullable|file|max:10240',
            'description' => 'required|string',
        ]);

        $fileName = null;
        $originalName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . $originalName;
            $file->storeAs('uploads/assignment', $fileName, 'public');
        }

        $schoolyear = Schoolyear::where('schoolyearID', session('default_schoolyearID') ?? 1)->first();

        Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadlinedate' => $request->deadlinedate,
            'usertypeID' => Auth::user()->usertypeID,
            'userID' => Auth::id(),
            'classesID' => $request->classesID,
            'subjectID' => $request->subjectID,
            'schoolyearID' => $schoolyear->schoolyearID ?? 1,
            'originalfile' => $originalName,
            'file' => $fileName,
        ]);

        return redirect()->route('assignment.index')->with('success', 'Asignación creada exitosamente.');
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $classes = Classes::all();
        $subjects = Subject::where('classesID', $assignment->classesID)->get();
        return view('assignment.edit', compact('assignment', 'classes', 'subjects'));
    }

    public function update(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'subjectID' => 'required|exists:subject,subjectID',
            'deadlinedate' => 'required|date',
            'file' => 'nullable|file|max:10240',
            'description' => 'required|string',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'deadlinedate' => $request->deadlinedate,
            'classesID' => $request->classesID,
            'subjectID' => $request->subjectID,
        ];

        if ($request->hasFile('file')) {
            if ($assignment->file) {
                Storage::disk('public')->delete('uploads/assignment/' . $assignment->file);
            }

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . $originalName;
            $file->storeAs('uploads/assignment', $fileName, 'public');
            
            $data['originalfile'] = $originalName;
            $data['file'] = $fileName;
        }

        $assignment->update($data);

        return redirect()->route('assignment.index')->with('success', 'Asignación actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        if ($assignment->file) {
            Storage::disk('public')->delete('uploads/assignment/' . $assignment->file);
        }
        $assignment->delete();
        return redirect()->route('assignment.index')->with('success', 'Asignación eliminada exitosamente.');
    }

    public function download($id)
    {
        $assignment = Assignment::findOrFail($id);
        if (!$assignment->file || !Storage::disk('public')->exists('uploads/assignment/' . $assignment->file)) {
            return back()->with('error', 'Archivo no encontrado.');
        }

        return Storage::disk('public')->download('uploads/assignment/' . $assignment->file, $assignment->originalfile);
    }
}
