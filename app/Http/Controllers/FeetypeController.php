<?php

namespace App\Http\Controllers;

use App\Models\Feetype;
use Illuminate\Http\Request;

class FeetypeController extends Controller
{
    public function index()
    {
        $feetypes = Feetype::all();
        return view('feetypes.index', compact('feetypes'));
    }

    public function create()
    {
        return view('feetypes.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'feetypes' => 'required|string|max:60|unique:feetypes,feetypes',
            'note' => 'nullable|string',
        ]);

        Feetype::create($request->all());

        return redirect()->route('feetypes.index')->with('success', 'Tipo de tarifa creado correctamente.');
    }

    public function edit($id)
    {
        $feetype = Feetype::findOrFail($id);
        return view('feetypes.edit', compact('feetype'));
    }

    public function update(Request $request, $id)
    {
        $feetype = Feetype::findOrFail($id);
        
        $request->validate([
            'feetypes' => 'required|string|max:60|unique:feetypes,feetypes,' . $id . ',feetypesID',
            'note' => 'nullable|string',
        ]);

        $feetype->update($request->all());

        return redirect()->route('feetypes.index')->with('success', 'Tipo de tarifa actualizado correctamente.');
    }

    public function destroy($id)
    {
        $feetype = Feetype::findOrFail($id);
        $feetype->delete();

        return redirect()->route('feetypes.index')->with('success', 'Tipo de tarifa eliminado correctamente.');
    }
}
