<?php

namespace App\Http\Controllers;

use App\Models\Parents;
use Illuminate\Http\Request;
use App\Http\Requests\StoreParentRequest;
use App\Http\Requests\UpdateParentRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ParentsController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::user()->hasPermission('padres_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $search = $request->get('search');
        $active = $request->get('active');

        $query = Parents::query();

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('dni', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($active !== null && $active !== '') {
            $query->where('active', $active);
        }

        $parents = $query->paginate(10)->withQueryString();
        return view('parents.index', compact('parents', 'search', 'active'));
    }

    public function create()
    {
        if (!Auth::user()->hasPermission('padres_add')) {
            abort(403, 'No tienes permiso para agregar padres.');
        }

        return view('parents.create');
    }

    public function store(StoreParentRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        $data['usertypeID'] = 4;
        $data['active'] = 1;
        $data['create_date'] = now();
        $data['modify_date'] = now();
        $data['create_userID'] = Auth::id();
        $data['create_username'] = Auth::user()->name;
        $data['create_usertype'] = 'Admin';

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        } else {
            $data['photo'] = 'default.png';
        }

        Parents::create($data);

        return redirect()->route('parents.index')->with('success', 'Padre/Tutor creado correctamente.');
    }

    public function show(string $id)
    {
        if (!Auth::user()->hasPermission('padres_view')) {
            abort(403, 'No tienes permiso para ver este tutor.');
        }

        $parent = Parents::findOrFail($id);
        return view('parents.show', compact('parent'));
    }

    public function edit(string $id)
    {
        if (!Auth::user()->hasPermission('padres_edit')) {
            abort(403, 'No tienes permiso para editar padres.');
        }

        $parent = Parents::findOrFail($id);
        return view('parents.edit', compact('parent'));
    }

    public function update(UpdateParentRequest $request, string $id)
    {
        $parent = Parents::findOrFail($id);
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('photo')) {
            if ($parent->photo && $parent->photo != 'default.png') {
                Storage::disk('public')->delete('images/' . $parent->photo);
            }
            $path = $request->file('photo')->store('images', 'public');
            $data['photo'] = basename($path);
        }

        $parent->update($data);

        return redirect()->route('parents.index')->with('success', 'Padre/Tutor actualizado correctamente.');
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->hasPermission('padres_delete')) {
            abort(403, 'No tienes permiso para eliminar padres.');
        }

        $parent = Parents::findOrFail($id);
        if ($parent->photo && $parent->photo != 'default.png') {
            Storage::disk('public')->delete('images/' . $parent->photo);
        }
        $parent->delete();

        return redirect()->route('parents.index')->with('success', 'Padre/Tutor eliminado correctamente.');
    }
}
