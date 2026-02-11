<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hmember extends Model
{
    protected $table = 'hmember';
    protected $primaryKey = 'hmemberID';

    protected $fillable = [
        'hostelID', 'categoryID', 'studentID', 'hbalance', 'hjoindate'
    ];
}
