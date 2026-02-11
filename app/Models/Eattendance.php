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
}
