<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schoolyear extends Model
{
    protected $table = 'schoolyear';
    protected $primaryKey = 'schoolyearID';

    protected $fillable = [
        'schoolyear', 'schoolyeartitle', 'startingdate', 'endingdate', 
        'create_date', 'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
