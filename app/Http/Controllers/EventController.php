<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('fdate', 'desc')->get();
        return view('event.index', compact('events'));
    }

    public function create()
    {
        return view('event.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:128',
            'details' => 'required|string',
            'fdate' => 'required|date',
            'ftime' => 'required',
            'tdate' => 'required|date',
            'ttime' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['create_date'] = now();

        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/images'), $imageName);
            $data['photo'] = $imageName;
        }

        Event::create($data);

        return redirect()->route('event.index')->with('success', 'Evento creado correctamente.');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event.view', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:128',
            'details' => 'required|string',
            'fdate' => 'required|date',
            'ftime' => 'required',
            'tdate' => 'required|date',
            'ttime' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($event->photo && file_exists(public_path('uploads/images/'.$event->photo))) {
                unlink(public_path('uploads/images/'.$event->photo));
            }
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/images'), $imageName);
            $data['photo'] = $imageName;
        }

        $event->update($data);

        return redirect()->route('event.index')->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event->photo && file_exists(public_path('uploads/images/'.$event->photo))) {
            unlink(public_path('uploads/images/'.$event->photo));
        }
        $event->delete();

        return redirect()->route('event.index')->with('success', 'Evento eliminado correctamente.');
    }
}
