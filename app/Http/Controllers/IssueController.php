<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Issue;
use App\Models\Book;
use App\Models\LibraryMember;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $issues = Issue::with(['book', 'member'])->orderBy('issueID', 'desc')->get();
        return view('issue.index', compact('issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $books = Book::where('quantity', '>', 'due_quantity')->get();
        return view('issue.add', compact('books'));
    }

    /**
     * Store a newly created resource (Issue book).
     */
    public function store(Request $request)
    {
        $request->validate([
            'lID' => 'required|exists:lmember,lID',
            'bookID' => 'required|exists:book,bookID',
            'serial_no' => 'required|string|max:40',
            'due_date' => 'required|date|after_or_equal:issue_date',
            'issue_date' => 'required|date'
        ]);

        $book = Book::findOrFail($request->bookID);
        
        if ($book->due_quantity >= $book->quantity) {
            return redirect()->back()->with('error', 'Este libro no tiene ejemplares disponibles.');
        }

        Issue::create($request->all());

        // Update book due quantity
        $book->increment('due_quantity');

        return redirect()->route('issue.index')->with('success', 'Libro prestado correctamente.');
    }

    /**
     * Update the specified resource (Return book).
     */
    public function update(Request $request, string $id)
    {
        $issue = Issue::findOrFail($id);
        
        if ($issue->return_date) {
            return redirect()->back()->with('error', 'Este libro ya ha sido devuelto.');
        }

        $issue->update([
            'return_date' => now()->toDateString()
        ]);

        // Update book due quantity
        $book = Book::findOrFail($issue->bookID);
        $book->decrement('due_quantity');

        return redirect()->route('issue.index')->with('success', 'Libro devuelto correctamente.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        $issue = Issue::findOrFail($id);
        
        // If not returned, update book quantity first?
        if (!$issue->return_date) {
            $book = Book::find($issue->bookID);
            if ($book) {
                $book->decrement('due_quantity');
            }
        }

        $issue->delete();

        return redirect()->route('issue.index')->with('success', 'Registro de préstamo eliminado.');
    }
}
