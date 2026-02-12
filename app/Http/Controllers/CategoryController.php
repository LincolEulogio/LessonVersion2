<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hostel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('hostel')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        $hostels = Hostel::all();
        return view('category.add', compact('hostels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hostelID' => 'required|exists:hostel,hostelID',
            'class_type' => 'required|string|max:60',
            'hbalance' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('category.index')->with('success', 'Categoría de hospedaje creada correctamente.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $hostels = Hostel::all();
        return view('category.edit', compact('category', 'hostels'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'hostelID' => 'required|exists:hostel,hostelID',
            'class_type' => 'required|string|max:60',
            'hbalance' => 'required|numeric|min:0',
            'note' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('category.index')->with('success', 'Categoría de hospedaje actualizada correctamente.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Categoría de hospedaje eliminada correctamente.');
    }
}
