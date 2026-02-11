<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'tagsID';

    protected $fillable = [
        'name', 'create_date', 'modify_date', 'create_userID', 'create_usertypeID'
    ];
}
