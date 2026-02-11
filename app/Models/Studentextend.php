<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studentextend extends Model
{
    protected $table = 'studentextend';
    protected $primaryKey = 'studentextendID';

    protected $fillable = [
        'studentID', 'classesID', 'sectionID', 'roll', 'library', 
        'hostel', 'transport', 'create_date', 'modify_date', 
        'create_userID', 'create_usertypeID'
    ];
}
