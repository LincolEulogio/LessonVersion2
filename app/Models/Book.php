<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'book';
    protected $primaryKey = 'bookID';

    protected $fillable = [
        'book', 'subject_code', 'author', 'price', 'quantity', 
        'due_quantity', 'rack'
    ];

    public function issues()
    {
        return $this->hasMany(Issue::class, 'bookID', 'bookID');
    }
}
