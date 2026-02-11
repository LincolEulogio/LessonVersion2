<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventcounter extends Model
{
    protected $table = 'eventcounter';
    protected $primaryKey = 'eventcounterID';

    protected $fillable = [
        'eventID', 'username', 'type', 'name', 'photo', 'status', 'create_date'
    ];
}
