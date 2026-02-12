<?php

namespace App\Http\Controllers;

use App\Models\Markpercentage;
use Illuminate\Http\Request;

class MarkpercentageController extends Controller
{
    public function index()
    {
        $markpercentages = Markpercentage::all();
        return view('markpercentage.index', compact('markpercentages'));
    }

    public function create()
    {
        return view('markpercentage.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'markpercentage' => 'required|string|max:60',
            'markpercentage_numeric' => 'required|numeric',
        ]);

        Markpercentage::create($validated);

        return redirect()->route('markpercentage.index')->with('success', 'Porcentaje de calificación creado con éxito.');
    }

    public function edit(string $id)
    {
        $markpercentage = Markpercentage::findOrFail($id);
        return view('markpercentage.edit', compact('markpercentage'));
    }

    public function update(Request $request, string $id)
    {
        $markpercentage = Markpercentage::findOrFail($id);

        $validated = $request->validate([
            'markpercentage' => 'required|string|max:60',
            'markpercentage_numeric' => 'required|numeric',
        ]);

        $markpercentage->update($validated);

        return redirect()->route('markpercentage.index')->with('success', 'Porcentaje de calificación actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        $markpercentage = Markpercentage::findOrFail($id);
        $markpercentage->delete();

        return redirect()->route('markpercentage.index')->with('success', 'Porcentaje de calificación eliminado con éxito.');
    }
}
