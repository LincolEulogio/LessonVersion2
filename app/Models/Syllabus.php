<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $table = 'syllabus';
    protected $primaryKey = 'syllabusID';

    protected $fillable = [
        'title', 'description', 'classesID', 'file', 'create_date', 
        'modify_date', 'create_userID', 'create_usertypeID',
        'create_username', 'create_usertype'
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classesID', 'classesID');
    }
}
