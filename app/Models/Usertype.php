<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usertype extends Model
{
    protected $table = 'usertypes';
    protected $primaryKey = 'usertypeID';
    
    protected $fillable = [
        'usertype', 
        'create_date', 
        'modify_date', 
        'create_userID', 
        'create_username', 
        'create_usertype'
    ];
}
