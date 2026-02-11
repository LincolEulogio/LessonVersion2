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
        $classes = Classes::all();
        
        $query = Student::with(['classes', 'section']);
        
        if ($classesID) {
            $query->where('classesID', $classesID);
        }

        $students = $query->paginate(20);

        return view('student.index', compact('students', 'classes', 'classesID'));
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
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'sex' => 'required|string',
            'email' => 'nullable|email|unique:students,email',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:sections,sectionID',
            'username' => 'required|string|min:4|unique:students,username',
            'password' => 'required|string|min:4',
            'parentID' => 'nullable|exists:parents,parentsID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['usertypeID'] = 3;
        $data['active'] = 1;

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
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'sex' => 'required|string',
            'email' => 'nullable|email|unique:students,email,'.$id.',studentID',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'classesID' => 'required|exists:classes,classesID',
            'sectionID' => 'required|exists:sections,sectionID',
            'username' => 'required|string|min:4|unique:students,username,'.$id.',studentID',
            'parentID' => 'nullable|exists:parents,parentsID',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
