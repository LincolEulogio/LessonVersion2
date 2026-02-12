<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function index()
    {
        $transports = Transport::all();
        return view('transport.index', compact('transports'));
    }

    public function create()
    {
        return view('transport.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'route' => 'required|string|max:128|unique:transport,route',
            'vehicle' => 'required|string|max:128',
            'cost' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:200',
        ]);

        Transport::create([
            'route' => $request->route,
            'vehicle' => $request->vehicle,
            'cost' => $request->cost,
            'note' => $request->note,
            'create_date' => now(),
            'modify_date' => now(),
            'create_userID' => auth()->id(),
            'create_usertypeID' => auth()->user()->usertypeID ?? 1, // Default to admin if not set
        ]);

        return redirect()->route('transport.index')->with('success', 'Transport created successfully.');
    }

    public function edit($id)
    {
        $transport = Transport::findOrFail($id);
        return view('transport.edit', compact('transport'));
    }

    public function update(Request $request, $id)
    {
        $transport = Transport::findOrFail($id);
        
        $request->validate([
            'route' => 'required|string|max:128|unique:transport,route,' . $id . ',transportID',
            'vehicle' => 'required|string|max:128',
            'cost' => 'required|numeric|min:0',
            'note' => 'nullable|string|max:200',
        ]);

        $transport->update([
            'route' => $request->route,
            'vehicle' => $request->vehicle,
            'cost' => $request->cost,
            'note' => $request->note,
            'modify_date' => now(),
        ]);

        return redirect()->route('transport.index')->with('success', 'Transport updated successfully.');
    }

    public function destroy($id)
    {
        $transport = Transport::findOrFail($id);
        $transport->delete();

        return redirect()->route('transport.index')->with('success', 'Transport deleted successfully.');
    }
}
