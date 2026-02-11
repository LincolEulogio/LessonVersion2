<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hostel extends Model
{
    protected $table = 'hostel';
    protected $primaryKey = 'hostelID';

    protected $fillable = [
        'name', 'address', 'note'
    ];
}
