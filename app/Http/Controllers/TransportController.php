<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Http\Requests\StoreTransportRequest;
use App\Http\Requests\UpdateTransportRequest;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of transports.
     */
    public function index()
    {
        $transports = Transport::orderBy('transportID', 'desc')->get();
        return view('transport.index', compact('transports'));
    }

    /**
     * Show the form for creating a new transport.
     */
    public function create()
    {
        return view('transport.create');
    }

    /**
     * Store a newly created transport in storage.
     */
    public function store(StoreTransportRequest $request)
    {
        Transport::create([
            'route' => $request->route,
            'vehicle' => $request->vehicle,
            'cost' => $request->cost,
            'note' => $request->note,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => auth()->id(),
            'create_usertypeID' => auth()->user()->usertypeID ?? 1,
        ]);

        return redirect()->route('transport.index')->with('success', 'Ruta de transporte creada correctamente.');
    }

    /**
     * Display the specified transport.
     */
    public function show($id)
    {
        $transport = Transport::findOrFail($id);
        // You might want to count members here if tmember table exists
        // $memberCount = \App\Models\Tmember::where('transportID', $id)->count();
        return view('transport.show', compact('transport'));
    }

    /**
     * Show the form for editing the specified transport.
     */
    public function edit($id)
    {
        $transport = Transport::findOrFail($id);
        return view('transport.edit', compact('transport'));
    }

    /**
     * Update the specified transport in storage.
     */
    public function update(UpdateTransportRequest $request, $id)
    {
        $transport = Transport::findOrFail($id);
        
        $transport->update([
            'route' => $request->route,
            'vehicle' => $request->vehicle,
            'cost' => $request->cost,
            'note' => $request->note,
            'modify_date' => now(),
        ]);

        return redirect()->route('transport.index')->with('success', 'Ruta de transporte actualizada correctamente.');
    }

    /**
     * Remove the specified transport from storage.
     */
    public function destroy($id)
    {
        $transport = Transport::findOrFail($id);
        
        // Verificar si hay estudiantes asignados a esta ruta
        $memberExists = \App\Models\TransportMember::where('transportID', $id)->exists();
        
        if ($memberExists) {
            return redirect()->back()->with('error', 'No se puede eliminar la ruta porque tiene estudiantes asignados.');
        }

        $transport->delete();

        return redirect()->route('transport.index')->with('success', 'Ruta de transporte eliminada correctamente.');
    }
}
