<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Parents;
use App\Models\Studentgroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $classesID = $request->get('classesID');
        $search = $request->get('search');
        $active = $request->get('active');
        
        $classes = Classes::all();
        
        $query = Student::with(['classes', 'section']);
        
        if ($classesID) {
            $query->where('classesID', $classesID);
        }

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('username', 'like', "%{$search}%")
                  ->orWhere('roll', 'like', "%{$search}%")
                  ->orWhere('dni', 'like', "%{$search}%");
            });
        }

        if ($active !== null && $active !== '') {
            $query->where('active', $active);
        }

        $students = $query->paginate(10)->withQueryString();

        return view('student.index', compact('students', 'classes', 'classesID', 'search', 'active'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = Classes::all();
        $sections = Section::all();
        $parents = Parents::all();
        $groups = Studentgroup::all();

        return view('student.create', compact('classes', 'sections', 'parents', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'dob' => 'required|date',
            'sex' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|numeric|digits:9',
            'address' => 'required|string',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'username' => 'required|string|min:8|unique:students,username',
            'password' => 'required|string|min:8',
            'parentID' => 'required|exists:parents,parentsID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dni' => 'required|numeric|digits:8|unique:students,dni',
            'roll' => 'required|numeric',
            'religion' => 'required|string|regex:/^[\pL\s\-]+$/u',
        ], [
            'name.required' => 'El nombre completo es obligatorio.',
            'name.regex' => 'El nombre no debe contener números.',
            'sex.required' => 'El género es obligatorio.',
            'classesID.required' => 'La clase o grado es obligatorio.',
            'sectionID.required' => 'La sección es obligatoria.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.min' => 'El usuario debe tener al menos 8 caracteres.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico con formato válido (@).',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.max' => 'La imagen no debe pesar más de 2MB.',
            'dob.required' => 'La fecha de nacimiento es obligatoria.',
            'dob.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.numeric' => 'El teléfono debe ser solo números.',
            'phone.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'address.required' => 'La dirección de residencia es obligatoria.',
            'parentID.required' => 'Debe seleccionar un tutor para el estudiante.',
            'parentID.exists' => 'El tutor seleccionado no existe en el sistema.',
            'dni.required' => 'El DNI/Documento es obligatorio.',
            'dni.numeric' => 'El DNI debe ser solo números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'roll.required' => 'El número de registro (Roll) es obligatorio.',
            'roll.numeric' => 'El número de registro debe ser un valor numérico.',
            'religion.required' => 'La religión es obligatoria.',
            'religion.regex' => 'La religión no debe contener números.',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['usertypeID'] = 3;
        $data['active'] = 1;
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_username'] = Auth::user()->name;
        $data['create_usertype'] = 'Admin';

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        Student::create($data);

        return redirect()->route('student.index')->with('success', 'Estudiante creado correctamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $classes = Classes::all();
        $sections = Section::where('classesID', $student->classesID)->get();
        $parents = Parents::all();
        $groups = Studentgroup::all();

        return view('student.edit', compact('student', 'classes', 'sections', 'parents', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|regex:/^[\pL\s\-]+$/u',
            'dob' => 'required|date',
            'sex' => 'required|string',
            'email' => 'required|email|unique:students,email,'.$id.',studentID',
            'phone' => 'required|numeric|digits:9',
            'address' => 'required|string',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:section,sectionID',
            'username' => 'required|string|min:8|unique:students,username,'.$id.',studentID',
            'parentID' => 'required|exists:parents,parentsID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'dni' => 'required|numeric|digits:8|unique:students,dni,'.$id.',studentID',
            'roll' => 'required|numeric',
            'religion' => 'required|string|regex:/^[\pL\s\-]+$/u',
        ], [
            'name.required' => 'El nombre completo es obligatorio.',
            'name.regex' => 'El nombre no debe contener números.',
            'sex.required' => 'El género es obligatorio.',
            'classesID.required' => 'La clase o grado es obligatorio.',
            'sectionID.required' => 'La sección es obligatoria.',
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.min' => 'El usuario debe tener al menos 8 caracteres.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico con formato válido (@).',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            'photo.image' => 'El archivo debe ser una imagen.',
            'photo.max' => 'La imagen no debe pesar más de 2MB.',
            'dob.required' => 'La fecha de nacimiento es obligatoria.',
            'dob.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.numeric' => 'El teléfono debe ser solo números.',
            'phone.digits' => 'El teléfono debe tener exactamente 9 dígitos.',
            'address.required' => 'La dirección de residencia es obligatoria.',
            'parentID.required' => 'Debe seleccionar un tutor para el estudiante.',
            'parentID.exists' => 'El tutor seleccionado no existe en el sistema.',
            'dni.required' => 'El DNI/Documento es obligatorio.',
            'dni.numeric' => 'El DNI debe ser solo números.',
            'dni.digits' => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique' => 'Este DNI ya está registrado.',
            'roll.required' => 'El número de registro (Roll) es obligatorio.',
            'roll.numeric' => 'El número de registro debe ser un valor numérico.',
            'religion.required' => 'La religión es obligatoria.',
            'religion.regex' => 'La religión no debe contener números.',
            'password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($student->photo && $student->photo != 'default.png') {
                Storage::disk('public')->delete('images/' . $student->photo);
            }
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        $student->update($data);

        return redirect()->route('student.index')->with('success', 'Estudiante actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        if ($student->photo && $student->photo != 'default.png') {
            Storage::disk('public')->delete('images/' . $student->photo);
        }
        $student->delete();

        return redirect()->route('student.index')->with('success', 'Estudiante eliminado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with(['classes', 'section', 'parent'])->findOrFail($id);
        return view('student.show', compact('student'));
    }
}
