<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Book;
use App\Models\LibraryMember;
use App\Http\Requests\StoreIssueRequest;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    /**
     * Display a listing of book issues.
     */
    public function index()
    {
        $issues = Issue::with(['book', 'member'])->orderBy('issueID', 'desc')->get();
        return view('issue.index', compact('issues'));
    }

    /**
     * Show the form for creating a new issue.
     */
    public function create()
    {
        // Only books with available stock
        $books = Book::all()->filter(function ($book) {
            return ($book->quantity - $book->due_quantity) > 0;
        });
        
        $members = LibraryMember::orderBy('name', 'asc')->get();
        
        return view('issue.create', compact('books', 'members'));
    }

    /**
     * Store a newly created book issue.
     */
    public function store(StoreIssueRequest $request)
    {
        $book = Book::findOrFail($request->bookID);

        // Double check availability
        if (($book->quantity - $book->due_quantity) <= 0) {
            return redirect()->back()->with('error', 'Lo sentimos, este libro ya no tiene copias disponibles.');
        }

        // Create issue
        Issue::create($request->validated());

        // Update book due quantity (increase books out)
        $book->increment('due_quantity');

        return redirect()->route('issue.index')->with('success', 'Préstamo registrado correctamente.');
    }

    /**
     * Display the specified issue.
     */
    public function show($id)
    {
        $issue = Issue::with(['book', 'member.student'])->findOrFail($id);
        return view('issue.show', compact('issue'));
    }

    /**
     * Update the issue to mark as returned.
     */
    public function markAsReturned(Request $request, $id)
    {
        $issue = Issue::findOrFail($id);

        if ($issue->return_date) {
            return redirect()->back()->with('error', 'Este libro ya fue marcado como devuelto.');
        }

        $issue->update([
            'return_date' => now()->toDateString()
        ]);

        // Update book stock (decrease books out)
        $book = Book::find($issue->bookID);
        if ($book) {
            $book->decrement('due_quantity');
        }

        return redirect()->route('issue.index')->with('success', 'Libro devuelto correctamente.');
    }

    /**
     * Remove the specified issue from storage.
     */
    public function destroy($id)
    {
        $issue = Issue::findOrFail($id);

        // If it wasn't returned yet, give stock back
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
