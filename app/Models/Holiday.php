<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holiday';
    protected $primaryKey = 'holidayID';

    protected $fillable = [
        'title', 'details', 'fdate', 'tdate', 'photo'
    ];
}
