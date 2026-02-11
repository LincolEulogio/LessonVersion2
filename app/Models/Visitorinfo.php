<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitorinfo extends Model
{
    protected $table = 'visitorinfo';
    protected $primaryKey = 'visitorinfoID';

    protected $fillable = [
        'name', 'email_id', 'phone', 'company', 'coming_from', 'whom_to_meet', 
        'usertypeID', 'userID', 'check_in', 'check_out', 'status', 
        'create_date', 'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
