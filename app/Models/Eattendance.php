<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eattendance extends Model
{
    protected $table = 'eattendance';
    protected $primaryKey = 'eattendanceID';

    protected $fillable = [
        'schoolyearID', 'examID', 'classesID', 'sectionID', 'subjectID', 
        'date', 'studentID', 's_name', 'eattendance', 'year', 'eextra'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentID', 'studentID');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'examID', 'examID');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subjectID', 'subjectID');
    }
}
