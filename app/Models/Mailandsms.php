<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mailandsms extends Model
{
    protected $table = 'mailandsms';
    protected $primaryKey = 'mailandsmsID';

    protected $fillable = [
        'usertypeID', 'user_id', 'type', 'message', 'year', 'create_date'
    ];
}
