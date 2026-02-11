<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grade';
    protected $primaryKey = 'gradeID';

    protected $fillable = [
        'grade', 'point', 'markfrom', 'markto', 'note'
    ];
}
