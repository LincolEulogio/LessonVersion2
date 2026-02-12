<?php

namespace App\Http\Controllers;

use App\Models\Hostel;
use Illuminate\Http\Request;

class HostelController extends Controller
{
    public function index()
    {
        $hostels = Hostel::all();
        return view('hostel.index', compact('hostels'));
    }

    public function create()
    {
        return view('hostel.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:40|unique:hostel,name',
            'address' => 'required|string|max:200',
            'note' => 'nullable|string',
        ]);

        Hostel::create($request->all());

        return redirect()->route('hostel.index')->with('success', 'Hostal creado correctamente.');
    }

    public function edit($id)
    {
        $hostel = Hostel::findOrFail($id);
        return view('hostel.edit', compact('hostel'));
    }

    public function update(Request $request, $id)
    {
        $hostel = Hostel::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:40|unique:hostel,name,' . $id . ',hostelID',
            'address' => 'required|string|max:200',
            'note' => 'nullable|string',
        ]);

        $hostel->update($request->all());

        return redirect()->route('hostel.index')->with('success', 'Hostal actualizado correctamente.');
    }

    public function destroy($id)
    {
        $hostel = Hostel::findOrFail($id);
        $hostel->delete();

        return redirect()->route('hostel.index')->with('success', 'Hostal eliminado correctamente.');
    }
}
