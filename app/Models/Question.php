<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';
    protected $primaryKey = 'questionID';

    protected $fillable = [
        'questionBankID', 'question', 'explanation', 'upload', 'create_date', 'modify_date'
    ];
}
