<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    protected $primaryKey = 'sectionID';

    protected $fillable = [
        'section', 'category', 'capacity', 'classesID', 'teacherID', 
        'note', 'create_date', 'modify_date', 'create_userID', 
        'create_username', 'create_usertype'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'sectionID', 'sectionID');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classesID', 'classesID');
    }
}
