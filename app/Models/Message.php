<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'message';
    protected $primaryKey = 'messageID';

    protected $fillable = [
        'email', 'subject', 'message', 'status', 'date', 
        'create_date', 'userID', 'usertypeID', 'uname'
    ];
}
