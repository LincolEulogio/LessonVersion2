<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loginlog extends Model
{
    protected $table = 'loginlog';
    protected $primaryKey = 'loginlogID';

    protected $fillable = [
        'userID', 'name', 'usertype', 'ip', 'browser', 
        'operatingsystem', 'loginID', 'loggedin_at', 'loggedout_at'
    ];
}
