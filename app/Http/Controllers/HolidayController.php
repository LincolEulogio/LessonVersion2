<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::orderBy('fdate', 'desc')->get();
        return view('holiday.index', compact('holidays'));
    }

    public function create()
    {
        return view('holiday.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:128',
            'details' => 'required|string',
            'fdate' => 'required|date',
            'tdate' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/images'), $imageName);
            $data['photo'] = $imageName;
        }

        Holiday::create($data);

        return redirect()->route('holiday.index')->with('success', 'Vacaciones creadas correctamente.');
    }

    public function show($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('holiday.view', compact('holiday'));
    }

    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('holiday.edit', compact('holiday'));
    }

    public function update(Request $request, $id)
    {
        $holiday = Holiday::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:128',
            'details' => 'required|string',
            'fdate' => 'required|date',
            'tdate' => 'required|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($holiday->photo && file_exists(public_path('uploads/images/'.$holiday->photo))) {
                unlink(public_path('uploads/images/'.$holiday->photo));
            }
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/images'), $imageName);
            $data['photo'] = $imageName;
        }

        $holiday->update($data);

        return redirect()->route('holiday.index')->with('success', 'Vacaciones actualizadas correctamente.');
    }

    public function destroy($id)
    {
        $holiday = Holiday::findOrFail($id);
        if ($holiday->photo && file_exists(public_path('uploads/images/'.$holiday->photo))) {
            unlink(public_path('uploads/images/'.$holiday->photo));
        }
        $holiday->delete();

        return redirect()->route('holiday.index')->with('success', 'Vacaciones eliminadas correctamente.');
    }
}
