<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Book;
use App\Models\LibraryMember;
use App\Models\Issue;

class LibraryController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'total_books' => Book::sum('quantity'),
            'total_members' => LibraryMember::count(),
            'total_issued' => Issue::whereNull('return_date')->count(),
            'total_returns' => Issue::whereNotNull('return_date')->count(),
        ];

        return view('library.index', compact('stats'));
    }
}
