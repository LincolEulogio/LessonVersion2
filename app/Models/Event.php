<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $primaryKey = 'eventID';

    protected $fillable = [
        'fdate', 'ftime', 'tdate', 'ttime', 'title', 'details', 'photo', 'create_date'
    ];
}
