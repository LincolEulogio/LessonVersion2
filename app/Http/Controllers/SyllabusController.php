<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SyllabusController extends Controller
{
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $search = $request->get('search');
        
        $classes = Classes::orderBy('classes_numeric')->get();
        
        $query = Syllabus::with(['class'])
            ->leftJoin('classes', 'syllabus.classesID', '=', 'classes.classesID')
            ->select('syllabus.*', 'classes.classes as class_name');

        if ($classesID) {
            $query->where('syllabus.classesID', $classesID);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('syllabus.title', 'like', "%{$search}%")
                  ->orWhere('syllabus.description', 'like', "%{$search}%");
            });
        }

        $syllabuses = $query->latest('syllabus.syllabusID')->paginate(10)->withQueryString();
            
        return view('syllabus.index', compact('syllabuses', 'classes', 'classesID', 'search'));
    }

    public function create()
    {
        $classes = Classes::orderBy('classes_numeric')->get();
        return view('syllabus.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240',
            'description' => 'required|string|max:500',
        ], [
            'title.required' => 'El título es obligatorio.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'file.required' => 'El archivo del plan de estudios es obligatorio.',
            'file.mimes' => 'El archivo debe ser tipo: pdf, doc, docx, ppt, pptx, zip, jpg, png.',
            'file.max' => 'El archivo no debe exceder los 10MB.',
            'description.required' => 'La descripción o notas son obligatorias.',
            'description.max' => 'La descripción no debe exceder los 500 caracteres.',
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('uploads/syllabus'), $fileName);
        }

        Syllabus::create([
            'title' => $request->title,
            'description' => $request->description,
            'classesID' => $request->classesID,
            'file' => $fileName,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => Auth::id(),
            'create_usertypeID' => Auth::user()->usertypeID,
            'create_username' => Auth::user()->username,
            'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
        ]);

        return redirect()->route('syllabus.index', ['classesID' => $request->classesID])
            ->with('success', 'Plan de estudios registrado exitosamente.');
    }

    public function show($id)
    {
        $syllabus = Syllabus::with(['class'])
            ->where('syllabus.syllabusID', $id)
            ->firstOrFail();
            
        return view('syllabus.show', compact('syllabus'));
    }

    public function edit($id)
    {
        $syllabus = Syllabus::findOrFail($id);
        $classes = Classes::orderBy('classes_numeric')->get();
        return view('syllabus.edit', compact('syllabus', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $syllabus = Syllabus::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip,jpg,png|max:10240',
            'description' => 'required|string|max:500',
        ], [
            'title.required' => 'El título es obligatorio.',
            'classesID.required' => 'Debe seleccionar una clase.',
            'file.mimes' => 'El archivo debe ser tipo: pdf, doc, docx, ppt, pptx, zip, jpg, png.',
            'file.max' => 'El archivo no debe exceder los 10MB.',
            'description.required' => 'La descripción o notas son obligatorias.',
            'description.max' => 'La descripción no debe exceder los 500 caracteres.',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'classesID' => $request->classesID,
            'modify_date' => now(),
        ];

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($syllabus->file && file_exists(public_path('uploads/syllabus/' . $syllabus->file))) {
                unlink(public_path('uploads/syllabus/' . $syllabus->file));
            }

            $file = $request->file('file');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('uploads/syllabus'), $fileName);
            $data['file'] = $fileName;
        }

        $syllabus->update($data);

        return redirect()->route('syllabus.index', ['classesID' => $request->classesID])
            ->with('success', 'Plan de estudios actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $syllabus = Syllabus::findOrFail($id);
        $classesID = $syllabus->classesID;
        
        if ($syllabus->file && file_exists(public_path('uploads/syllabus/' . $syllabus->file))) {
            unlink(public_path('uploads/syllabus/' . $syllabus->file));
        }
        
        $syllabus->delete();
        return redirect()->route('syllabus.index', ['classesID' => $classesID])
            ->with('success', 'Plan de estudios eliminado exitosamente.');
    }

    public function download($id)
    {
        $syllabus = Syllabus::findOrFail($id);
        $filePath = public_path('uploads/syllabus/' . $syllabus->file);
        
        if (!$syllabus->file || !file_exists($filePath)) {
            return back()->with('error', 'Archivo no encontrado en el servidor.');
        }

        return response()->download($filePath, $syllabus->file);
    }
}
