<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leaveapp extends Model
{
    protected $table = 'leaveapp';
    protected $primaryKey = 'leaveappID';

    protected $fillable = [
        'applicant_id', 'applicant_usertypeID', 'start_date', 'end_date', 
        'leave_days', 'application_date', 'create_date', 'categoryID', 
        'reason', 'status', 'attachment', 'schoolyearID'
    ];
}
