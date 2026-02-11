<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $table = 'mark';
    protected $primaryKey = 'markID';

    protected $fillable = [
        'schoolyearID', 'examID', 'classesID', 'sectionID', 
        'subjectID', 'studentID', 'mark', 'year'
    ];

    public function relations()
    {
        return $this->hasMany(Markrelation::class, 'markID', 'markID');
    }

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
