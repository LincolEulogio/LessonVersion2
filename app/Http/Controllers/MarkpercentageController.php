<?php

namespace App\Http\Controllers;

use App\Models\Markpercentage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreMarkpercentageRequest;
use App\Http\Requests\UpdateMarkpercentageRequest;
use Illuminate\Support\Facades\Auth;

class MarkpercentageController extends Controller
{
    public function index()
    {
        if (!Auth::user()->hasPermission('porcentaje_promedio_view')) {
            abort(403, 'No tienes permiso para ver esta sección.');
        }

        $markpercentages = Markpercentage::all();
        return view('markpercentage.index', compact('markpercentages'));
    }

    public function create()
    {
        if (!Auth::user()->hasPermission('porcentaje_promedio_add')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        return view('markpercentage.create');
    }

    public function store(StoreMarkpercentageRequest $request)
    {
        Markpercentage::create($request->validated());

        return redirect()->route('markpercentage.index')->with('success', 'Porcentaje de calificación creado con éxito.');
    }

    public function edit(string $id)
    {
        if (!Auth::user()->hasPermission('porcentaje_promedio_edit')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $markpercentage = Markpercentage::findOrFail($id);
        return view('markpercentage.edit', compact('markpercentage'));
    }

    public function update(UpdateMarkpercentageRequest $request, string $id)
    {
        $markpercentage = Markpercentage::findOrFail($id);
        $markpercentage->update($request->validated());

        return redirect()->route('markpercentage.index')->with('success', 'Porcentaje de calificación actualizado con éxito.');
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->hasPermission('porcentaje_promedio_delete')) {
            abort(403, 'No tienes permiso para realizar esta acción.');
        }

        $markpercentage = Markpercentage::findOrFail($id);
        $markpercentage->delete();

        return redirect()->route('markpercentage.index')->with('success', 'Porcentaje de calificación eliminado con éxito.');
    }
}
