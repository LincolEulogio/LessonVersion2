<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::orderBy('bookID', 'asc')->get();
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('book.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book' => [
                'required', 'string', 'max:60',
                Rule::unique('book')->where(function ($query) use ($request) {
                    return $query->where('author', $request->author)
                                 ->where('subject_code', $request->subject_code);
                })
            ],
            'author' => 'required|string|max:100',
            'subject_code' => 'required|string|max:20',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'rack' => 'required|string|max:60'
        ]);

        $data = $request->all();
        $data['due_quantity'] = 0;
        
        Book::create($data);

        return redirect()->route('book.index')->with('success', 'Libro agregado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'book' => [
                'required', 'string', 'max:60',
                Rule::unique('book')->where(function ($query) use ($request, $id) {
                    return $query->where('author', $request->author)
                                 ->where('subject_code', $request->subject_code)
                                 ->where('bookID', '!=', $id);
                })
            ],
            'author' => 'required|string|max:100',
            'subject_code' => 'required|string|max:20',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'rack' => 'required|string|max:60'
        ]);

        $book->update($request->all());

        return redirect()->route('book.index')->with('success', 'Libro actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('book.index')->with('success', 'Libro eliminado correctamente.');
    }
}
