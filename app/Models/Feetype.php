<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feetype extends Model
{
    protected $table = 'feetypes';
    protected $primaryKey = 'feetypesID';

    protected $fillable = [
        'feetypes', 'note'
    ];
}
