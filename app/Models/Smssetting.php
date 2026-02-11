<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Smssetting extends Model
{
    protected $table = 'smssettings';
    protected $primaryKey = 'smssettingsID';

    protected $fillable = [
        'types', 'fieldname', 'value'
    ];
}
