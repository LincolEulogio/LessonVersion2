<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionLevel extends Model
{
    protected $table = 'question_level';
    protected $primaryKey = 'questionLevelID';

    protected $fillable = [
        'name', 'create_date', 'modify_date'
    ];
}
