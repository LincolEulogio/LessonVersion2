<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Idmanager extends Model
{
    protected $table = 'idmanager';
    protected $primaryKey = 'idmanagerID';

    protected $fillable = [
        'type', 'name'
    ];
}
