<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of books.
     */
    public function index()
    {
        $books = Book::orderBy('bookID', 'desc')->get();
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $data['due_quantity'] = 0;
        
        Book::create($data);

        return redirect()->route('book.index')->with('success', 'Libro agregado a la biblioteca correctamente.');
    }

    /**
     * Display the specified book.
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('book.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('book.edit', compact('book'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(UpdateBookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->validated());

        return redirect()->route('book.index')->with('success', 'Información del libro actualizada.');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        
        // Check if book has active issues before deleting?
        if ($book->due_quantity > 0) {
            return redirect()->back()->with('error', 'No se puede eliminar un libro que tiene préstamos pendientes.');
        }

        $book->delete();

        return redirect()->route('book.index')->with('success', 'Libro eliminado de la biblioteca.');
    }
}
