<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Schoolyear;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $search = $request->get('search');
        
        $classes = Classes::orderBy('classes_numeric')->get();
        
        $query = Assignment::with(['class', 'subject'])
            ->leftJoin('classes', 'assignment.classesID', '=', 'classes.classesID')
            ->leftJoin('subject', 'assignment.subjectID', '=', 'subject.subjectID')
            ->select('assignment.*', 'classes.classes as class_name', 'subject.subject as subject_name');

        if ($classesID) {
            $query->where('assignment.classesID', $classesID);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('assignment.title', 'like', "%{$search}%")
                  ->orWhere('assignment.description', 'like', "%{$search}%");
            });
        }

        $assignments = $query->latest('assignment.assignmentID')->paginate(10)->withQueryString();
            
        return view('assignment.index', compact('assignments', 'classes', 'classesID', 'search'));
    }

    public function create()
    {
        $classes = Classes::orderBy('classes_numeric')->get();
        return view('assignment.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'subjectID' => 'required|exists:subject,subjectID',
            'deadlinedate' => 'required|date|after_or_equal:today',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240',
            'description' => 'required|string|max:1000',
        ], [
            'title.required' => 'El título es obligatorio.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'subjectID.required' => 'Debe seleccionar una materia.',
            'deadlinedate.required' => 'La fecha límite es obligatoria.',
            'deadlinedate.after_or_equal' => 'La fecha límite debe ser hoy o una fecha futura.',
            'file.mimes' => 'El archivo debe ser tipo: pdf, doc, docx, ppt, pptx, zip, jpg, png.',
            'file.max' => 'El archivo no debe exceder los 10MB.',
            'description.required' => 'La descripción es obligatoria.',
        ]);

        $fileName = null;
        $originalName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $originalName);
            $file->move(public_path('uploads/assignment'), $fileName);
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
            'create_username' => Auth::user()->username,
            'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
        ]);

        return redirect()->route('assignment.index', ['classesID' => $request->classesID])
            ->with('success', 'Asignación creada exitosamente.');
    }

    public function show($id)
    {
        $assignment = Assignment::with(['class', 'subject', 'user'])
            ->findOrFail($id);
            
        return view('assignment.show', compact('assignment'));
    }

    public function edit($id)
    {
        $assignment = Assignment::findOrFail($id);
        $classes = Classes::orderBy('classes_numeric')->get();
        $subjects = Subject::where('classesID', $assignment->classesID)->get();
        $sections = Section::where('classesID', $assignment->classesID)->get();
        
        return view('assignment.edit', compact('assignment', 'classes', 'subjects', 'sections'));
    }

    public function update(Request $request, $id)
    {
        $assignment = Assignment::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'subjectID' => 'required|exists:subject,subjectID',
            'deadlinedate' => 'required|date',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240',
            'description' => 'required|string|max:1000',
        ], [
            'title.required' => 'El título es obligatorio.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'subjectID.required' => 'Debe seleccionar una materia.',
            'deadlinedate.required' => 'La fecha límite es obligatoria.',
            'file.mimes' => 'El archivo debe ser tipo: pdf, doc, docx, ppt, pptx, zip, jpg, png.',
            'file.max' => 'El archivo no debe exceder los 10MB.',
            'description.required' => 'La descripción es obligatoria.',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'deadlinedate' => $request->deadlinedate,
            'classesID' => $request->classesID,
            'subjectID' => $request->subjectID,
        ];

        if ($request->hasFile('file')) {
            if ($assignment->file && file_exists(public_path('uploads/assignment/' . $assignment->file))) {
                unlink(public_path('uploads/assignment/' . $assignment->file));
            }

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $originalName);
            $file->move(public_path('uploads/assignment'), $fileName);
            
            $data['originalfile'] = $originalName;
            $data['file'] = $fileName;
        }

        $assignment->update($data);

        return redirect()->route('assignment.index', ['classesID' => $request->classesID])
            ->with('success', 'Asignación actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);
        $classesID = $assignment->classesID;
        
        if ($assignment->file && file_exists(public_path('uploads/assignment/' . $assignment->file))) {
            unlink(public_path('uploads/assignment/' . $assignment->file));
        }
        
        $assignment->delete();
        return redirect()->route('assignment.index', ['classesID' => $classesID])
            ->with('success', 'Asignación eliminada exitosamente.');
    }

    public function download($id)
    {
        $assignment = Assignment::findOrFail($id);
        $filePath = public_path('uploads/assignment/' . $assignment->file);
        
        if (!$assignment->file || !file_exists($filePath)) {
            return back()->with('error', 'Archivo no encontrado.');
        }

        return response()->download($filePath, $assignment->originalfile);
    }
}
