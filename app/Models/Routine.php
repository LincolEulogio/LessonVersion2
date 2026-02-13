<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $table = 'routine';
    protected $primaryKey = 'routineID';

    protected $fillable = [
        'classesID', 'sectionID', 'subjectID', 'teacherID', 'day', 'start_time', 
        'end_time', 'room', 'schoolyearID', 'create_date', 'modify_date',
        'create_userID', 'create_usertypeID', 'create_username', 'create_usertype'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classesID', 'classesID');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'sectionID', 'sectionID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjectID', 'subjectID');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacherID', 'teacherID');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'create_userID', 'userID');
    }
}
