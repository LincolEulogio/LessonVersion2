<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SyllabusController extends Controller
{
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $classes = Classes::all();
        
        $query = Syllabus::leftJoin('classes', 'syllabus.classesID', '=', 'classes.classesID')
            ->select('syllabus.*', 'classes.classes as class_name');

        if ($classesID) {
            $query->where('syllabus.classesID', $classesID);
        }

        $syllabuses = $query->get();
            
        return view('syllabus.index', compact('syllabuses', 'classes', 'classesID'));
    }

    public function create()
    {
        $classes = Classes::all();
        return view('syllabus.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:10240',
            'description' => 'nullable|string',
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/syllabus', $fileName, 'public');
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
        ]);

        return redirect()->route('syllabus.index')->with('success', 'Plan de estudios creado exitosamente.');
    }

    public function edit($id)
    {
        $syllabus = Syllabus::findOrFail($id);
        $classes = Classes::all();
        return view('syllabus.edit', compact('syllabus', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $syllabus = Syllabus::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:128',
            'classesID' => 'required|exists:classes,classesID',
            'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:10240',
            'description' => 'nullable|string',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'classesID' => $request->classesID,
            'modify_date' => now(),
        ];

        if ($request->hasFile('file')) {
            // Delete old file
            if ($syllabus->file) {
                Storage::disk('public')->delete('uploads/syllabus/' . $syllabus->file);
            }

            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('uploads/syllabus', $fileName, 'public');
            $data['file'] = $fileName;
        }

        $syllabus->update($data);

        return redirect()->route('syllabus.index')->with('success', 'Plan de estudios actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $syllabus = Syllabus::findOrFail($id);
        if ($syllabus->file) {
            Storage::disk('public')->delete('uploads/syllabus/' . $syllabus->file);
        }
        $syllabus->delete();
        return redirect()->route('syllabus.index')->with('success', 'Plan de estudios eliminado exitosamente.');
    }

    public function download($id)
    {
        $syllabus = Syllabus::findOrFail($id);
        if (!$syllabus->file || !Storage::disk('public')->exists('uploads/syllabus/' . $syllabus->file)) {
            return back()->with('error', 'Archivo no encontrado.');
        }

        return Storage::disk('public')->download('uploads/syllabus/' . $syllabus->file);
    }
}
