<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Markpercentage extends Model
{
    protected $table = 'markpercentage';
    protected $primaryKey = 'markpercentageID';

    protected $fillable = [
        'markpercentage', 'markpercentage_numeric'
    ];
}
