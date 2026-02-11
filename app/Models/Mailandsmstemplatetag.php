<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mailandsmstemplatetag extends Model
{
    protected $table = 'mailandsmstemplatetag';
    protected $primaryKey = 'mailandsmstemplatetagID';

    protected $fillable = [
        'mailandsmstemplateID', 'tagname'
    ];
}
