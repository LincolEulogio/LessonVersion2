<?php

namespace App\Http\Controllers;

use App\Models\Usertype;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsertypeController extends Controller
{
    public function index()
    {
        $usertypes = Usertype::all();
        return view('usertype.index', compact('usertypes'));
    }

    public function create()
    {
        return view('usertype.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'usertype' => 'required|string|unique:usertypes,usertype|max:60',
        ]);

        Usertype::create([
            'usertype' => $request->usertype,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => Auth::id(),
            'create_username' => Auth::user()->name,
            'create_usertype' => 'Admin'
        ]);

        return redirect()->route('usertype.index')->with('success', 'Rol de usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usertype = Usertype::findOrFail($id);
        return view('usertype.edit', compact('usertype'));
    }

    public function update(Request $request, $id)
    {
        $usertype = Usertype::findOrFail($id);
        
        $request->validate([
            'usertype' => 'required|string|max:60|unique:usertypes,usertype,' . $id . ',usertypeID',
        ]);

        $usertype->update([
            'usertype' => $request->usertype,
            'modify_date' => now(),
        ]);

        return redirect()->route('usertype.index')->with('success', 'Rol de usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        if ($id <= 4) {
            return redirect()->route('usertype.index')->with('error', 'No se pueden eliminar los roles predeterminados del sistema.');
        }

        $usertype = Usertype::findOrFail($id);
        $usertype->delete();

        return redirect()->route('usertype.index')->with('success', 'Rol de usuario eliminado correctamente.');
    }
}
