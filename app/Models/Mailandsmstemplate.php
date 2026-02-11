<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mailandsmstemplate extends Model
{
    protected $table = 'mailandsmstemplate';
    protected $primaryKey = 'mailandsmstemplateID';

    protected $fillable = [
        'usertypeID', 'type', 'template', 'create_date'
    ];
}
