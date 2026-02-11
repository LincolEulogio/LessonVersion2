<?php

namespace App\Http\Controllers;

use App\Models\Studentgroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentGroupController extends Controller
{
    public function index()
    {
        $groups = Studentgroup::all();
        return view('studentgroup.index', compact('groups'));
    }

    public function create()
    {
        return view('studentgroup.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'group' => 'required|string|max:60|unique:studentgroup,group',
        ]);

        $data = [
            'group' => $request->group,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => Auth::id(),
            'create_usertypeID' => Auth::user()->usertypeID,
        ];

        Studentgroup::create($data);

        return redirect()->route('studentgroup.index')->with('success', 'Grupo de estudiantes creado exitosamente.');
    }

    public function show($id)
    {
        $group = Studentgroup::findOrFail($id);
        return view('studentgroup.show', compact('group'));
    }

    public function edit($id)
    {
        $group = Studentgroup::findOrFail($id);
        return view('studentgroup.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $group = Studentgroup::findOrFail($id);
        
        $validated = $request->validate([
            'group' => 'required|string|max:60|unique:studentgroup,group,'.$id.',studentgroupID',
        ]);

        $group->update([
            'group' => $request->group,
            'modify_date' => now(),
        ]);

        return redirect()->route('studentgroup.index')->with('success', 'Grupo de estudiantes actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $group = Studentgroup::findOrFail($id);
        $group->delete();

        return redirect()->route('studentgroup.index')->with('success', 'Grupo de estudiantes eliminado exitosamente.');
    }
}
