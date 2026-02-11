<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $table = 'assignment';
    protected $primaryKey = 'assignmentID';

    protected $fillable = [
        'title', 'description', 'deadlinedate', 'usertypeID', 'userID', 
        'originalfile', 'file', 'classesID', 'schoolyearID', 
        'sectionID', 'subjectID', 'assignusertypeID', 'assignuserID'
    ];
}
