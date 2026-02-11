<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lmember extends Model
{
    protected $table = 'lmember';
    protected $primaryKey = 'lmemberID';

    protected $fillable = [
        'lmembercardID', 'studentID', 'name', 'email', 'phone', 
        'lbalance', 'ljoindate'
    ];
}
