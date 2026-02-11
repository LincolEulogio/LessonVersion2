<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exam';
    protected $primaryKey = 'examID';

    protected $fillable = [
        'exam', 'date', 'note'
    ];
}
