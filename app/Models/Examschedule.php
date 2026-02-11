<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Examschedule extends Model
{
    protected $table = 'examschedule';
    protected $primaryKey = 'examscheduleID';

    protected $fillable = [
        'examID', 'classesID', 'sectionID', 'subjectID', 'edate', 
        'examfrom', 'examto', 'room', 'schoolyearID'
    ];
}
