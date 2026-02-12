<?php

namespace App\Http\Controllers;

use App\Models\Schoolyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolyearController extends Controller
{
    public function index()
    {
        $schoolyears = Schoolyear::orderBy('schoolyear', 'desc')->get();
        return view('schoolyear.index', compact('schoolyears'));
    }

    public function create()
    {
        return view('schoolyear.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'schoolyear' => 'required|string|max:128',
            'schoolyeartitle' => 'required|string|max:128',
            'startingdate' => 'required|date',
            'endingdate' => 'required|date',
        ]);

        Schoolyear::create([
            'schoolyear' => $request->schoolyear,
            'schoolyeartitle' => $request->schoolyeartitle,
            'startingdate' => $request->startingdate,
            'endingdate' => $request->endingdate,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => Auth::id(),
            'create_usertypeID' => 1,
        ]);

        return redirect()->route('schoolyear.index')->with('success', 'Año académico creado correctamente.');
    }

    public function edit($id)
    {
        $schoolyear = Schoolyear::findOrFail($id);
        return view('schoolyear.edit', compact('schoolyear'));
    }

    public function update(Request $request, $id)
    {
        $schoolyear = Schoolyear::findOrFail($id);
        
        $request->validate([
            'schoolyear' => 'required|string|max:128',
            'schoolyeartitle' => 'required|string|max:128',
            'startingdate' => 'required|date',
            'endingdate' => 'required|date',
        ]);

        $schoolyear->update([
            'schoolyear' => $request->schoolyear,
            'schoolyeartitle' => $request->schoolyeartitle,
            'startingdate' => $request->startingdate,
            'endingdate' => $request->endingdate,
            'modify_date' => now(),
        ]);

        return redirect()->route('schoolyear.index')->with('success', 'Año académico actualizado correctamente.');
    }

    public function destroy($id)
    {
        $schoolyear = Schoolyear::findOrFail($id);
        $schoolyear->delete();

        return redirect()->route('schoolyear.index')->with('success', 'Año académico eliminado correctamente.');
    }
}
