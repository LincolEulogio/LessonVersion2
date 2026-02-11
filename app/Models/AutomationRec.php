<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutomationRec extends Model
{
    protected $table = 'automation_rec';
    protected $primaryKey = 'automation_recID';

    protected $fillable = [
        'studentID', 'date', 'day', 'month', 'year', 'nofmodule'
    ];
}
