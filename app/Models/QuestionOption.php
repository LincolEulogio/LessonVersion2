<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $table = 'question_option';
    protected $primaryKey = 'questionOptionID';

    protected $fillable = [
        'questionID', 'name', 'upload'
    ];
}
