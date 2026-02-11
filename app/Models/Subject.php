<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';
    protected $primaryKey = 'subjectID';

    protected $fillable = [
        'classesID', 'teacherID', 'type', 'passmark', 'finalmark', 
        'subject', 'subject_author', 'subject_code', 'create_date', 
        'modify_date', 'create_userID', 'create_usertypeID'
    ];

    public function classes()
    {
        return $this->belongsTo(Classes::class, 'classesID', 'classesID');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacherID', 'teacherID');
    }
}
