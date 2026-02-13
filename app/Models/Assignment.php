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
        'sectionID', 'subjectID', 'assignusertypeID', 'assignuserID',
        'create_username', 'create_usertype'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classesID', 'classesID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjectID', 'subjectID');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'sectionID', 'sectionID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'userID');
    }
}
