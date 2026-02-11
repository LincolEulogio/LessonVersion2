<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    protected $table = 'routine';
    protected $primaryKey = 'routineID';

    protected $fillable = [
        'classesID', 'sectionID', 'subjectID', 'day', 'start_time', 
        'end_time', 'room', 'schoolyearID'
    ];
}
