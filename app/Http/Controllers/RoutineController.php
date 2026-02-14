<?php

namespace App\Http\Controllers;

use App\Models\Routine;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Schoolyear;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRoutineRequest;
use App\Http\Requests\UpdateRoutineRequest;
use Illuminate\Support\Facades\Auth;

class RoutineController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('horario_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $classesID = $request->get('classesID');
        $search = $request->get('search');
        
        $classes = Classes::orderBy('classes_numeric')->get();
        
        $query = Routine::with(['class', 'section', 'subject', 'teacher'])
            ->leftJoin('classes', 'routine.classesID', '=', 'classes.classesID')
            ->leftJoin('section', 'routine.sectionID', '=', 'section.sectionID')
            ->leftJoin('subject', 'routine.subjectID', '=', 'subject.subjectID')
            ->leftJoin('teachers', 'routine.teacherID', '=', 'teachers.teacherID')
            ->select('routine.*', 'classes.classes as class_name', 'section.section as section_name', 
                    'subject.subject as subject_name', 'teachers.name as teacher_name');

        if ($classesID) {
            $query->where('routine.classesID', $classesID);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('routine.day', 'like', "%{$search}%")
                  ->orWhere('routine.room', 'like', "%{$search}%")
                  ->orWhere('subject.subject', 'like', "%{$search}%")
                  ->orWhere('teachers.name', 'like', "%{$search}%");
            });
        }

        // Logical ordering: By Day and then Start Time
        $routines = $query->orderByRaw("FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')")
            ->orderBy('start_time')
            ->paginate(15)
            ->withQueryString();
            
        return view('routine.index', compact('routines', 'classes', 'classesID', 'search'));
    }

    public function create()
    {
        if (!Auth::user()->hasPermission('horario_add')) {
            abort(403, 'No tienes permiso para agregar horarios.');
        }

        $classes = Classes::orderBy('classes_numeric')->get();
        $teachers = Teacher::orderBy('name')->get();
        $days = [
            'Monday' => 'Lunes', 
            'Tuesday' => 'Martes', 
            'Wednesday' => 'Miércoles', 
            'Thursday' => 'Jueves', 
            'Friday' => 'Viernes', 
            'Saturday' => 'Sábado', 
            'Sunday' => 'Domingo'
        ];
        return view('routine.create', compact('classes', 'teachers', 'days'));
    }

    public function store(StoreRoutineRequest $request)
    {
        $data = $request->validated();
        $schoolyear = Schoolyear::where('schoolyearID', session('default_schoolyearID') ?? 1)->first();

        Routine::create([
            'classesID' => $data['classesID'],
            'sectionID' => $data['sectionID'],
            'subjectID' => $data['subjectID'],
            'teacherID' => $data['teacherID'],
            'schoolyearID' => $schoolyear->schoolyearID ?? 1,
            'day' => $data['day'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'room' => $data['room'],
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => Auth::id(),
            'create_usertypeID' => Auth::user()->usertypeID,
            'create_username' => Auth::user()->username,
            'create_usertype' => Auth::user()->usertype->usertype ?? 'Admin',
        ]);

        return redirect()->route('routine.index', ['classesID' => $data['classesID']])
            ->with('success', 'Horario creado exitosamente.');
    }

    public function show($id)
    {
        if (!Auth::user()->hasPermission('horario_view')) {
            abort(403, 'No tienes permiso para ver este horario.');
        }

        $routine = Routine::with(['class', 'section', 'subject', 'teacher', 'creator'])
            ->findOrFail($id);
            
        return view('routine.show', compact('routine'));
    }

    public function edit($id)
    {
        if (!Auth::user()->hasPermission('horario_edit')) {
            abort(403, 'No tienes permiso para editar horarios.');
        }

        $routine = Routine::findOrFail($id);
        $classes = Classes::orderBy('classes_numeric')->get();
        $sections = Section::where('classesID', $routine->classesID)->get();
        $subjects = Subject::where('classesID', $routine->classesID)->get();
        $teachers = Teacher::orderBy('name')->get();
        $days = [
            'Monday' => 'Lunes', 
            'Tuesday' => 'Martes', 
            'Wednesday' => 'Miércoles', 
            'Thursday' => 'Jueves', 
            'Friday' => 'Viernes', 
            'Saturday' => 'Sábado', 
            'Sunday' => 'Domingo'
        ];
        return view('routine.edit', compact('routine', 'classes', 'sections', 'subjects', 'teachers', 'days'));
    }

    public function update(UpdateRoutineRequest $request, $id)
    {
        $routine = Routine::findOrFail($id);
        $data = $request->validated();

        $routine->update([
            'classesID' => $data['classesID'],
            'sectionID' => $data['sectionID'],
            'subjectID' => $data['subjectID'],
            'teacherID' => $data['teacherID'],
            'day' => $data['day'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'room' => $data['room'],
            'modify_date' => now(),
        ]);

        return redirect()->route('routine.index', ['classesID' => $data['classesID']])
            ->with('success', 'Horario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        if (!Auth::user()->hasPermission('horario_delete')) {
            abort(403, 'No tienes permiso para eliminar horarios.');
        }

        $routine = Routine::findOrFail($id);
        $classesID = $routine->classesID;
        $routine->delete();
        
        return redirect()->route('routine.index', ['classesID' => $classesID])
            ->with('success', 'Horario eliminado exitosamente.');
    }
}
