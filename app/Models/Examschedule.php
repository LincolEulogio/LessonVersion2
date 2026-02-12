<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    protected $table = 'examschedule';
    protected $primaryKey = 'examscheduleID';

    protected $fillable = [
        'examID', 'classesID', 'sectionID', 'subjectID', 'edate', 
        'examfrom', 'examto', 'room', 'schoolyearID'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'examID', 'examID');
    }

    public function classes()
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
}
