<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studentgroup extends Model
{
    protected $table = 'studentgroup';
    protected $primaryKey = 'studentgroupID';

    protected $fillable = [
        'group', 'create_date', 'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
