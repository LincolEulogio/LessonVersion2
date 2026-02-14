<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Schoolyear;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('asignacion_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

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
        if (!Auth::user()->hasPermission('asignacion_add')) {
            abort(403, 'No tienes permiso para agregar asignaciones.');
        }

        $classes = Classes::orderBy('classes_numeric')->get();
        return view('assignment.create', compact('classes'));
    }

    public function store(StoreAssignmentRequest $request)
    {
        $data = $request->validated();

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
            'title' => $data['title'],
            'description' => $data['description'],
            'deadlinedate' => $data['deadlinedate'],
            'usertypeID' => Auth::user()->usertypeID,
            'userID' => Auth::id(),
            'classesID' => $data['classesID'],
            'subjectID' => $data['subjectID'],
            'schoolyearID' => $schoolyear->schoolyearID ?? 1,
            'originalfile' => $originalName,
            'file' => $fileName,
            'create_username' => Auth::user()->username,
            'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
        ]);

        return redirect()->route('assignment.index', ['classesID' => $data['classesID']])
            ->with('success', 'Asignación creada exitosamente.');
    }

    public function show($id)
    {
        if (!Auth::user()->hasPermission('asignacion_view')) {
            abort(403, 'No tienes permiso para ver esta asignación.');
        }

        $assignment = Assignment::with(['class', 'subject', 'user'])
            ->findOrFail($id);
            
        return view('assignment.show', compact('assignment'));
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermission('asignacion_edit')) {
            abort(403, 'No tienes permiso para editar asignaciones.');
        }

        $assignment = Assignment::findOrFail($id);
        $classes = Classes::orderBy('classes_numeric')->get();
        $subjects = Subject::where('classesID', $assignment->classesID)->get();
        $sections = Section::where('classesID', $assignment->classesID)->get();
        
        return view('assignment.edit', compact('assignment', 'classes', 'subjects', 'sections'));
    }

    public function update(UpdateAssignmentRequest $request, $id)
    {
        $assignment = Assignment::findOrFail($id);
        $data = $request->validated();

        $updateData = [
            'title' => $data['title'],
            'description' => $data['description'],
            'deadlinedate' => $data['deadlinedate'],
            'classesID' => $data['classesID'],
            'subjectID' => $data['subjectID'],
        ];

        if ($request->hasFile('file')) {
            if ($assignment->file && file_exists(public_path('uploads/assignment/' . $assignment->file))) {
                unlink(public_path('uploads/assignment/' . $assignment->file));
            }

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $originalName);
            $file->move(public_path('uploads/assignment'), $fileName);
            
            $updateData['originalfile'] = $originalName;
            $updateData['file'] = $fileName;
        }

        $assignment->update($updateData);

        return redirect()->route('assignment.index', ['classesID' => $data['classesID']])
            ->with('success', 'Asignación actualizada exitosamente.');
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('asignacion_delete')) {
            abort(403, 'No tienes permiso para eliminar asignaciones.');
        }

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
        if (!Auth::user()->hasPermission('asignacion_view')) {
            abort(403, 'No tienes permiso para descargar este archivo.');
        }

        $assignment = Assignment::findOrFail($id);
        $filePath = public_path('uploads/assignment/' . $assignment->file);
        
        if (!$assignment->file || !file_exists($filePath)) {
            return back()->with('error', 'Archivo no encontrado.');
        }

        return response()->download($filePath, $assignment->originalfile);
    }
}
