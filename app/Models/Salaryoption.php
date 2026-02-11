<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salaryoption extends Model
{
    protected $table = 'salaryoption';
    protected $primaryKey = 'salaryoptionID';

    protected $fillable = [
        'salary_templateID', 'label', 'value', 'type'
    ];
}
