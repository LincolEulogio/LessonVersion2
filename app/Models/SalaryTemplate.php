<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryTemplate extends Model
{
    protected $table = 'salary_template';
    protected $primaryKey = 'salary_templateID';

    protected $fillable = [
        'salary_grade', 'basic_salary', 'over_time_rate', 'create_date', 
        'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
