<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AutomationShudulu extends Model
{
    protected $table = 'automation_shudulu';
    protected $primaryKey = 'automation_shuduluID';

    protected $fillable = [
        'date', 'day', 'month', 'year'
    ];
}
