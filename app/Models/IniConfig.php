<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IniConfig extends Model
{
    protected $table = 'ini_config';
    protected $primaryKey = 'ini_configID';

    protected $fillable = [
        'config_name', 'config_value'
    ];
}
