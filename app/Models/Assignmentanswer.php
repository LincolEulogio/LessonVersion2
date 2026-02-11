<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignmentanswer extends Model
{
    protected $table = 'assignmentanswer';
    protected $primaryKey = 'assignmentanswerID';

    protected $fillable = [
        'assignmentID', 'schoolyearID', 'uploaderID', 'uploadertypeID', 
        'answerfile', 'answerfileoriginal', 'answerdate'
    ];
}
