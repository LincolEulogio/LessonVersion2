<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $table = 'syllabus';
    protected $primaryKey = 'syllabusID';

    protected $fillable = [
        'title', 'description', 'classesID', 'file', 'create_date', 
        'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
