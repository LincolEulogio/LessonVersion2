<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'issue';
    protected $primaryKey = 'issueID';

    protected $fillable = [
        'lID', 'bookID', 'serial_no', 'issue_date', 'due_date', 
        'return_date', 'note'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookID', 'bookID');
    }

    public function member()
    {
        return $this->belongsTo(LibraryMember::class, 'lID', 'lID');
    }
}
