<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $table = 'transport';
    protected $primaryKey = 'transportID';

    protected $fillable = [
        'route', 'vehicle', 'cost', 'note', 'create_date', 
        'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
