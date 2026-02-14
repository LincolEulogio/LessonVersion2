<?php

namespace App\Http\Controllers;

use App\Models\Syllabus;
use App\Models\Classes;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSyllabusRequest;
use App\Http\Requests\UpdateSyllabusRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SyllabusController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('plan_de_estudios_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

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
        if (!Auth::user()->hasPermission('plan_de_estudios_add')) {
            abort(403, 'No tienes permiso para agregar planes de estudio.');
        }

        $classes = Classes::orderBy('classes_numeric')->get();
        return view('syllabus.create', compact('classes'));
    }

    public function store(StoreSyllabusRequest $request)
    {
        $data = $request->validated();

        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName());
            $file->move(public_path('uploads/syllabus'), $fileName);
        }

        Syllabus::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'classesID' => $data['classesID'],
            'file' => $fileName,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => Auth::id(),
            'create_usertypeID' => Auth::user()->usertypeID,
            'create_username' => Auth::user()->username,
            'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
        ]);

        return redirect()->route('syllabus.index', ['classesID' => $data['classesID']])
            ->with('success', 'Plan de estudios registrado exitosamente.');
    }

    public function show($id)
    {
        if (!Auth::user()->hasPermission('plan_de_estudios_view')) {
            abort(403, 'No tienes permiso para ver este plan de estudios.');
        }

        $syllabus = Syllabus::with(['class'])
            ->where('syllabus.syllabusID', $id)
            ->firstOrFail();
            
        return view('syllabus.show', compact('syllabus'));
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermission('plan_de_estudios_edit')) {
            abort(403, 'No tienes permiso para editar planes de estudio.');
        }

        $syllabus = Syllabus::findOrFail($id);
        $classes = Classes::orderBy('classes_numeric')->get();
        return view('syllabus.edit', compact('syllabus', 'classes'));
    }

    public function update(UpdateSyllabusRequest $request, $id)
    {
        $syllabus = Syllabus::findOrFail($id);
        $data = $request->validated();

        $updateData = [
            'title' => $data['title'],
            'description' => $data['description'],
            'classesID' => $data['classesID'],
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
            $updateData['file'] = $fileName;
        }

        $syllabus->update($updateData);

        return redirect()->route('syllabus.index', ['classesID' => $data['classesID']])
            ->with('success', 'Plan de estudios actualizado exitosamente.');
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('plan_de_estudios_delete')) {
            abort(403, 'No tienes permiso para eliminar planes de estudio.');
        }

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
        if (!Auth::user()->hasPermission('plan_de_estudios_view')) {
            abort(403, 'No tienes permiso para descargar este archivo.');
        }

        $syllabus = Syllabus::findOrFail($id);
        $filePath = public_path('uploads/syllabus/' . $syllabus->file);
        
        if (!$syllabus->file || !file_exists($filePath)) {
            return back()->with('error', 'Archivo no encontrado en el servidor.');
        }

        return response()->download($filePath, $syllabus->file);
    }
}
