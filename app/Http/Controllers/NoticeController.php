<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function index()
    {
        $notices = Notice::orderBy('date', 'desc')->get();
        return view('notice.index', compact('notices'));
    }

    public function create()
    {
        return view('notice.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:128',
            'notice' => 'required|string',
            'date' => 'required|date',
        ]);

        Notice::create([
            'title' => $request->title,
            'notice' => $request->notice,
            'date' => $request->date,
            'create_date' => now(),
        ]);

        return redirect()->route('notice.index')->with('success', 'Anuncio creado correctamente.');
    }

    public function show($id)
    {
        $notice = Notice::findOrFail($id);
        return view('notice.view', compact('notice'));
    }

    public function edit($id)
    {
        $notice = Notice::findOrFail($id);
        return view('notice.edit', compact('notice'));
    }

    public function update(Request $request, $id)
    {
        $notice = Notice::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:128',
            'notice' => 'required|string',
            'date' => 'required|date',
        ]);

        $notice->update($request->all());

        return redirect()->route('notice.index')->with('success', 'Anuncio actualizado correctamente.');
    }

    public function destroy($id)
    {
        $notice = Notice::findOrFail($id);
        $notice->delete();

        return redirect()->route('notice.index')->with('success', 'Anuncio eliminado correctamente.');
    }
}
