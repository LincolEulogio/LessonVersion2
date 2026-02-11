<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'classesID';

    protected $fillable = [
        'classes', 'classes_numeric', 'teacherID', 'note', 
        'create_date', 'modify_date', 'create_userID', 
        'create_username', 'create_usertype'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'classesID', 'classesID');
    }
}
